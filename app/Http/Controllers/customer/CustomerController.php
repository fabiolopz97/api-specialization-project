<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Customer;
use App\Http\Controllers\ApiController;

class CustomerController extends ApiController
{
    public function index() {
        $customers = Customer::all();
        return $this->showAll($customers);
    }

    public function store(Request $request) {
        $rules = [
            'name' => 'required',
            'lastName' => 'required',
            'birthday' => 'required|date_format:Y-m-d',
            'email' => 'required|email|unique:customers',
            'password' => 'required'
        ];
        $this->validate($request, $rules);
        $fields = $request->all();
        $fields['name'] = ucwords(strtolower($request->name));
        $fields['last_name'] = ucwords(strtolower($request->lastName));
        $fields['birthday'] = $request->birthday;
        $fields['phone'] = $request->phone;
        $fields['email'] = strtolower($request->email);
        $fields['password'] = Hash::make($request->password);
        $fields['remember_token'] = Str::random(60);

        $customer = Customer::create($fields);

        return $this->showOne($customer);
    }

    public function show($id) {
        $customer = Customer::findOrFail($id);
        return $this->showOne($customer);
    }

    /*public function login(Request $request) {
        $jwtAuth = new \JwtAuth();
        $email = 'nuevo@gmail.com';
        $password =  Hash::make('admin123');
        return $jwtAuth->signup($email, $password);
    }*/
}
