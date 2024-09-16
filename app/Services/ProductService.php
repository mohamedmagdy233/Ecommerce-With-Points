<?php

namespace App\Services;

use App\Models\OrderProduct;
use App\Models\Product as ObjModel;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class ProductService extends BaseService
{
    protected string $folder = 'admin/product';
    protected string $route = 'products';

    public function __construct(ObjModel $model ,protected  CategoryService $categoryService)
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
                    if (auth()->user()->can('edit_product')) {
                        $buttons .= '
                <button type="button" data-id="' . htmlspecialchars($products->id, ENT_QUOTES, 'UTF-8') . '" class="btn btn-pill btn-info-light editBtn">
                <i class="fa fa-edit"></i>
                </button>
            ';
                    }
                    if (auth()->user()->can('delete_product')) {
                        $buttons .= '<button class="btn btn-pill btn-danger-light" data-bs-toggle="modal"
            data-bs-target="#delete_modal" data-id="' . htmlspecialchars($products->id, ENT_QUOTES, 'UTF-8') . '" data-title="' . htmlspecialchars($products->name, ENT_QUOTES, 'UTF-8') . '">
            <i class="fas fa-trash"></i>
            </button>';
                    }

                    return $buttons;
                })->addColumn('image', function ($products) {
                    if ($products->image != null) {
                        return '
            <img alt="image" onclick="window.open(this.src)" class="avatar avatar-md rounded-circle" src="' . htmlspecialchars(asset('storage/' . $products->image), ENT_QUOTES, 'UTF-8') . '">
            ';
                    } else {
                        return '
            <img alt="image" onclick="window.open(this.src)" class="avatar avatar-md rounded-circle" src="' . htmlspecialchars(asset('assets/uploads/avatar.png'), ENT_QUOTES, 'UTF-8') . '">
            ';
                    }
                })
                ->editColumn('admin_id', function ($products) {
                    return htmlspecialchars($products->admin->user_name, ENT_QUOTES, 'UTF-8');
                })
                ->editColumn('description', function ($products) {
                    return htmlspecialchars(substr($products->description, 0, 20), ENT_QUOTES, 'UTF-8') . '...';
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
            'categories'=> $this->categoryService->getAll(),
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

            'categories' => $this->categoryService->getAll(),

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


    public function getRelatedProducts()
    {
        $productWithCategory = $this->model->with('category')->get();


        return $productWithCategory;

    }

    public function getBestSellers()
    {

        $bestSellers = OrderProduct:: select('product_id', \DB::raw('count(*) as total'));

        $bestSellers = $bestSellers->groupBy('product_id')->orderBy('total', 'desc')->take(5)->get();
        return $bestSellers;


    }

    public function getByCategoryId($id)
    {

        $products = $this->model->where('category_id', $id)->get();
        return $products;

    }

}
