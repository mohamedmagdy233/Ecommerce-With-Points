<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Services\CustomerService as ObjService;

class CustomerController extends Controller
{

    public function __construct(protected ObjService $objService)
    {

    }

    public function index(Request $request)
    {
        return $this->objService->index($request);
    }

    public function create()
    {
        return $this->objService->create();
    }

    public function store(CustomerRequest $request)
    {
        return $this->objService->store($request->all());
    }

    public function edit(Customer $customer)
    {
        return $this->objService->edit($customer);
    }

    public function update(CustomerRequest $request , $id)
    {
        return $this->objService->update($request->all()  , $id);

    }

    public function destroy($id)
    {
        return $this->objService->delete($id);

    }
}
