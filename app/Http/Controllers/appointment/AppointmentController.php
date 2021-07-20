<?php

namespace App\Http\Controllers\Appoinment;

use Illuminate\Http\Request;
use App\Appointment;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\Service\ServiceController;

class AppointmentController extends ApiController
{
    public function index() {
        $appointments = Appointment::all();
        return $this->showAll($appointments);
    }
    
    public function store(Request $resquest) {
        $json = $resquest->input('json', null);
        $params_array = json_decode($json, true);
        $rules = [
            'customer_id' => 'required|numeric',
            'service_id' => 'required|numeric',
            'start_time' => 'required|date_format:Y-m-d H:i:s',
        ];

        if(!empty($params_array)) {
            // clear data
            $params_array = array_map('trim', $params_array);
            $this->validate($params_array, $rules); 

            $service = new ServiceController();
            $service = $service->show($params_array['service_id']);
            dd($service);die();
            //Save the appointment
            $appointment = new Appointment();
            $appointment->customer_id = $params_array['customer_id'];
            $appointment->service_id = $params_array['service_id'];
            $appointment->start_time = (!empty($params_array['start_time']))?$params_array['start_time']:null;
            $appointment->save();  
            
            return $this->showOne($appointment);         
        }
        return $this->errorResponse('No se ha enviado la cita.', 400);
    }
    
    public function show($id) {
        $appointment = Appointment::find($id);
        return $this->showOne($appointment);
    }
}
