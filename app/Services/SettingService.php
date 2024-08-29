<?php

namespace App\Services;

use App\Models\Setting as ObjModel;
use http\Env\Response;


class SettingService extends BaseService
{
    public function __construct(ObjModel $model)
    {
        parent::__construct($model);
    }

    public function index()
    {
        return view('admin.setting.index');
    } // index

    public function update($data)
    {
//        return \response()->json($data);
        $setting = $this->model->first();
        if (isset($data['logo'])) {
            if ($setting &&file_exists($setting->logo)) {
                unlink($setting->logo);
            }
            $data['logo'] = $this->handleFile($data['logo'], 'uploads/settings');
        }

        if ($setting && isset($data['favicon'])) {
            if (file_exists($setting->favicon)) {
                unlink($setting->favicon);
            }
            $data['favicon'] = $this->handleFile($data['favicon'], 'uploads/settings');

        }
        if ($setting){
             $this->updateData($setting->id, $data);
            return Response()->json(['status' => 200]);


        }else{
            $this->createData($data);
            return Response()->json(['status' => 200]);
        }

    } // update
}
