<?php

namespace App\Services;

use App\Enums\RoleEnum;
use App\Models\Customer;
use App\Models\Invite as ObjModel;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class InviteService extends BaseService
{
    protected string $folder = 'admin/invite';
    protected string $route = 'invite_links';

    public function __construct(ObjModel $model ,protected CustomerService $customerService)
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
                        $buttons .= '
                            <button type="button" data-id="' . $admins->id . '" class="btn btn-pill btn-info-light editBtn">
                            <i class="fa fa-edit"></i>
                            </button>
                       ';

                        $buttons .= '<button class="btn btn-pill btn-danger-light" data-bs-toggle="modal"
                        data-bs-target="#delete_modal" data-id="' . $admins->id . '" data-title="' . $admins->name . '">
                        <i class="fas fa-trash"></i>
                        </button>';


                    return $buttons;
                })
                ->editColumn('customer_id', function ($admins) {
                    return $admins->customer->name ?? '';
                })->editColumn('link', function ($admins) {
                    return '<a href="' . $admins->link . '" target="_blank">'.trns('click_here').'</a>';
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
        return view($this->folder . '/parts/create', [

            'customers' => $this->customerService->getAll(),
            'route' => route($this->route . '.store'),
        ]);
    }

    public function store($data): \Illuminate\Http\JsonResponse
    {
        $model = $this->createData($data);
        if ($model) {
            return response()->json(['status' => 200]);
        } else {
            return response()->json(['status' => 405]);
        }
    }

    public function register($code)
    {

        $customer=Customer::where('referral_code',$code)->first();
        $award=$this->model->where('customer_id',$customer->id)->first();
        if($customer){
            $customer->update(['points'=>$customer->points+$award->points_awarded]);
            return view($this->folder . '/parts/register',compact('customer'));



        }

    }

    public function edit($id)
    {
        return view($this->folder . '/parts/edit',[

            'customers' => $this->customerService->getAll(),
            'invite' => $this->getById($id),
            'route' => route($this->route . '.update', $id),

        ]);
    }

    public function update($id, $data)
    {

        if ($this->updateData($id, $data)) {
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
