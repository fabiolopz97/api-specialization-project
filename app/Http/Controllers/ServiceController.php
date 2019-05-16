<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
class ServiceController extends Controller
{
    public function index() {
        $services = Service::all();
        $data = [
            'code' => 200,
            'status' => 'success',
            'services' => $services
        ];
        return response()->json($data, $data['code']);
    }
    
    public function store(Request $resquest) {
        $json = $resquest->input('json', null);
        $params_array = json_decode($json, true);
        $data = [
            'code' => 400,
            'status' => 'error',
            'message' => 'No se ha enviado el servicio.'
        ];
        if(!empty($params_array)) {
            $validate = \Validator::make($params_array, [
                'name' => 'required'
            ]);
            if($validate->fails()) {
                $data['message'] = 'No se ha podido guardar el servicio.';
            } else {
                //Save the service
                $service = new Service();
                $service->name = $params_array['name'];
                $service->save();
                $data = [
                    'code' => 200,
                    'status' => 'success',
                    'service' => $service
                ];
            }
        }
        return response()->json($data, $data['code']);
    }
    
    public function show($id) {
        $service  =  Service::find($id);
        if(is_object($service)) {
            $data = [
                'code' => 200,
                'status' => 'success',
                'service' => $service
            ];
        } else {
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'El servicio  no existe.'
            ];    
        }
        return response()->json($data, $data['code']);
    }
    
    public function update($id, Request $request) {
        $json = $request->input('json', null);
        $params_array = json_decode($json, true);
        $data = [
            'code' => 400,
            'status' => 'error',
            'message' => 'No se ha el servicio.'
        ];
        if(!empty($params_array)) {
            unset($params_array['id']);
            unset($params_array['create_at']);
            Service::where('id', $id)
                              ->update($params_array);
            $data = [
                'code' => 200,
                'status' => 'success',
                'service' => $params_array
            ];
        }
        return response()->json($data, $data['code']);
    }
}
