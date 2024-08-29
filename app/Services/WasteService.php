<?php

namespace App\Services;

use App\Models\Waste as ObjModel;
use Yajra\DataTables\DataTables;

class WasteService extends BaseService
{
    protected string $folder = 'admin/waste';
    protected string $route = 'wastes';

    public function __construct(ObjModel $model ,protected CustomerService $customerService)
    {
        parent::__construct($model);
    }

    public function index($request)
    {
        if ($request->ajax()) {
            $wastes = $this->getDataTable();
            return DataTables::of($wastes)
                ->addColumn('action', function ($wastes) {
                    $buttons = '';
                        $buttons .= '
                            <button type="button" data-id="' . $wastes->id . '" class="btn btn-pill btn-info-light editBtn">
                            <i class="fa fa-edit"></i>
                            </button>
                       ';

                        $buttons .= '<button class="btn btn-pill btn-danger-light" data-bs-toggle="modal"
                        data-bs-target="#delete_modal" data-id="' . $wastes->id . '" data-title="' . $wastes->name . '">
                        <i class="fas fa-trash"></i>
                        </button>';

                    return $buttons;
                })->editColumn('description', function ($wastes) {

                    return substr($wastes->description, 0, 50) . '...';

                })->editColumn('customer_id', function ($wastes) {

                    return $wastes->customer->name;
                })->editColumn('admin_id', function ($wastes) {

                    return $wastes->admin->name;
                })->addColumn('value_in_points_per_unit', function ($wastes) {

                    return $wastes->value_in_points/$wastes->quantity;

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
             'customers' => $this->customerService->getAll(),
            'route' => route($this->route . '.store'),
        ]);
    }

    public function store($data): \Illuminate\Http\JsonResponse
    {
        $customer = $this->customerService->getById($data['customer_id']);
        $customer->points = $customer->points + $data['value_in_points'] ;
        $customer->save();
        $data['admin_id'] = auth('admin')->user()->id;
        $model = $this->createData($data);
        if ($model) {
            return response()->json(['status' => 200]);
        } else {
            return response()->json(['status' => 405]);
        }
    }

    public function edit($waste)
    {
        return view($this->folder . '/parts/edit',[

            'waste' => $waste,
            'customers' => $this->customerService->getAll(),
            'route' => route($this->route . '.update', $waste->id),
        ]);
    }

    public function update($data ,$id)
    {
        $data['admin_id'] = auth('admin')->user()->id;
        if ($this->updateData($id, $data)) {
            return response()->json(['status' => 200]);
        } else {
            return response()->json(['status' => 405]);
        }
    }

}
