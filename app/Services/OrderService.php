<?php

namespace App\Services;

use App\Models\Order as ObjModel;
use App\Models\Product;
use http\Env\Response;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class OrderService extends BaseService
{
    protected string $folder = 'admin/order';
    protected string $route = 'orders';

    public function __construct(ObjModel $model ,protected CustomerService $customerService ,protected ProductService $productService)
    {
        parent::__construct($model);
    }

    public function index($request)
    {
        if ($request->ajax()) {
            // Fetch orders with products and customer relationships eagerly loaded
            $orders = ObjModel::with(['products', 'customer'])->get();

            return DataTables::of($orders)
                ->addColumn('action', function ($order) {
                    $buttons = '
                    <button type="button" data-id="' . $order->id . '" class="btn btn-pill btn-info-light editBtn">
                        <i class="fa fa-edit"></i>
                    </button>
                    <button class="btn btn-pill btn-danger-light" data-bs-toggle="modal"
                        data-bs-target="#delete_modal" data-id="' . $order->id . '" data-title="' . $order->name . '">
                        <i class="fas fa-trash"></i>
                    </button>';
                    return $buttons;
                })
                ->editColumn('points', function ($order) {
                    return $order->customer->points;
                })
                ->editColumn('customer_id', function ($order) {
                    return $order->customer->name;
                })
                ->editColumn('products_ids', function ($order)
                {
                    $product_ids = json_decode($order->product_ids, true);

                    if (is_array($product_ids)) {

                        $product_names = Product::whereIn('id', $product_ids)->pluck('name')->toArray();
                        return implode(',', $product_names);
                    }

                    return '';
                })
                ->editColumn('quantity', function ($order) {


                    $quantities = json_decode($order->quantity, true);

                    if (is_array($quantities)) {
                        return implode(', ', $quantities);
                    }

                    return ''; // Return empty string if JSON decoding fails
                })
                ->addIndexColumn()
                ->escapeColumns([])
                ->make(true);
        } else {
            return view($this->folder . '/index');
        }
    }


    public function create()
    {
        return view($this->folder . '/parts/create', [
            'customers' => $this->customerService->getAll(),
            'products' => $this->productService->getAll(),

            'route' => route($this->route . '.store'),
        ]);
    }

    public function store($data): \Illuminate\Http\JsonResponse

    {

//            return response()->json($data);

        $validatedData = $data->validate([
            'customer_id' => 'required|exists:customers,id',
            'product_ids' => 'required|array',
            'product_ids.*' => 'exists:products,id',
            'quantity' => 'required|array',
            'quantity.*' => 'integer|min:1',
            'use_points' => 'nullable|integer|min:0'
        ]);

        // Get the validated data
        $customer_id = $validatedData['customer_id'];
        $product_ids = $validatedData['product_ids'];
        $quantities = $validatedData['quantity'];



        $customer=$this->customerService->getById($customer_id);

        if($customer->points < $data->input('use_points')){
            return response()->json(['status' => 400]);
        }else{
            $customer->points = $customer->points - $data->input('use_points');
            $customer->save();
        }

        $product_ids_json = json_encode($product_ids);
        $quantities_json = json_encode($quantities);

        $order = new ObjModel();
        $order->customer_id = $customer_id;
        $order->product_ids = $product_ids_json;
        $order->quantity = $quantities_json;
        $order->total = $data->input('total_price');
        $order->use_points = $data->input('use_points');
        $order->save();

        if ( $order->save()) {
            return response()->json(['status' => 200]);
        } else {
            return response()->json(['status' => 405]);
        }
    }

    public function edit($product)
    {
        return view($this->folder . '/parts/edit', [

            'product' => $product,

            'route' => route($this->route . '.update', $product->id),
        ]);
    }

    public function update($data, $id)
    {

        $product = $this->getById($id);

        if(array_key_exists('image', $data)){

            Storage::delete('public/'.$product->image);

            $data['image'] = $data['image']->store('uploads/products', 'public');
        }

        $data['admin_id'] = auth('admin')->user()->id;
        if ($this->updateData($id, $data)) {
            return response()->json(['status' => 200]);
        } else {
            return response()->json(['status' => 405]);
        }
    }

}
