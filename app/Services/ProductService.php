<?php

namespace App\Services;

use App\Models\Product as ObjModel;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class ProductService extends BaseService
{
    protected string $folder = 'admin/product';
    protected string $route = 'products';

    public function __construct(ObjModel $model)
    {
        parent::__construct($model);
    }

    public function index($request)
    {
        if ($request->ajax()) {
            $products = $this->getDataTable();
            return DataTables::of($products)
                ->addColumn('action', function ($products) {
                    $buttons = '';
                    $buttons .= '
                            <button type="button" data-id="' . $products->id . '" class="btn btn-pill btn-info-light editBtn">
                            <i class="fa fa-edit"></i>
                            </button>
                       ';

                    $buttons .= '<button class="btn btn-pill btn-danger-light" data-bs-toggle="modal"
                        data-bs-target="#delete_modal" data-id="' . $products->id . '" data-title="' . $products->name . '">
                        <i class="fas fa-trash"></i>
                        </button>';

                    return $buttons;
                })->addColumn('image', function ($products) {
                    if ($products->image != null) {
                        return '
                    <img alt="image" onclick="window.open(this.src)" class="avatar avatar-md rounded-circle" src="' . asset('storage/' . $products->image) . '">
                    ';
                    } else {
                        return '
                    <img alt="image" onclick="window.open(this.src)" class="avatar avatar-md rounded-circle" src="' . asset('assets/uploads/avatar.png') . '">
                    ';
                    }
                })->editColumn('admin_id', function ($products) {

                    return $products->admin->user_name;
                })->editColumn('description', function ($products) {

                    return substr($products->description, 0, 20) . '...';
                })
                ->addIndexColumn()
                ->escapeColumns([])
                ->make(true);
        } else {
            return view($this->folder . '/index');
        }
    }


    public function create()
    {
        return view($this->folder . '/parts/create', [

            'route' => route($this->route . '.store'),
        ]);
    }

    public function store($data): \Illuminate\Http\JsonResponse

    {

        if($data['image'] != null){

            $data['image'] = $data['image']->store('uploads/products', 'public');
        }

        $data['admin_id'] = auth('admin')->user()->id;

        $model = $this->createData($data);
        if ($model) {
            return response()->json(['status' => 200]);
        } else {
            return response()->json(['status' => 405]);
        }
    }

    public function edit($product)
    {
        return view($this->folder . '/parts/edit', [

            'product' => $product,

            'route' => route($this->route . '.update', $product->id),
        ]);
    }

    public function update($data, $id)
    {

        $product = $this->getById($id);

        if(array_key_exists('image', $data)){

            Storage::delete('public/'.$product->image);

            $data['image'] = $data['image']->store('uploads/products', 'public');
        }

        $data['admin_id'] = auth('admin')->user()->id;
        if ($this->updateData($id, $data)) {
            return response()->json(['status' => 200]);
        } else {
            return response()->json(['status' => 405]);
        }
    }

}
