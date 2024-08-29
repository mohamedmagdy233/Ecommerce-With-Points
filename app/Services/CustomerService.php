<?php

namespace App\Services;

use App\Models\Customer as ObjModel;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class CustomerService extends BaseService
{
    protected string $folder = 'admin/customer';
    protected string $route = 'customers';

    public function __construct(ObjModel $model)
    {
        parent::__construct($model);
    }

    public function index($request)
    {
        if ($request->ajax()) {
            $customers = $this->getDataTable();
            return DataTables::of($customers)
                ->addColumn('action', function ($customers) {
                    $buttons = '';
                        $buttons .= '
                            <button type="button" data-id="' . $customers->id . '" class="btn btn-pill btn-info-light editBtn">
                            <i class="fa fa-edit"></i>
                            </button>
                       ';

                        $buttons .= '<button class="btn btn-pill btn-danger-light" data-bs-toggle="modal"
                        data-bs-target="#delete_modal" data-id="' . $customers->id . '" data-title="' . $customers->name . '">
                        <i class="fas fa-trash"></i>
                        </button>';

                    return $buttons;
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
        $data['referral_code']=$this->generateCode();
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
            $referral_code = Str::random(11);
        } while ($this->firstWhere(['referral_code' => $referral_code]));

        return $referral_code;
    }

    public function edit($customer)
    {
        return view($this->folder . '/parts/edit',[

            'customer' => $customer,
            'route' => route($this->route . '.update', $customer->id),
        ]);
    }

    public function update($data ,$id)
    {
        if ($this->updateData($id, $data)) {
            return response()->json(['status' => 200]);
        } else {
            return response()->json(['status' => 405]);
        }
    }

}
