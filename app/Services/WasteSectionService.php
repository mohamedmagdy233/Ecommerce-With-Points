<?php

namespace App\Services;

use App\Models\WasteSection as ObjModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class WasteSectionService extends BaseService
{
    protected string $folder = 'admin/waste-section';
    protected string $route = 'wastes_section';

    public function __construct(ObjModel $model)
    {
        parent::__construct($model);
    }

    public function index($request)
    {
        if ($request->ajax()) {
            $wasteSection = $this->getDataTable();
            return DataTables::of($wasteSection)
                ->addColumn('action', function ($wasteSection) {
                    $buttons = '';
                    if (auth()->user()->can('edit_wastes_section')) {

                        $buttons .= '
                            <button type="button" data-id="' . $wasteSection->id . '" class="btn btn-pill btn-info-light editBtn">
                            <i class="fa fa-edit"></i>
                            </button>
                       ';
                    }

                    if (auth()->user()->can('delete_wastes_section')) {

                        $buttons .= '<button class="btn btn-pill btn-danger-light" data-bs-toggle="modal"
                        data-bs-target="#delete_modal" data-id="' . $wasteSection->id . '" data-title="' . $wasteSection->name . '">
                        <i class="fas fa-trash"></i>
                        </button>';
                    }

                    return $buttons;

                })->editColumn('image', function ($wasteSection) {

                    if ($wasteSection->image != null) {
                        return '
                    <img alt="image" onclick="window.open(this.src)" class="avatar avatar-md rounded-circle" src="' . asset('storage/' . $wasteSection->image) . '">
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
        return view($this->folder . '/parts/create', [

            'route' => route($this->route . '.store'),
        ]);
    }

    public function store($data): \Illuminate\Http\JsonResponse
    {


        if (array_key_exists('image', $data)) {
            $data['image'] = $data['image']->store('uploads/waste-section', 'public');
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

    public function edit($id)
    {
        return view($this->folder . '/parts/edit', [

            'wasteSection' => $this->getById($id),
            'route' => route($this->route . '.update', $id),
        ]);
    }

    public function update($data, $id)
    {
        $wasteSection = $this->getById($id);



        if (array_key_exists('image', $data)) {

            if ($wasteSection->image != null) {
                Storage::delete('public/' . $wasteSection->image);
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
