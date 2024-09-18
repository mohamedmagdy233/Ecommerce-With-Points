<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\wasteSectionRequest;
use App\Services\WasteSectionService as ObjService;
use Illuminate\Http\Request;

class WasteSectionController extends Controller
{
    public function __construct(    protected ObjService $service){

    }

    public function index(Request $request){
        return $this->service->index($request);
    }

    public function create(){
        return $this->service->create();
    }

    public function store(wasteSectionRequest $request){
        return $this->service->store($request->all());
    }

        public function edit($id){
        return $this->service->edit($id);
    }

    public function update(wasteSectionRequest $request, $id){
        return $this->service->update($request->all(), $id);
    }

    public function destroy($id){
        return $this->service->delete($id);
    }

    public function deleteSelected(Request $request)
    {
        $ids = $request->input('ids', []);
        return $this->service->deleteAll($ids);

    }

}
