<?php

namespace App\Services;

use App\Models\Customer as ObjModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Writer;
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
                    if (auth()->user()->can('edit_customer')) {

                        $buttons .= '
                            <button type="button" data-id="' . $customers->id . '" class="btn btn-pill btn-info-light editBtn">
                            <i class="fa fa-edit"></i>
                            </button>
                       ';
                    }

                    if (auth()->user()->can('delete_customer')) {


                        $buttons .= '<button class="btn btn-pill btn-danger-light" data-bs-toggle="modal"
                        data-bs-target="#delete_modal" data-id="' . $customers->id . '" data-title="' . $customers->name . '">
                        <i class="fas fa-trash"></i>
                        </button>';


                    }

                    return $buttons;
                })->addColumn('WhatsApp', function ($customers) {

                    return '<a target="_blank" href="https://wa.me/'.$customers->phone.'"><i class="fab fa-2x   fa-whatsapp"></i></a>';

//                })->editColumn('link', function ($customers) {
//                    $url = url('/') . '/register?user_id=' . $customers->id;
//
//                    // Generate QR code using BaconQrCode
//                    $renderer = new ImageRenderer(
//                        new RendererStyle(200),
//                        new SvgImageBackEnd()
//                    );
//                    $writer = new Writer($renderer);
//                    $qrCodeSvg = $writer->writeString($url); // SVG format for QR Code
//
//                    // Return both the referral link and QR code
//                    return '<a href="' . $url . '" target="_blank">Referral Link</a><br>' .
//                        '<div>' . $qrCodeSvg . '</div>';
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

        $data['password'] = Hash::make($data['password']);

        $model = $this->createData($data);
        if ($model) {
            return response()->json(['status' => 200]);
        } else {
            return response()->json(['status' => 405]);
        }
    }
    public function generateCode(): string
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
        if ($data['password'] && $data['password'] != null) {

            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        if ($this->updateData($id, $data)) {
            return response()->json(['status' => 200]);
        } else {
            return response()->json(['status' => 405]);
        }
    }

    public function getByPhone($phone)
    {
        return $this->model->where('phone', $phone)->first();

    }


}
