<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Services\OrderService as ObjService;

class OrderController extends Controller
{

    public function __construct(protected ObjService $service){


    }


    public function index(Request $request){

        return $this->service->index($request);
    }


    public function create()
    {

        return $this->service->create();

    }


    public function store(Request $request)
    {
        return $this->service->store($request);
    }


    public function edit($id)
    {
        return $this->service->edit($id);
    }


    public function update(Request $request, $id)
    {
        return $this->service->update($request, $id);
    }


    public function destroy($id)
    {
        return $this->service->delete($id);
    }
}
