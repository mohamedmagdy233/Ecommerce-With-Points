<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Invite;
use App\Services\InviteService as ObjService;
use Illuminate\Http\Request;

class InviteController extends Controller
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


    public function store(Request $request)
    {
        return $this->objService->store($request->all());
    }

    public function register($code)
    {
        return $this->objService->register($code);

    }

    public function destroy($id)
    {
        return $this->objService->delete($id);
    }

    public function edit($id)
    {
        return $this->objService->edit($id);

    }


    public function update($id, Request $request)
    {
        return $this->objService->update($id, $request->all());
    }
}
