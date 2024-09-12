<?php

namespace App\Services;

use App\Models\Waste as ObjModel;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\DataTables;

class WasteService extends BaseService
{
    protected string $folder = 'admin/waste';
    protected string $route = 'wastes';

    public function __construct(ObjModel $model ,protected CustomerService $customerService ,protected WasteSectionService $wasteSectionService)
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
                    if ($wastes->status == 0){

                        $buttons .= '
                            <a href="' . route($this->route . '.edit', $wastes->id) . '"  class="btn btn-pill btn-info-light ">
                            <i class="fa fa-check" aria-hidden="true"></i>
                            </a>
                       ';



                    if (auth()->user()->can('delete_waste')) {


                        $buttons .= '<button class="btn btn-pill btn-danger-light" data-bs-toggle="modal"
                        data-bs-target="#delete_modal" data-id="' . $wastes->id . '" data-title="' . $wastes->name . '">
                        <i class="fas fa-trash"></i>
                        </button>';

                    }
                    }
                    else{

                        $buttons .= 'تم التاكيد';
                    }


                    return $buttons;
                })->editColumn('description', function ($wastes) {

                    return substr($wastes->description, 0, 50) . '...';

                })->editColumn('customer_id', function ($wastes) {

                    return $wastes->customer->name;
                })->editColumn('admin_id', function ($wastes) {

                    return $wastes->admin ? $wastes->admin->name : $wastes->customer->name;
                })->addColumn('value_in_points_per_unit', function ($wastes) {

                    return $wastes->value_in_points/$wastes->quantity;

                })->editColumn('status', function ($wastes) {

                    return $wastes->status == 1 ? 'تم التاكيد' : 'لم يتم التاكيد';

                }

                )

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
            'wasteSections' => $this->wasteSectionService->getAll(),
            'route' => route($this->route . '.store'),
        ]);
    }

    public function store($data): \Illuminate\Http\JsonResponse
    {
        $customer = $this->customerService->getById($data['customer_id']);
        $customer->points = $customer->points + $data['points_transferred'] ;
        $customer->pointsFromWhere='عمليه استبدال نفايات';
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
        $id = $waste->id;
        $waste = $this->getById($id);

        $waste->status=1;
        $waste->save();

        $customer= $this->customerService->getById($waste->customer_id);
        $customer->points += $waste->points_transferred;
        $customer->save();
        if ($customer->customer_id !== null) {
            $parent_customer = $this->customerService->getById($customer->customer_id);
            $parent_customer->points += $waste->points_transferred;
            $parent_customer->save();
        }

        if ( $customer->save()) {
            return redirect()->back()->with('success', 'تم تاكيد البيانات بنجاح.');
        } else {
            return redirect()->back()->with('success', 'حدث خطأ ما.');
        }

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
