<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Validator;
use Carbon\Carbon;

use App\Client;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Client::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'f_name'=>'required',
            'l_name'=>'required',
            'email'=>'required',
            'phone'=>'required'
        ]);

        $client = new Client;
        $client->f_name = $request->f_name;
        $client->l_name = $request->l_name;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->save();

        return ['status'=>true, 'data'=>$client];
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
        return Client::find($id);
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
            'f_name'=>'required',
            'l_name'=>'required',
            'email'=>'required',
            'phone'=>'required'
        ]);

        $client = Client::find($id);
        $client->f_name = $request->f_name;
        $client->l_name = $request->l_name;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->update();

        return ['status'=>true, 'data'=>$client];
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
        $client = Client::find($id);
        Client::destroy($id);
        
        return ['status'=>true, 'data'=>$client];
    }
}
