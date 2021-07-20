<?php

namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;
use App\Service;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Storage;

class ServiceController extends ApiController
{
    public function index() {
        $services = Service::all();
        return $this->showAll($services);
    }

    public function store(Request $resquest) {
        $json = $resquest->input('json', null);
        $params_array = json_decode($json, true);
        $rules = [
            'name' => 'required'
        ];

        if(!empty($params_array)) {
            $this->validate($params_array, $rules);
            //Save the service
            $service = new Service();
            $service->name = $params_array['name'];
            $service->save();
            return $this->showOne($service);
            
        }
        return $this->errorResponse('No se ha enviado el servicio.', 400);
    }

    public function show($id) {
        $service = Service::findOrFail($id);
        return $this->showOne($service);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showServicesByCategory($id)
    {
        $services = Service::where('service_category_id', $id)
            ->orderby('name')
            ->get();
        return $this->showAll($services);
    }

    public function update($id, Request $request) {
        $json = $request->input('json', null);
        $params_array = json_decode($json, true);
        
        if(!empty($params_array)) {
            unset($params_array['id']);
            unset($params_array['create_at']);
            $service = Service::where('id', $id)
                              ->update($params_array);
            $this->showOne($service);
        }
        return $this->errorResponse('No se ha encontrado el servicio.', 400);
    }

    public function updateUploadFiles(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        if ($request->hasFile('image')) {
            Storage::delete($service->image);
            $service->image = $request->image->store('');
        }
        
        if (!$service->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }
        $service->save();
        return $this->showOne($service);
    }
}
