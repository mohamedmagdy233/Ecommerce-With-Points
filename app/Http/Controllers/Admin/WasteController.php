<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\WasteRequest;
use App\Models\Waste;
use Illuminate\Http\Request;

use  App\Services\WasteService as ObjService;

class WasteController extends Controller
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


    public function store(WasteRequest $request)
    {
        return $this->objService->store($request->all());
    }

    public function edit(Waste $waste) {

        return $this->objService->edit($waste);
    }


    public function update(WasteRequest $request, $id)
    {
        return $this->objService->update($request->all(), $id);
    }


    public function destroy($id)
    {
        return $this->objService->delete($id);
    }
}
