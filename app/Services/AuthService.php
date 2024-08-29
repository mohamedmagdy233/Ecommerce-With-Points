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

        $admin = Admin::where('user_name', $data['input'])->first();
        $credentials = [];
        if ($admin) {
            $credentials['user_name'] = $data['input'];
        } else {
            $credentials['code'] = $data['input'];
        }
        $credentials['password'] = $data['password'];



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
