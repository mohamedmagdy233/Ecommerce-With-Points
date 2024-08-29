<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use  App\Services\ProductService as ObjService;

class ProductController extends Controller
{
    public function __construct(protected ObjService $objService)
    {


    }

    public function index(Request $request){
        return $this->objService->index($request);
    }

    public function create(){
        return $this->objService->create();
    }

    public function store(ProductRequest $request){
        return $this->objService->store($request->all());
    }


    public function edit(Product $product)
    {
        return $this->objService->edit($product);
    }


    public function update(ProductRequest $request, $id)
    {
        return $this->objService->update($request->all(), $id);
    }

    public function destroy($id)
    {
        return $this->objService->delete($id);

    }


}
