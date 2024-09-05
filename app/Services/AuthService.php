<?php

namespace App\Services;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function index()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('adminHome');
        }
        return view('admin.auth.login');
    }

    public function login($request): \Illuminate\Http\JsonResponse
    {

        $data = $request->validate(
            [
                'input' => 'required',
                'password' => 'required',

            ],
            [

                'password.required' => 'يرجي ادخال كلمة المرور',
            ]
        );

        $admin = Admin::where('user_name', $data['input'])
                 ->Orwhere('email',$data['input'])
                 ->first();
        $credentials = [];
        if ($admin){


            if ($admin->user_name==$data['input']) {
                $credentials['user_name'] = $data['input'];

            }elseif($admin->email==$data['input']){

                $credentials['email'] = $data['input'];

            } else {
                $credentials['code'] = $data['input'];
            }
            $credentials['password'] = $data['password'];


        }





        if (Auth::guard('admin')->attempt($credentials)) {
            return response()->json(200);
        }
        return response()->json(405);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        toastr()->info('تم تسجيل الخروج');
        return redirect()->route('admin.login');
    }
}
