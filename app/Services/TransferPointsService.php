<?php

namespace App\Services;

use App\Models\TransferPoints as ObjModel;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\DataTables;

class TransferPointsService extends BaseService
{
    protected string $folder = 'admin/transfer-points';
    protected string $route = 'transfer_points';

    public function __construct(ObjModel $model ,protected CustomerService $customerService)
    {
        parent::__construct($model);
    }

    public function index($request)
    {
        if ($request->ajax()) {
            $transfer = $this->getDataTable();
            return DataTables::of($transfer)
                ->addColumn('action', function ($transfer) {
                    $buttons = '';
//                        $buttons .= '
//                            <button type="button" data-id="' . $transfer->id . '" class="btn btn-pill btn-info-light editBtn">
//                            <i class="fa fa-edit"></i>
//                            </button>
////                       ';

                        $buttons .= '<button class="btn btn-pill btn-danger-light" data-bs-toggle="modal"
                        data-bs-target="#delete_modal" data-id="' . $transfer->id . '" data-title="' . $transfer->name . '">
                        <i class="fas fa-trash"></i>
                        </button>';

                    return $buttons;

                })->editColumn('from_id', function ($transfer) {

                    return $transfer->fromCustomer->name;
                })->editColumn('to_id', function ($transfer) {

                    return $transfer->toCustomer->name;

                })->editColumn('admin_id', function ($transfer) {

                    return $transfer->admin->user_name;
                })->addColumn('points_of_from', function ($transfer) {

                    return $transfer->fromCustomer->points;
                })->addColumn('points_of_to', function ($transfer) {

                    return $transfer->toCustomer->points;
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

    public function store($data): JsonResponse
    {
        $from = $this->customerService->getById($data['from_id']);
        $to = $this->customerService->getById($data['to_id']);
        $points=$data['points'];
        $from->points = $from->points - $points;
        $from->save();
        $to->points = $to->points + $points;
        $to->save();

        $data['admin_id'] = auth('admin')->user()->id;

        if ($this->createData($data)) {
            return response()->json(['status' => 200]);
        } else {
            return response()->json(['status' => 405]);
        }
    }

//    public function edit($id)
//    {
//        return view($this->folder . '/parts/edit',[
//
//            'transferPoints' => $this->getById($id) ,
//            'customers' => $this->customerService->getAll(),
//            'route' => route($this->route . '.update', $id),
//
//        ]);
//    }

//    public function update($data ,$id)
//    {
//        $data['admin_id'] = auth('admin')->user()->id;
//        if ($this->updateData($id, $data)) {
//            return response()->json(['status' => 200]);
//        } else {
//            return response()->json(['status' => 405]);
//        }
//    }

}
