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
       $order = $this->service->getById($id);
       $customer = $order->customer;
        $customer->points= $customer->points - $order->lastPointOfOrder;
        $customer->save();

        return $this->service->delete($id);
    }

    public function showOrder(Request $request)
    {
        return $this->service->showOrder($request);

    }

    public function changeOrderStatus($id)
    {
        return $this->service->changeOrderStatus($id);

    }

    public function updateStatus(Request $request)
    {
        return $this->service->updateStatus($request);

    }

    public function deleteSelected(Request $request)
    {
        $ids = $request->input('ids', []);
        return $this->service->destroySelected($ids);

    }
}
