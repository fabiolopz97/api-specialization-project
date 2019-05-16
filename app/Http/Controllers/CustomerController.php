<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;

class CustomerController extends Controller
{
    public function index() {
        $customers = Customer::all();
        $data = [
            'code' => 200,
            'status' => 'success',
            'customer' => $customers
        ];
        return response()->json($data, $data['code']);
    }
    
    public function store(Request $resquest) {
        $json = $resquest->input('json', null);
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
                'name' => 'required|alpha',
                'surname' => 'required|alpha',
                'email' => 'required|email|unique:customers',
                'password' => 'required'
            ]);
            if($validate->fails()) {
                $data['message'] = 'No se ha podido guardar el usuario.';
            } else {
                // Encrypt password
                $pwd = hash('sha256', $params_array['password']);
                //Save the service
                $customer = new Customer();
                $customer->name = $params_array['name'];
                $customer->surname = $params_array['surname'];
                $customer->phone = (!empty($params_array['phone']))?$params_array['phone']:null;
                $customer->email = $params_array['email'];
                $customer->password = $pwd;
                $customer->save();
                $data = [
                    'code' => 200,
                    'status' => 'success',
                    'customer' => $customer
                ];
            }
        }
        return response()->json($data, $data['code']);
    }
    
    public function show($id) {
        $customer = Customer::find($id);
        if (is_object($customer)) {
            $data = array(
                'code' => 200,
                'status' => 'success',
                'customer' => $customer
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
