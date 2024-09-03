<?php

namespace App\Services;

use App\Models\Order as ObjModel;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class OrderService extends BaseService
{
    protected string $folder = 'admin/order';
    protected string $route = 'orders';

    public function __construct(ObjModel $model, protected CustomerService $customerService, protected ProductService $productService)
    {
        parent::__construct($model);
    }

    public function index($request)
    {
        if ($request->ajax()) {
            $orders = ObjModel::with(['products', 'customer'])->get();

            return DataTables::of($orders)
                ->addColumn('action', function ($order) {
                    $buttons = '';

                    if (auth()->user()->can('edit_product')) {
                        $buttons .= '
            <a href="' . route($this->route . '.edit', $order->id) . '" class="btn btn-pill btn-info-light">
                <i class="fa fa-edit"></i>
            </a>';
                    }

                    if (auth()->user()->can('delete_order')) {
                        $buttons .= '
            <button class="btn btn-pill btn-danger-light" data-bs-toggle="modal"
                    data-bs-target="#delete_modal" data-id="' . $order->id . '" data-title="' . $order->id . '">
                <i class="fas fa-trash"></i>
            </button>';
                    }

                    return $buttons;
                })
                ->editColumn('customer_id', function ($order) {
                    return $order->customer ? $order->customer->name : 'N / A';
                })
                ->addColumn('products', function ($order) {
                    $productDetails = $order->products->map(function ($product) {
                        return ' اسم المنتج :  ' . $product->name . ' (الكميه : ' . $product->pivot->quantity . ')';
                    })->implode('<br>'); // Correct <br> spacing
                    return $productDetails;
                })
                ->editColumn('points', function ($order) {
                    return $order->customer ? $order->customer->points : 0;
                })
                ->addColumn('total', function ($order) {
                    return $order->total; // Display total order price
                })
                ->editColumn('status', function ($order) {
                    switch ($order->status) {
                        case 'pending':
                            return '<span class="badge badge-warning">معلق</span>';
                        case 'processing':
                            return '<span class="badge badge-info">قيد الإجراء</span>';
                        case 'shipped':
                            return '<span class="badge badge-primary">تم الشحن</span>';
                        case 'delivered':
                            return '<span class="badge badge-success">تم التوصيل</span>';
                        case 'returned':
                            return '<span class="badge badge-secondary">تم الإرجاع</span>';
                        case 'canceled':
                            return '<span class="badge badge-danger">ملغي</span>';
                        default:
                            return '<span class="badge badge-light">غير معروف</span>'; // For any unhandled statuses
                    }
                })
                ->addIndexColumn()
                ->escapeColumns([]) // Ensure all columns are allowed to render HTML
                ->make(true);

        }

        return view($this->folder . '/index');
    }


    public function showOrder($request)
    {
        if ($request->ajax()) {
            $orders = ObjModel::with(['products', 'customer'])->get();

            return DataTables::of($orders)

                ->editColumn('status', function ($order) {
                    $select = '<select class="form-select form-select-sm status-select" style="width: 100px;" data-order-id="' . $order->id . '">';
                    $statuses = [
                        'pending' => 'معلق',
                        'processing' => 'قيد الإجراء',
                        'shipped' => 'تم الشحن',
                        'delivered' => 'تم التوصيل',
                        'returned' => 'تم الإرجاع',
                        'canceled' => 'ملغي'
                    ];

                    foreach ($statuses as $value => $label) {
                        $selected = $order->status == $value ? 'selected' : '';
                        $select .= '<option value="' . $value . '" ' . $selected . '>' . $label . '</option>';
                    }

                    $select .= '</select>';
                    return $select;
                })

                ->editColumn('customer_id', function ($order) {
                        return $order->customer ? $order->customer->name : 'N / A';

                    })->addColumn('products', function ($order) {
                            $productDetails = $order->products->map(function ($product) {
                                return ' اسم المنتج :  ' . $product->name . ' (الكميه : ' . $product->pivot->quantity . ')';
                            })->implode('<br>'); // Correct <br> spacing
                            return $productDetails;

                })
                ->addIndexColumn()
                ->escapeColumns([])
                ->make(true);

        }

        return view($this->folder . '/showOrder');
    }


    public function changeOrderStatus($id)
    {
        return view($this->folder . '/parts/changeOrderStatus', [
            'order' => $this->getById($id),

            'route' => route('updateOrderStatus', $id),
        ]);

    }

    public function updateStatus($request)
    {

        $order = $this->getById($request->id);
        if ($order) {
            $order->status = $request->status;
            $order->save();

            return response()->json(['success' => true, 'message' => 'تم تحديث الحالة بنجاح.']);
        } else {
            return response()->json(['success' => false, 'message' => 'فشل تحديث الحالة.']);
        }
    }





    Public function updateOrderStatus( $request,$id)
    {
        $this->getById($id)->update([
            'status' => $request->status
        ]);

        return redirect( )->route('orders.showOrder')->with('success', 'تم تغيير حالة الطلب بنجاح');
    }


    public function create()
    {
        return view($this->folder . '/parts/create', [
            'customers' => $this->customerService->getAll(),
            'products' => $this->productService->getAll(),

            'route' => route($this->route . '.store'),
        ]);
    }

    public function store($data)
    {


        $validatedData = $data->validate([
            'customer_id' => 'required | exists:customers,id',
            'product_ids' => 'required | array',
            'product_ids .*' => 'exists:products,id',
            'quantity' => 'required | array',
            'quantity .*' => 'integer | min:1',
            'use_points' => 'nullable | integer | min:0',
            'total_price' => 'required | numeric | min:0',
            'address' => 'nullable | string',
            'delivery_type' => 'required | in:1,2',
            'total_award_points' => 'nullable | min:0',
        ], [
            'customer_id . exists' => 'هذا العميل غير موجود',
            'product_ids .*.exists' => 'هذا المنتج غير موجود',
            'quantity .*.integer' => 'الكمية يجب ان تكون عدد',
            'quantity .*.min' => 'الكمية يجب ان تكون عدد',
            'use_points . integer' => 'النقاط يجب ان تكون عدد',
            'use_points . min' => 'النقاط يجب ان تكون عدد',
            'total_price . numeric' => 'السعر يجب ان يكون رقم',
            'total_price . min' => 'السعر يجب ان يكون رقم',
            'address . string' => 'العنوان يجب ان يكون نص',
            'delivery_type . in' => 'نوع التوصيل غير صالح'


        ]);


        // Extract validated data
        $customer_id = $validatedData['customer_id'];
        $product_ids = $validatedData['product_ids'];
        $quantities = $validatedData['quantity'];
        $use_points = $validatedData['use_points'] ?? 0;
        $total_price = $validatedData['total_price'];
        $address = $validatedData['address'];
        $total_award_points = $validatedData['total_award_points'] ?? 0;

        $customer = $this->customerService->getById($customer_id);

        if ($customer->points < $use_points) {
            return response()->json(['status' => 400, 'message' => 'Insufficient points . ']);
        }

        $customer->points -= $use_points;
        $customer->save();


        // Create a new order
        $order = new ObjModel();
        $order->customer_id = $customer_id;
        $order->address = $address;
        $order->use_points = $use_points;
        $order->status = 'pending';
        $order->total = $total_price;
        $order->save();

        foreach ($product_ids as $index => $product_id) {
            $product = Product::find($product_id);
            $order->products()->attach($product_id, [
                'quantity' => $quantities[$index],
                'price' => $product->price,
                'total_price' => $product->price * $quantities[$index]
            ]);
        }

        // Update customer's award points
        $customer->points += $total_award_points;
        $customer->save();


        return redirect()->route($this->route . '.index');
    }

    public
    function edit($id)
    {
        return view($this->folder . '/parts/edit', [

            'customers' => $this->customerService->getAll(),
            'products' => $this->productService->getAll(),
            'order' => $this->getById($id),
            'route' => route($this->route . '.update', $id),
        ]);
    }

    public
    function update($data, $id)
    {
        // Validate the incoming request data
        $validatedData = $data->validate([
            'customer_id' => 'required|exists:customers,id',
            'product_ids' => 'required|array',
            'product_ids.*' => 'exists:products,id',
            'quantity' => 'required|array',
            'quantity.*' => 'integer|min:1',
            'use_points' => 'nullable|integer|min:0',
            'total_price' => 'required|numeric|min:0',
            'address' => 'nullable|string',
            'delivery_type' => 'required|in:1,2',
            'total_award_points' => 'nullable|min:0',
            'status' => 'required|string',

        ], [
            'customer_id.exists' => 'هذا العميل غير موجود',
            'product_ids.*.exists' => 'هذا المنتج غير موجود',
            'quantity.*.integer' => 'الكمية يجب ان تكون عدد',
            'quantity.*.min' => 'الكمية يجب ان تكون عدد',
            'use_points.integer' => 'النقاط يجب ان تكون عدد',
            'use_points.min' => 'النقاط يجب ان تكون عدد',
            'total_price.numeric' => 'السعر يجب ان يكون رقم',
            'total_price.min' => 'السعر يجب ان يكون رقم',
            'address.string' => 'العنوان يجب ان يكون نص',
            'delivery_type.in' => 'نوع التوصيل غير صالح'
        ]);

        // Extract validated data
        $customer_id = $validatedData['customer_id'];
        $product_ids = $validatedData['product_ids'];
        $quantities = $validatedData['quantity'];
        $use_points = $validatedData['use_points'] ?? 0;
        $total_price = $validatedData['total_price'];
        $address = $validatedData['address'];
        $status = $validatedData['status'];
        $total_award_points = $validatedData['total_award_points'] ?? 0;

        $customer = $this->customerService->getById($customer_id);

        if ($customer->points < $use_points) {
            return response()->json(['status' => 400, 'message' => 'Insufficient points.']);
        }

        $customer->points -= $use_points;
        $customer->save();

        // Find the order by ID and update its details
        $order = ObjModel::find($id);
        $order->customer_id = $customer_id;
        $order->address = $address;
        $order->use_points = $use_points;
        $order->status = $status;
        $order->total = $total_price;
        $order->save();

        // Detach existing products from the order
        $order->products()->detach();

        // Attach updated product data to the order
        foreach ($product_ids as $index => $product_id) {
            $product = Product::find($product_id);
            $order->products()->attach($product_id, [
                'quantity' => $quantities[$index],
                'price' => $product->price,
                'total_price' => $product->price * $quantities[$index]
            ]);
        }

        // Update customer's award points
        $customer->points += $total_award_points;
        $customer->save();

        return redirect()->route($this->route . '.index');
    }

    public
    function destroy($id)
    {
        $order = $this->getById($id);
        $productOrders = OrderProduct::where('order_id', $order->id)->get();

        foreach ($productOrders as $productOrder) {
            $productOrder->delete();
        }
        $order->delete();
        return redirect()->route($this->route . '.index');

    }

}
