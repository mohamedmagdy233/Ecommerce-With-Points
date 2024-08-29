<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransferRequest;
use App\Models\TransferPoints;
use Illuminate\Http\Request;
use App\Services\TransferPointsService as ObjService;

class TransferPointsController extends Controller
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

    public function store(TransferRequest $request)
    {
        return $this->objService->store($request->all());
    }

//    public function edit($id){
//
//        return $this->objService->edit($id);
//    }
}
