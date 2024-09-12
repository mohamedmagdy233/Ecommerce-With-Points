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
                    $currentAdmin = auth()->guard('admin')->user();

                    if ($admins->id != 1 || $currentAdmin->id == 1) {
                        if ($currentAdmin->can('edit_admin')) {
                            $buttons .= '
                            <button type="button" data-id="' . $admins->id . '" class="btn btn-pill btn-info-light editBtn">
                            <i class="fa fa-edit"></i>
                            </button>
                        ';
                        }
                    }

                    // Show delete button if the current admin is not the same as the listed admin and is not a super admin
                    if ($currentAdmin->id != $admins->id && $admins->id != 1) {
                        if ($currentAdmin->can('delete_admin')) {
                            $buttons .= '<button class="btn btn-pill btn-danger-light" data-bs-toggle="modal"
                        data-bs-target="#delete_modal" data-id="' . $admins->id . '" data-title="' . $admins->name . '">
                        <i class="fas fa-trash"></i>
                        </button>';
                        }
                    }

                    return $buttons;
                })
                ->addColumn('permissions', function ($admins) {
                    // Display a comma-separated list of permissions for each admin
                    return substr(implode(', ', $admins->permissions->pluck('name')->toArray()), 0, 50);
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
        // Hash the password before storing
        $data['password'] = Hash::make($data['password']);

        // Create the user data using the createData method or however you're handling user creation
        $model = $this->createData($data);

        if ($model) {
            // Assign permissions directly to the user
            if (isset($data['permissions'])) {
                $permissions = $data['permissions']; // Assuming this is an array of permission names or IDs
                $model->syncPermissions($permissions);
            }

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
            if (isset($data['permissions'])) {
                $permissions = $data['permissions']; // Assuming this is an array of permission names or IDs
                $admin->syncPermissions($permissions);
            }
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
