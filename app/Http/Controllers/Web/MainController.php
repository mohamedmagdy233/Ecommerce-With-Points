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

    public function registerNewCustomer(RegisterRequest $request)
    {

        return $this->objService->registerNewCustomer($request->all());
    }


    public function logout()
    {

        return $this->objService->logout();
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

    public function addToCart($id)
    {


    }

    public function productsByCategory($id)
    {

        return $this->objService->productsByCategory($id);


    }

    public function addToFav($id)
    {


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


}
