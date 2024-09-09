<?php

namespace App\Services\user;

use App\Models\cart;
use App\Models\Contact;
use App\Models\Customer;
use App\Models\Fav;
use App\Models\TransferPoints;
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
        $customerFrom->save();

        $customerTo = Customer::find($data['to_id']);
        $customerTo->points += $data['points'];
        $customerTo->save();


        $transferPoints=TransferPoints::create($data);

        return redirect('/')->with('success', 'تمت العملية بنجاح');

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


    public function addOrder ($request)
    {

    {
        $customer = Auth::guard('web')->user();

        if (!$customer) {
            return redirect('/')->with('error', 'يجب تسجيل الدخول');
        }

        $validatedData = $request->validate([
            'product_ids' => 'required|array',
            'product_ids.*' => 'exists:products,id',
            'quantity' => 'required|array',
            'quantity.*' => 'integer|min:1',
            'total_price' => 'required|numeric|min:0',
            'address' => 'nullable|string',
        ], [
            'product_ids.*.exists' => 'هذا المنتج غير موجود',
            'quantity.*.integer' => 'الكمية يجب ان تكون عدد صحيح',
            'quantity.*.min' => 'الكمية يجب ان تكون على الأقل واحد',
            'total_price.numeric' => 'السعر يجب ان يكون رقم',
            'total_price.min' => 'السعر يجب ان يكون على الأقل صفر',
        ]);

        // Extract validated data
        $product_ids = $validatedData['product_ids'];
        $quantities = $validatedData['quantity'];
        $use_points = $validatedData['use_points'] ?? 0;
        $total_price = $validatedData['total_price'];
        $address = $validatedData['address'];
        $total_award_points = $validatedData['total_award_points'] ?? 0;

        if ($customer->points < $use_points) {
            return response()->json(['status' => 400, 'message' => 'Insufficient points.']);
        }

        $customer->points -= $use_points;
        $customer->save();

        // Create a new order
        $order = new Order(); // Assuming Order is the model for orders
        $order->customer_id = $customer->id; // Use authenticated customer's ID
        $order->address = $address;
        $order->use_points = $use_points;
        $order->status = 'pending';
        $order->total = $total_price;
        $order->lastPointOfOrder = $total_award_points;
        $order->save();

        // Loop through product_ids and quantities
        foreach ($product_ids as $product_id) {
            $product = Product::find($product_id);
            $product->quantity -= $quantities[$product_id];
            $product->save();

            // Attach product to order with quantity and price
            $order->products()->attach($product_id, [
                'quantity' => $quantities[$product_id],
                'price' => $product->price,
                'total_price' => $product->price * $quantities[$product_id]
            ]);
        }

        // Update customer's award points
        $customer->points += $total_award_points;
        $customer->save();

        return redirect()->route('orders.index')->with('success', 'Your order has been placed successfully.');
    }
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
        }else
        {
            $carts = [];
            $total = 0;

        }


        return view($this->folder . '/parts/checkout',[
            'carts' => $carts,
            'total' => $total
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

    public function index()
    {
        $products=$this->productService->getAll();
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
