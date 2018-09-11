<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Validator;
use Carbon\Carbon;

use App\Service;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return all services
        return Service::all();

    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validations

        $request->validate([
            'name'=>'required | unique:services',
            'ref'=>'required | unique:services',
            'cost'=>'required'
        ]);

        $service = new Service;
        $service->name = $request->name;
        $service->ref = $request->ref;
        $service->cost = $request->cost;
        $service->description = $request->description;
        $service->save();

        return ['status'=>true, 'data'=>$service];

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return Service::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $request->validate([
            'name'=>'required',
            'ref'=>'required',
            'cost'=>'required'
        ]);

        $service = Service::find($id);
        $service->name = $request->name;
        $service->ref = $request->ref;
        $service->cost = $request->cost;
        $service->description = $request->description;
        $service->update();

        return ['status'=>true, 'data'=>$service];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $service = Service::find($id);

        Service::destroy($id);
        
        return ['status'=>true, 'data'=>$service];
    }
}
