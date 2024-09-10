<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\user\LoginRequest;
use App\Services\user\mainService as objService;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function __construct(protected objService $objService)
    {

    }

    public function ShowLoginForm()
    {

        return $this->objService->ShowLoginForm();
    }

    public function showRegisterForm()
    {

        return $this->objService->showRegisterForm();
    }

    public function login(Request $request)
    {

        return $this->objService->login($request);
    }

    public function registerNewCustomer(Request $request )
    {
        $userId = $request->user_id;
        $data = $request->all();
        $data['user_id'] = $userId;

        return $this->objService->registerNewCustomer($data);
    }

    public function updateProfile(Request $request)
    {

        return $this->objService->updateProfile($request);

    }

    public function transferPoints()
    {

        return $this->objService->transferPoints();

    }

    public function storeTransferPoints(Request $request)
    {

        return $this->objService->storeTransferPoints($request->all());

    }

    public function deleteTransferPoints($id)
    {

        return $this->objService->deleteTransferPoints($id);

    }

    public function referralCustomers()
    {

        return $this->objService->referralCustomers();

    }


    public function logout()
    {

        return $this->objService->logout();
    }

    public function editProfile()
    {

        return $this->objService->editProfile();

    }


    Public function index()
    {
        return $this->objService->index();
    }

    public function showProductsInSlider($type = 'slider')
    {

        return $this->objService->showProducts($type);

    }

    public function productDetails($id)
    {


        return $this->objService->productDetails($id);

    }

    public function allProducts()
    {

        return $this->objService->allProducts();

    }

    public function addToCart(Request $request)
    {


        return $this->objService->addToCart($request);



    }

    public function addOneProductToCart($id)
    {

        return $this->objService->addOneProductToCart($id);

    }

    public function updateQuantityOfCart(Request $request)
    {

        return $this->objService->updateQuantityOfCart($request);

    }

    public function deleteFromCart($id)
    {

        return $this->objService->deleteFromCart($id);

    }

    public function showCart()
    {


        return $this->objService->showCart();



    }

    public function showCheckout()
    {

        return $this->objService->showCheckout();

    }

    public function productsByCategory($id)
    {

        return $this->objService->productsByCategory($id);


    }

    public function addToFav($id)
    {

        return $this->objService->addToFav($id);

    }

    public function getWishlist()
    {

        return $this->objService->getWishlist();

    }

    public function myPoints()
    {

        return $this->objService->myPoints();

    }

    public function addOrder(Request $request)
    {

        return $this->objService->addOrder($request);

    }

    public function myOrders()
    {

        return $this->objService->myOrders();

    }

    public function deleteOrder($id)
    {

        return $this->objService->deleteOrder($id);


    }


    public function ShowContact()
    {

        return $this->objService->ShowContact();
    }

    public function about()
    {

        return $this->objService->about();

    }

    public function storeContact(Request $request)
    {

        return $this->objService->storeContact($request);
    }

    public function termsAndPrivacyAndFaqs()
    {

        return $this->objService->termsAndPrivacyAndFaqs();

    }


}
