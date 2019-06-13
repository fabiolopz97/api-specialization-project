<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Customer;

class CustomerController extends Controller
{
    public function index() {
        return Customer::all();
        /*$data = [
            'code' => 200,
            'status' => 'success',
            //remplazar customerm por data
            'data' => $customers,
            'message' => 'Estas en otro metodo'
        ];
        return response()->json($data, $data['code']);*/
    }

    public function store(Request $request) {
        $validate = $request->validate([
            'name' => 'required',
            'lastName' => 'required',
            'birthday' => 'required|date_format:Y-m-d',
            'email' => 'required|email|unique:customers',
            'password' => 'required'
        ]);
        return Customer::create([
            'name' => ucwords(strtolower($request['name'])),
            'last_name' => ucwords(strtolower($request['lastName'])),
            'birthday' => $request['birthday'],
            'phone' => $request['phone'],
            'email' => strtolower($request['email']),
            'password' => Hash::make($request['password']),
            'remember_token' => Str::random(60),
        ]);
    }

       /* $json = $resquest->input('json', null);
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
                'birthday' => 'required|date_format:Y-m-d',
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
                $customer->birthday = $params_array['birthday'];
                $customer->phone = (!empty($params_array['phone']))?$params_array['phone']:null;
                $customer->email = $params_array['email'];
                $customer->password = $pwd;
                $customer->save();
                $data = [
                    'code' => 200,
                    'status' => 'success',
                    'data' => $customer,
                    'message' => 'El usuario se ha registrado con exito.'
                ];
            }
        }
        return response()->json($data, $data['code']);
                /*->withHeaders(
                    "Content-Type: application/json;charset=utf-8 ",
                    "Accept: application/json;charset=utf-8",
                    "Cache-Control: max-age=640000"
                );
    }*/

    public function show($id) {
        return Customer::findOrFail($id);
        /*if (is_object($customer)) {
            $data = array(
                'code' => 200,
                'status' => 'success',
                'data' => $customer
            );
        } else {
            $data = array(
                'code' => 404,
                'status' => 'error',
                'message' => "El usuario no existe."
            );
        }
        return response()->json($data, $data['code']);*/
    }

    /*public function login(Request $request) {
        $jwtAuth = new \JwtAuth();
        $email = 'nuevo@gmail.com';
        $password =  Hash::make('admin123');
        return $jwtAuth->signup($email, $password);
    }*/
}
