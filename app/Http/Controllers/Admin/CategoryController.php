<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

use  App\Services\CategoryService as ObjService;

class CategoryController extends Controller
{

    public function __construct( protected ObjService $service){

    }


    public function index(Request $request){

        return $this->service->index($request);
    }


    public function create(){
        return $this->service->create();
    }

    public function store(CategoryRequest $request){
        return $this->service->store($request->all());
    }


    public function edit(Category $category){
        return $this->service->edit($category);
    }


    public function update(CategoryRequest $request, $id){
        return $this->service->update($request->all(), $id);
    }

    public function destroy($id){

        return $this->service->delete($id);
    }

    public function massDeleteCategories(Request $request)
    {
        $ids = $request->input('ids', []);
        return $this->service->deleteAll($ids);

    }
}
