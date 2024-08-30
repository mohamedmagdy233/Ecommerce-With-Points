<?php

namespace App\Services;

use App\Models\Category as ObjModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class CategoryService extends BaseService
{
    protected string $folder = 'admin/category';
    protected string $route = 'categories';

    public function __construct(ObjModel $model)
    {
        parent::__construct($model);
    }

    public function index($request)
    {
        if ($request->ajax()) {
            $categories = $this->getDataTable();
            return DataTables::of($categories)
                ->addColumn('action', function ($categories) {
                    $buttons = '';

                    if (auth()->user()->can('edit_category')) {

                        $buttons .= '
                            <button type="button" data-id="' . $categories->id . '" class="btn btn-pill btn-info-light editBtn">
                            <i class="fa fa-edit"></i>
                            </button>
                       ';

                    }
                    if (auth()->user()->can('delete_category')) {

                        $buttons .= '<button class="btn btn-pill btn-danger-light" data-bs-toggle="modal"
                        data-bs-target="#delete_modal" data-id="' . $categories->id . '" data-title="' . $categories->name . '">
                        <i class="fas fa-trash"></i>
                        </button>';

                    }

                    return $buttons;
                })->editColumn('admin_id', function ($categories) {
                    return $categories->admin->name;
                })->editColumn('image', function ($categories) {
                    if ($categories->image != null) {
                        return '
                    <img alt="image" onclick="window.open(this.src)" class="avatar avatar-md rounded-circle" src="' . asset('storage/' . $categories->image) . '">
                    ';
                    } else {
                        return '
                    <img alt="image" onclick="window.open(this.src)" class="avatar avatar-md rounded-circle" src="' . asset('assets/uploads/avatar.png') . '">
                    ';
                    }
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
        return view($this->folder . '/parts/create',[

            'route' => route($this->route . '.store'),
        ]);
    }

    public function store($data): \Illuminate\Http\JsonResponse
    {
        $data['slug']=$this->generateCode();

        $data['admin_id'] = auth('admin')->user()->id;

        if (array_key_exists('image', $data)) {
            $data['image'] = $data['image']->store('uploads/categories', 'public');
        }

        $model = $this->createData($data);
        if ($model) {
            return response()->json(['status' => 200]);
        } else {
            return response()->json(['status' => 405]);
        }
    }
    protected function generateCode(): string
    {
        do {
            $slug = Str::random(11);
        } while ($this->firstWhere(['slug' => $slug]));

        return $slug;
    }

    public function edit($category)
    {
        return view($this->folder . '/parts/edit',[

            'category' => $category,
            'route' => route($this->route . '.update', $category->id),
        ]);
    }

    public function update($data ,$id)
    {
        $category=$this->getById($id);

        $data['slug']=$this->generateCode();

        $data['admin_id'] = auth('admin')->user()->id;

        if (array_key_exists('image', $data)) {

            if ($category->image != null) {
                Storage::delete('public/' . $category->image);
            }

            $data['image'] = $data['image']->store('uploads/categories', 'public');
        }

        if ($this->updateData($id, $data)) {
            return response()->json(['status' => 200]);
        } else {
            return response()->json(['status' => 405]);
        }
    }

}
