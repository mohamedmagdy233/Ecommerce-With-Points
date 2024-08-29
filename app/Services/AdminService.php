<?php

namespace App\Services;

use App\Enums\RoleEnum;
use App\Models\Admin as ObjModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class AdminService extends BaseService
{
    protected string $folder = 'admin/admin';
    protected string $route = 'admin';

    public function __construct(ObjModel $model)
    {
        parent::__construct($model);
    }

    public function index($request)
    {
        if ($request->ajax()) {
            $admins = $this->getDataTable();
            return DataTables::of($admins)
                ->addColumn('action', function ($admins) {
                    $buttons = '';
                    if ($admins->id != 1 || auth()->guard('admin')->user()->id == 1) {
                        $buttons .= '
                            <button type="button" data-id="' . $admins->id . '" class="btn btn-pill btn-info-light editBtn">
                            <i class="fa fa-edit"></i>
                            </button>
                       ';
                    }

                    if (auth()->guard('admin')->user()->id != $admins->id && $admins->id != 1) {
                        $buttons .= '<button class="btn btn-pill btn-danger-light" data-bs-toggle="modal"
                        data-bs-target="#delete_modal" data-id="' . $admins->id . '" data-title="' . $admins->name . '">
                        <i class="fas fa-trash"></i>
                        </button>';
                    }

                    return $buttons;
                })
                ->addColumn('role', function ($admins) {
                    return RoleEnum::tryFrom($admins->roles[0]->id)->lang();
                })
                ->addIndexColumn()
                ->escapeColumns([])
                ->make(true);
        } else {
            return view($this->folder . '/index');
        }
    }

    public function myProfile()
    {
        $admin = auth()->guard('admin')->user();
        return view($this->folder . '/profile', compact('admin'));
    }//end fun


    public function create()
    {
        $code = $this->generateCode();
        $roles = Role::all();
        return view($this->folder . '/parts/create', compact('code', 'roles'));
    }

    public function store($data): \Illuminate\Http\JsonResponse
    {
        $data['password'] = Hash::make($data['password']);
        $model = $this->createData($data);
        if ($model) {
            $model->assignRole($data['role_id']);
            return response()->json(['status' => 200]);
        } else {
            return response()->json(['status' => 405]);
        }
    }

    public function edit($admin)
    {
        $roles = Role::all();
        return view($this->folder . '/parts/edit', compact('admin', 'roles'));
    }

    public function update($id, $data)
    {
        $admin = $this->getById($id);

        if ($data['password'] && $data['password'] != null) {

            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        if ($this->updateData($id, $data)) {
            $admin->syncRoles($data['role_id']);
            return response()->json(['status' => 200]);
        } else {
            return response()->json(['status' => 405]);
        }
    }

    protected function generateCode(): string
    {
        do {
            $code = Str::random(11);
        } while ($this->firstWhere(['code' => $code]));

        return $code;
    }
}
