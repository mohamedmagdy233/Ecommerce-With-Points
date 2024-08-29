<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRequest as ObjRequest;
use App\Models\Admin;
use App\Services\AdminService as ObjService;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct(protected ObjService $objService){
    }

    public function index(Request $request)
    {
        return $this->objService->index($request);
    }

    public function destroy($id)
    {
        return $this->objService->delete($id);
    }

    public function myProfile()
    {
        return $this->objService->myProfile();
    }

    public function create()
    {
        return $this->objService->create();
    }

    public function store(ObjRequest $request)
    {
        $data = $request->validated();
        return $this->objService->store($data);
    }

    public function edit(Admin $admin)
    {
        return $this->objService->edit($admin);
    }

    public function update(ObjRequest $request, $id)
    {
        $data = $request->validated();
        return $this->objService->update($id, $data);
    }
}//end class
