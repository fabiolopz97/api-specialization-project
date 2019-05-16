<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Appointment;
class AppointmentController extends Controller
{
    public function index() {
        $appointments = Appointment::all();
        $data = [
            'code' => 200,
            'status' => 'success',
            'appointments' => $appointments
        ];
        return response()->json($data, $data['code']);
    }
    
    public function store(Request $resquest) {
        $json = $resquest->input('json', null);
        $params_array = json_decode($json, true);
        $data = [
            'code' => 400,
            'status' => 'error',
            'message' => 'No se ha enviado la cita.'
        ];
        if(!empty($params_array)) {
            // clear data
            $params_array = array_map('trim', $params_array);
            $validate = \Validator::make($params_array, [
                'customer_id' => 'required|numeric',
                'service_id' => 'required|numeric',
                'start_time' => 'required|date_format:Y-m-d H:i:s',
            ]);
            if($validate->fails()) {
                $data['message'] = 'error -- No se ha podido guardar la cita.';
            } else {
                //Save the appointment
                $appointment = new Appointment();
                $appointment->customer_id = $params_array['customer_id'];
                $appointment->service_id = $params_array['service_id'];
                $appointment->start_time = (!empty($params_array['start_time']))?$params_array['start_time']:null;
                $appointment->save();
                $data = [
                    'code' => 200,
                    'status' => 'success',
                    'employee' => $appointment
                ];
            }
        }
        return response()->json($data, $data['code']);
    }
    
    public function show($id) {
        $appointment = Appointment::find($id);
        if (is_object($appointment)) {
            $data = array(
                'code' => 200,
                'status' => 'success',
                'appointment' => $appointment
            );
        } else {
            $data = array(
                'code' => 404,
                'status' => 'error',
                'message' => "La cita no existe."
            );
        }
        return response()->json($data, $data['code']);
    }
}
