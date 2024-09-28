<?php

namespace App\Services;

use App\Models\Category as ObjModel;
use App\Models\Media;
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

        $category=ObjModel::create([
            'name' => $data['name'],
            'slug' => $this->generateCode(),
            'admin_id' => auth('admin')->user()->id,



        ]);


        if (isset($data['image'])) {
            $imagePaths = [];

            foreach ($data['image'] as $file) {
                $path = $file->store('uploads/categories', 'public');
                $imagePaths[] = $path;
            }

            $category->media()->create([
                'image' => json_encode($imagePaths),
            ]);
        }


        if ($category->save()) {
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
            'images' => $this->images($category->id),
            'route' => route($this->route . '.update', $category->id),
        ]);
    }

    public function images($id)
    {
        $media = Media::where('modelable_id', $id)->first();

        $images = json_decode($media->image, true);

        return $images;

    }

    public function update($data ,$id)
    {
        $category=$this->getById($id);


        $category->update([
            'name' => $data['name'],
            'slug' => $this->generateCode(),
            'admin_id' => auth('admin')->user()->id,

        ]);

        if (isset($data['image'])) {

            $categoryImages = Media::where('modelable_id', $id)->get();

            foreach ($categoryImages as $image) {
                $imagePaths = json_decode($image->image, true);

                if (is_array($imagePaths)) {
                    foreach ($imagePaths as $path) {
                        if (Storage::disk('public')->exists($path)) {
                            Storage::disk('public')->delete($path);
                        }
                    }
                }
                $image->delete();
            }


            if (isset($data['image'])) {
                $imagePaths = [];

                foreach ($data['image'] as $file) {
                    $path = $file->store('uploads/categories', 'public');
                    $imagePaths[] = $path;
                }

                $category->media()->create([
                    'image' => json_encode($imagePaths),
                ]);
            }


            if ($category->save()) {
                return response()->json(['status' => 200]);
            } else {
                return response()->json(['status' => 405]);
            }
        }
    }

}
