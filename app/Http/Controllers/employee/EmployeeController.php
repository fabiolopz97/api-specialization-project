<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use \App\Employee;
use App\Http\Controllers\ApiController;

class EmployeeController extends ApiController
{
    
    public function index() {
        $employees = Employee::all();
        return $this->showAll($employees);
    }
    
    public function store(Request $resquest) {
        $json = $resquest->input('json', null);
        //var_dump($json);die();
        $params_array = json_decode($json, true);
        $rules = [
            'identification' => 'required|numeric',
            'name' => 'required|alpha',
            'surname' => 'required|alpha',
            'phone' => 'required',
            'email' => 'required|email|unique:customers',
            // 'password' => 'required'
        ];
        if(!empty($params_array)) {
            // clear data
            $params_array = array_map('trim', $params_array);
            $this->validate($params_array, $rules);
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
            return $this->showOne($employee);
        }
        return $this->errorResponse('No se ha enviado el usuario.', 400);
    }
    
    public function show($id) {
        $employee = Employee::findOrFail($id);
        return $this->showOne($employee);
    }
}
