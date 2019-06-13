<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Employee;

class EmployeeController extends Controller
{
    
    public function index() {
        $employees = Employee::all();
        //var_dump($employees);die();
        $data = [
            'code' => 200,
            'status' => 'success',
            'data' => $employees
        ];
        return response()->json($data, $data['code']);
    }
    
    public function store(Request $resquest) {
        $json = $resquest->input('json', null);
        //var_dump($json);die();
        $params_array = json_decode($json, true);
        $data = [
            'code' => 400,
            'status' => 'error',
            'message' => 'No se ha enviado el usuario.'
        ];
        if(!empty($params_array)) {
            // clear data
            $params_array = array_map('trim', $params_array);
            $validate = \Validator::make($params_array, [
                'identification' => 'required|numeric',
                'name' => 'required|alpha',
                'surname' => 'required|alpha',
                'phone' => 'required',
                'email' => 'required|email|unique:customers',
                // 'password' => 'required'
            ]);
            if($validate->fails()) {
                $data['message'] = 'No se ha podido guardar el usuario.';
            } else {
                // Encrypt password
                // $pwd = hash('sha256', $params_array['password']);
                //Save the service
                $employee = new Employee();
                $employee->identification = $params_array['identification'];
                $employee->name = $params_array['name'];
                $employee->surname = $params_array['surname'];
                $employee->phone = $params_array['phone'];
                $employee->address = (!empty($params_array['address']))?$params_array['address']:null;
                $employee->email = $params_array['email'];
                // $employee->password = $pwd;
                $employee->save();
                $data = [
                    'code' => 200,
                    'status' => 'success',
                    'data' => $employee
                ];
            }
        }
        return response()->json($data, $data['code']);
    }
    
    public function show($id) {
        $employee = Employee::find($id);
        if (is_object($employee)) {
            $data = array(
                'code' => 200,
                'status' => 'success',
                'data' => $employee
            );
        } else {
            $data = array(
                'code' => 404,
                'status' => 'error',
                'message' => "El usuario no existe."
            );
        }
        return response()->json($data, $data['code']);
    }
}
