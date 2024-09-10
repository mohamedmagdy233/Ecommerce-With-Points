<?php

namespace App\Services\user;

use App\Models\cart;
use App\Models\Contact;
use App\Models\Customer;
use App\Models\Fav;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\TransferPoints;
use App\Models\Waste;
use App\Models\Waste as ObjModel;
use App\Services\BaseService;
use App\Services\CategoryService;
use App\Services\CustomerService;
use App\Services\ProductService;
use App\Services\WasteSectionService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class mainService extends BaseService
{
    protected string $folder = 'user';
//    protected string $route = 'wastes';
    public function __construct(ObjModel $model ,protected CustomerService $customerService ,protected ProductService $productService,protected CategoryService $categoryService)
    {
        parent::__construct($model);
    }




    public function ShowLoginForm()
    {
        return view($this->folder . '/auth/login');

    }

    public function showRegisterForm()
    {
        return view($this->folder . '/auth/register');

    }

    public function login($data){

        $validator = Validator::make($data->all(), [
            'phone' => 'required|exists:customers,phone',
            'password' => 'required',
        ], [
            'phone.required' => 'يجب ادخال رقم الهاتف',
            'phone.exists' => 'رقم الهاتف غير صحيح',
            'password.required' => 'يجب ادخال كلمة المرور',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->with('error', 'حدث خطأ');
        }

       $customer=$this->customerService->getByPhone($data['phone']);

       if($customer){

           if (Hash::check($data['password'], $customer->password)) {
               Auth::login($customer);
               return redirect()->route('main.index')->with(['success' => 'تم تسجيل الدخول بنجاح']);
           }

       }

    }


    public function registerNewCustomer($data ){

        if (isset($data['user_id'])) {
            $data['customer_id'] = $data['user_id'];
        }

        $data['password'] = Hash::make($data['password']);
        $data['referral_code'] = $this->customerService->generateCode();


        $customer = $this->customerService->createData($data);





        if($customer){
            Auth::login($customer);
            return redirect()->route('main.index')->with(['success' => 'تم التسجيل بنجاح']);
        }else{
            return redirect()->back()->with(['error' => 'حدث خطأ ما']);
        }
    }

    public function updateProfile($data)
    {
        $validator = Validator::make($data->all(), [
            'name' => 'nullable',
            'phone' => 'nullable|exists:customers,phone',
            'password' => 'nullable|min:6|confirmed',
            'address' => 'nullable',

        ], [
            'name.required' => 'يجب ادخال الاسم',
            'phone.exists' => 'رقم الهاتف غير صحيح',
            'password.confirmed' => 'كلمة المرور غير متطابقة',
            'password.min' => 'يجب ان تكون كلمة المرور على الاقل 6 حروف',
            'address.required' => 'يجب ادخال العنوان',
        ]);


        $customer = Auth::guard('web')->user();
        if ($data->has('password')) {
        $data['password'] = Hash::make($data['password']);

        }


        $customer->update($data->all());
        return redirect('/')->with(['success' => 'تم تحديث الملف الشخصي بنجاح']);

    }

    public function transferPoints()
    {
         $customers = Customer::where('id','!=',auth('web')->user()->id)->get();
         $transferPoints=TransferPoints::where('from_id',auth('web')->user()->id)
//                                      ->orWhere('to_id',auth('web')->user()->id)
                                      ->get();
        if (auth('web')->check()) {
            $carts = cart::with('product')->where('customer_id', auth('web')->user()->id)->get();
            $total =   $carts->sum(function ($item) {
                $item->total = $item->product->price * $item->quantity;

                return  $item->total;
            });
        }else
        {
            $carts = [];
            $total = 0;

        }
        return view($this->folder . '/parts/transferPoints',[
            'customers' => $customers,
            'carts' => $carts,
            'total' => $total,
            'transferPoints' => $transferPoints
        ]);

    }

    public function storeTransferPoints($data)
    {

        $data['from_id']=auth('web')->user()->id;

        $customerFrom = Customer::find($data['from_id']);
        if ($data['points'] > $customerFrom->points) {

            return redirect('/')->with('error', 'لا يوجد نقاط كافية');
        }
        $customerFrom->points -= $data['points'];
        $customerFrom->pointsFromWhere='عمليه تحويل نقاط';
        $customerFrom->save();

        $customerTo = Customer::find($data['to_id']);
        $customerTo->points += $data['points'];
        $customerTo->save();


        TransferPoints::create($data);

        return redirect('transfer/points')->with('success', 'تمت العملية بنجاح');

    }

    public function deleteTransferPoints($id)
    {

        $transferPoints=TransferPoints::find($id);
        $returnPointsToCustomerFrom=Customer::find($transferPoints->from_id);
        $returnPointsToCustomerFrom->points += $transferPoints->points;
        $returnPointsToCustomerFrom->save();

        $returnPointsFromCustomerTo=Customer::find($transferPoints->to_id);
        $returnPointsFromCustomerTo->points -= $transferPoints->points;
        $returnPointsFromCustomerTo->save();

        $transferPoints->delete();
        return redirect('/')->with('success', 'تمت العملية بنجاح');

    }

    public function referralCustomers()
    {

        $customer = Auth::guard('web')->user();
        $relatedCustomers =Customer::where('customer_id',$customer->id)->get();
        if (auth('web')->check()) {
            $carts = cart::with('product')->where('customer_id', auth('web')->user()->id)->get();
            $total =   $carts->sum(function ($item) {
                $item->total = $item->product->price * $item->quantity;

                return  $item->total;
            });
        }else
        {
            $carts = [];
            $total = 0;

        }

        return view($this->folder . '/parts/referralCustomers', [
            'relatedCustomers' => $relatedCustomers,
            'carts' => $carts,
            'total' => $total
        ]);

    }


    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('main.index');
    }

    public function editProfile()
    {
        $customer = Auth::guard('web')->user();
        if (auth('web')->check()) {
            $carts = cart::with('product')->where('customer_id', auth('web')->user()->id)->get();
            $total =   $carts->sum(function ($item) {
                $item->total = $item->product->price * $item->quantity;

                return  $item->total;
            });
        }else
        {
            $carts = [];
            $total = 0;

        }
        return view($this->folder . '/parts/myProfile', [
            'customer' => $customer,
            'carts' => $carts,
            'total' => $total
        ]);

    }






//    public function showProducts($type)
//    {
//        $products=$this->productService->getAll();
//        if ($type=='slider') {
//            return view($this->folder . '/parts/slider',[
//                'products' => $products,
//            ]);
//        }
//
//
//
//    }

    public function productDetails($id)
    {
        $productDetails=$this->productService->getById($id);
        $relatedProducts=$this->productService->getRelatedProducts();
        if (auth('web')->check()) {
            $carts = cart::with('product')->where('customer_id', auth('web')->user()->id)->get();
            $total =   $carts->sum(function ($item) {
                $item->total = $item->product->price * $item->quantity;

                return  $item->total;
            });
        }else
        {
            $carts = [];
            $total = 0;

        }
            return view($this->folder . '/parts/product-details',[
            'productDetails' => $productDetails,
            'relatedProducts' => $relatedProducts,
            'carts' => $carts,
            'total' => $total
        ]);

    }

    public function addToCart($request)
    {
        $vaildator = Validator::make($request->all(), [
            'quantity' => 'required',
            'product_id' => 'required|exists:products,id',
        ], [
            'quantity.required' => 'يجب ادخال الكمية',
            'product_id.required' => 'يجب ادخال المنتج',
            'product_id.exists' => 'المنتج غير موجود',
        ]);
        if ($vaildator->fails()) {
            return redirect('/')->withErrors($vaildator)->with('error', 'حدث خطأ ما');
        }

        $cart= cart::where('product_id', $request->product_id)
            ->where('customer_id', auth('web')->user()->id)
            ->first();


        if ($cart){

            $cart->update([
                'quantity' =>$cart->quantity + $request->quantity
            ]);
            return redirect('/')->with('success', 'تم التعديل بنجاح');
        }

        $addToCart = cart::create([

            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'customer_id' => auth('web')->user()->id,
        ]);

        if ($addToCart) {
            return redirect('/')->with('success', 'تم الاضافة بنجاح');


        }



    }


    public function addOrder( $request)
    {

//        return $request;
        $customer = Auth::guard('web')->user();

        if (!$customer) {
            return redirect('/')->with('error', 'يجب تسجيل الدخول');
        }

        $validatedData = $request->validate([
            'product_ids' => 'required|array',
            'product_ids.*' => 'exists:products,id',
            'quantities' => 'required|array',
            'quantities.*' => 'integer|min:1',
            'total_price' => 'required|numeric|min:0',
            'address' => 'nullable|string',
            'use_points' => 'nullable|integer|min:0',
            'award_points' => 'nullable|integer|min:0',
        ], [
            'product_ids.*.exists' => 'هذا المنتج غير موجود',
            'quantities.*.integer' => 'الكمية يجب ان تكون عدد صحيح',
            'quantities.*.min' => 'الكمية يجب ان تكون على الأقل واحد',
            'total_price.numeric' => 'السعر يجب ان يكون رقم',
            'total_price.min' => 'السعر يجب ان يكون على الأقل صفر',
            'use_points.integer' => 'نقاط الاستخدام يجب أن تكون رقم صحيح',
            'award_points.integer' => 'النقاط المكتسبة يجب أن تكون رقم صحيح',
        ]);

        // Extract validated data
        $product_ids = $validatedData['product_ids'];
        $quantities = $validatedData['quantities'];
        $use_points = $validatedData['use_points'] ?? 0;
        $total_price = $validatedData['total_price'];
        $address = $validatedData['address']?? null;
        $award_points = $validatedData['award_points'] ?? 0;

        // Check if customer has enough points
        if ($use_points > 0 && $customer->points < $use_points) {
            return redirect()->back()->with('error', 'لا يوجد نقاط كافية.');
        }

        // Deduct used points from customer
        $customer->points -= $use_points;
        $customer->save();

        // Create a new order
        $order = new Order();
        $order->customer_id = $customer->id;
        $order->address = $address;
        $order->use_points = $use_points;
        $order->status = 'pending';
        $order->total = $total_price;
        $order->lastPointOfOrder = $award_points;
        $order->save();

        foreach ($product_ids as $index => $product_id) {
            $product = Product::find($product_id);

            if ($product) {
                $product->quantity -= $quantities[$index];
                $product->save();

                $order->products()->attach($product_id, [
                    'quantity' => $quantities[$index],
                    'price' => $product->price,
                    'total_price' => $product->price * $quantities[$index]
                ]);
            }
        }

        $customer->points += $award_points;
        if ($customer->customer_id !== null) {
            $parent_customer = Customer::find($customer->customer_id);
            $parent_customer->points += $award_points;
            $parent_customer->save();
        }
        $customer->save();

        $emptyCart = cart::where('customer_id', $customer->id)->get();

        foreach ($emptyCart as $item) {
            $item->delete();
        }

        return redirect('/')->with('success', 'تم تأكيد طلبك بنجاح.');
    }

    public function myOrders()
    {

        $myOrders=Order::where('customer_id',auth('web')->user()->id)
            ->with('products')
            ->get();

        if (auth('web')->check()) {
            $carts = cart::with('product')->where('customer_id', auth('web')->user()->id)->get();
            $total =   $carts->sum(function ($item) {
                $item->total = $item->product->price * $item->quantity;

                return  $item->total;
            });
        }else
        {
            $carts = [];
            $total = 0;

        }

        return view($this->folder.'/parts/my_orders',[
            'myOrders' => $myOrders,
            'carts' => $carts,
            'total' => $total
        ]);

    }


    public function deleteOrder($id)
    {

        $order = Order::find($id);
        $lastPointOfOrder = $order->lastPointOfOrder;

        $customer = Customer::find($order->customer_id);
        $customer->points -= $lastPointOfOrder;
        $customer->points += $order->use_points;
        $customer->save();
        if ($customer->customer_id !== null) {
            $parent_customer = Customer::find($customer->customer_id);
            $parent_customer->points -= $lastPointOfOrder;

            $parent_customer->save();
        }

        $orderProducts = OrderProduct::where('order_id', $id)->get();
        foreach ($orderProducts as $orderProduct) {
          $orderProduct->delete();
        }

        $order->delete();

        return redirect()->back()->with('success', 'تم حذف الطلب بنجاح.');
    }


    public function addToFav($id)
    {

        $fav = Fav::where('product_id', $id)->where('customer_id', auth('web')->user()->id)->first();
        if (!$fav) {
            $fav = new Fav();
            $fav->product_id = $id;
            $fav->customer_id = auth('web')->user()->id;
            $fav->save();

            return response()->json(['status' => 200]);

        } else {
            $fav->delete();

            return response()->json(['status' => 201]);
        }


    }


    public function addOneProductToCart($id)
    {

        $product = $this->productService->getById($id);

        if (auth('web')->check()) {

            $cart= cart::where('product_id', $id)
                ->where('customer_id', auth('web')->user()->id)
                ->first();


            if ($cart){

                $cart->update([
                    'quantity' =>$cart->quantity + 1
                ]);
                return redirect('/')->with('success', 'تم التعديل بنجاح');
            }
            $cart = cart::create([
                'product_id' => $product->id,
                'quantity' => 1,
                'customer_id' => auth('web')->user()->id,
            ]);
            if ($cart) {
                return redirect('/')->with('success', 'تم الاضافة بنجاح');
            } else {
                return redirect('/')->with('error', 'حدث خطأ ما');
            }
        }


    }

    public function updateQuantityOfCart($request)
    {

        $cart = cart::where('product_id', $request->product_id)
            ->where('customer_id', auth('web')->user()->id)
            ->first();

        if ($cart) {
            $cart->update([
                'quantity' => $request->quantity
            ]);
            return response()->json(['status' => 200]);
        }

        return response()->json(['status' => 201]);

    }

    public function showCheckout()
    {
        if (auth('web')->check()) {
            $carts = cart::with('product')->where('customer_id', auth('web')->user()->id)->get();
            $total =   $carts->sum(function ($item) {
                $item->total = $item->product->price * $item->quantity;

                return  $item->total;
            });
            $award_points = $carts->sum(function ($item) {
                $item->award_points = $item->product->award_points * $item->quantity;

                return  $item->award_points;
            });
        }else
        {
            $carts = [];
            $total = 0;
            $award_points = 0;


        }




        return view($this->folder . '/parts/checkout',[
            'carts' => $carts,
            'total' => $total,
            'award_points' => $award_points
        ]);


    }

    public function deleteFromCart($id)
    {

        $cart = cart::where('product_id', $id)->where('customer_id', auth('web')->user()->id)->first();

        if ($cart) {
            $cart->delete();
            return response()->json(['status' => 200]);
        }

    }


    public function showCart()
    {

        $carts = cart::with('product')->where('customer_id', auth('web')->user()->id)->get();

        if (!$carts){

            $carts = [];
        }




        return view($this->folder . '/parts/cart',[
            'carts' => $carts
        ]);

    }

    public function getWishlist()
    {

        $fav = Fav::where('customer_id', auth('web')->user()->id)->get();
        $products = [];
        if (auth('web')->check()) {
            $carts = cart::with('product')->where('customer_id', auth('web')->user()->id)->get();
            $total =   $carts->sum(function ($item) {
                $item->total = $item->product->price * $item->quantity;

                return  $item->total;
            });
        }else
        {
            $carts = [];
            $total = 0;

        }

        foreach ($fav as $item) {
            array_push($products, $this->productService->getById($item->product_id));
        }

        return view($this->folder . '/parts/wishlist',[
            'products' => $products,
            'carts' => $carts,
            'total' => $total
        ]);

    }


    public function myPoints()
    {
        $pointsFromWaste=Waste::where('customer_id',auth('web')->user()->id)->get();
        $myOrders=Order::where('customer_id',auth('web')->user()->id)
            ->with('products')
            ->get();

       $customers = Customer::where('customer_id','=',auth('web')->user()->id)->get();
       if ($customers->count() != 0) {
       foreach ($customers as $customer) {

               $orderFromSubCustomer=Order::where('customer_id',$customer->id)
                   ->with('products')
                   ->get();


       }
   }else
   {
       $orderFromSubCustomer=[];
   }



        $pointsFromTransferPoints=TransferPoints::where('to_id',auth('web')->user()->id)->get();
        if (auth('web')->check()) {
            $carts = cart::with('product')->where('customer_id', auth('web')->user()->id)->get();
            $total =   $carts->sum(function ($item) {
                $item->total = $item->product->price * $item->quantity;

                return  $item->total;
            });
        }else
        {
            $carts = [];
            $total = 0;

        }
        return view($this->folder . '/parts/my_points',[
            'pointsFromWaste' => $pointsFromWaste,
            'pointsFromTransferPoints' => $pointsFromTransferPoints,
            'carts' => $carts,
            'total' => $total,
            'myOrders' => $myOrders,
            'orderFromSubCustomer' => $orderFromSubCustomer
        ]);

    }

    public function index()
    {
        $products=$this->productService->getAll();
        $products=$products->take(8);
        $bestSellers=$this->productService->getBestSellers();
        $categories=$this->categoryService->getAll();
        if (auth('web')->check()) {
            $carts = cart::with('product')->where('customer_id', auth('web')->user()->id)->get();
         $total =   $carts->sum(function ($item) {
                $item->total = $item->product->price * $item->quantity;

                return  $item->total;
            });
        }else
        {
            $carts = [];
            $total = 0;

        }








        return view($this->folder . '/index',[
            'products' => $products,
            'bestSellers' => $bestSellers,
            'categories' => $categories,
            'carts' => $carts,
            'total' => $total
        ]);

    }


    public function allProducts()
    {
        $products=$this->productService->getAll();
        if (auth('web')->check()) {
            $carts = cart::with('product')->where('customer_id', auth('web')->user()->id)->get();
            $total =   $carts->sum(function ($item) {
                $item->total = $item->product->price * $item->quantity;

                return  $item->total;
            });
        }else
        {
            $carts = [];
            $total = 0;

        }
        return view($this->folder . '/parts/all-products',[
            'products' => $products,
            'carts' => $carts,
            'total' => $total
        ]);

    }

    public function productsByCategory($id)
    {
        $products=$this->productService->getByCategoryId($id);
        $category=$this->categoryService->getById($id);
        if (auth('web')->check()) {
            $carts = cart::with('product')->where('customer_id', auth('web')->user()->id)->get();
            $total =   $carts->sum(function ($item) {
                $item->total = $item->product->price * $item->quantity;

                return  $item->total;
            });
        }else
        {
            $carts = [];
            $total = 0;

        }

        return view($this->folder . '/parts/products-by-category',[
            'products' => $products,
            'category' => $category,
            'carts' => $carts,
            'total' => $total
        ]);

    }


    public function ShowContact()
    {
        if (auth('web')->check()) {
            $carts = cart::with('product')->where('customer_id', auth('web')->user()->id)->get();
            $total =   $carts->sum(function ($item) {
                $item->total = $item->product->price * $item->quantity;

                return  $item->total;
            });
        }else
        {
            $carts = [];
            $total = 0;

        }

        return view($this->folder . '/parts/contact',[
            'carts' => $carts,
            'total' => $total
        ]);

    }

    public function storeContact($request)
    {
        $data=$request->all();

       Contact::create($data);

        return redirect()->route('main.index')->with('success', 'تم الإرسال بنجاح');

    }

    public function about()
    {
        if (auth('web')->check()) {
            $carts = cart::with('product')->where('customer_id', auth('web')->user()->id)->get();
            $total =   $carts->sum(function ($item) {
                $item->total = $item->product->price * $item->quantity;

                return  $item->total;
            });
        }else
        {
            $carts = [];
            $total = 0;

        }
        return view($this->folder . '/parts/about',[
            'carts' => $carts,
            'total' => $total
        ]);

    }

    public function termsAndPrivacyAndFaqs()
    {
        if (auth('web')->check()) {
            $carts = cart::with('product')->where('customer_id', auth('web')->user()->id)->get();
            $total =   $carts->sum(function ($item) {
                $item->total = $item->product->price * $item->quantity;

                return  $item->total;
            });
        }else
        {
            $carts = [];
            $total = 0;

        }
        return view($this->folder . '/parts/termsAndPrivacyAndFaqs',[
            'carts' => $carts,
            'total' => $total
        ]);

    }














































    public function create()
    {
        return view($this->folder . '/parts/create',[
             'customers' => $this->customerService->getAll(),
            'wasteSections' => $this->wasteSectionService->getAll(),
            'route' => route($this->route . '.store'),
        ]);
    }

    public function store($data): \Illuminate\Http\JsonResponse
    {
        $customer = $this->customerService->getById($data['customer_id']);
        $customer->points = $customer->points + $data['points_transferred'] ;
        $customer->save();
        $data['admin_id'] = auth('admin')->user()->id;
        $model = $this->createData($data);
        if ($model) {
            return response()->json(['status' => 200]);
        } else {
            return response()->json(['status' => 405]);
        }
    }

    public function edit($waste)
    {
        return view($this->folder . '/parts/edit',[

            'waste' => $waste,
            'wasteSections' => $this->wasteSectionService->getAll(),
            'customers' => $this->customerService->getAll(),
            'route' => route($this->route . '.update', $waste->id),
        ]);
    }

    public function update($data ,$id)
    {
        $data['admin_id'] = auth('admin')->user()->id;
        if ($this->updateData($id, $data)) {
            return response()->json(['status' => 200]);
        } else {
            return response()->json(['status' => 405]);
        }
    }



}
