<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\user\LoginRequest;
use App\Services\user\mainService as objService;

class MainController extends Controller
{
   public function __construct(protected objService $objService)
   {

   }

   public function ShowLoginForm(){

       return $this->objService->ShowLoginForm();
   }

   public function showRegisterForm(){

       return $this->objService->showRegisterForm();
   }

   public function login(LoginRequest $request){

       return $this->objService->login($request);
   }

   public function registerNewCustomer(RegisterRequest $request){

       return $this->objService->registerNewCustomer($request->all());
   }










   public function logout(){

       return $this->objService->logout();
   }


}
