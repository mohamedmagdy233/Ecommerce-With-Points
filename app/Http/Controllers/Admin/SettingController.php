<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest as ObjRequest;
use App\Services\SettingService as ObjService;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    public function __construct(protected ObjService $objService){
    }


    public function index()
    {
        return $this->objService->index();
    } // index

    public function update(Request $request)
    {
//        $data = $request->validated();
        return $this->objService->update($request->all());
    }
}
