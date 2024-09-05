<?php

namespace App\Services\user;

use App\Models\cart;
use App\Models\Contact;
use App\Models\Fav;
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


    public function registerNewCustomer($data){


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


    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('main.index');
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
        }else
        {
            $carts = [];
        }
            return view($this->folder . '/parts/product-details',[
            'productDetails' => $productDetails,
            'relatedProducts' => $relatedProducts,
            'carts' => $carts
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
            return redirect()->back()->withErrors($vaildator)->with('error', 'حدث خطأ ما');
        }

        $cart= cart::where('product_id', $request->product_id)
            ->where('customer_id', auth('web')->user()->id)
            ->first();


        if ($cart){

            $cart->update([
                'quantity' =>$cart->quantity + $request->quantity
            ]);
            return redirect()->back()->with('success', 'تم التعديل بنجاح');
        }

        $addToCart = cart::create([

            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'customer_id' => auth('web')->user()->id,
        ]);

        if ($addToCart) {
            return redirect()->back()->with('success', 'تم الاضافة بنجاح');


        }

        function addToFav($id)
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
    }


    public function showCart()
    {

        $carts = cart::with('product')->where('customer_id', auth('web')->user()->id)->get();




        return view($this->folder . '/parts/cart',[
            'carts' => $carts
        ]);

    }

    public function getWishlist()
    {

        $fav = Fav::where('customer_id', auth('web')->user()->id)->get();
        $products = [];
        foreach ($fav as $item) {
            array_push($products, $this->productService->getById($item->product_id));
        }

        return view($this->folder . '/parts/wishlist',[
            'products' => $products,
        ]);

    }

    public function index()
    {
        $products=$this->productService->getAll();
        $bestSellers=$this->productService->getBestSellers();
        $categories=$this->categoryService->getAll();
        if (auth('web')->check()) {
            $carts = cart::with('product')->where('customer_id', auth('web')->user()->id)->get();
        }else
        {
            $carts = [];
        }






        return view($this->folder . '/index',[
            'products' => $products,
            'bestSellers' => $bestSellers,
            'categories' => $categories,
            'carts' => $carts
        ]);

    }

    public function productsByCategory($id)
    {
        $products=$this->productService->getByCategoryId($id);
        $category=$this->categoryService->getById($id);
        if (auth('web')->check()) {
            $carts = cart::with('product')->where('customer_id', auth('web')->user()->id)->get();
        }else
        {
            $carts = [];
        }

        return view($this->folder . '/parts/products-by-category',[
            'products' => $products,
            'category' => $category,
            'carts' => $carts
        ]);

    }


    public function ShowContact()
    {
        return view($this->folder . '/parts/contact');

    }

    public function storeContact($request)
    {
        $data=$request->all();

       Contact::create($data);

        return redirect()->route('main.index')->with('success', 'تم الإرسال بنجاح');

    }

    public function about()
    {
        return view($this->folder . '/parts/about');

    }

    public function termsAndPrivacyAndFaqs()
    {
        return view($this->folder . '/parts/termsAndPrivacyAndFaqs');

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
