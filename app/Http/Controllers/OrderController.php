<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Validator;
use Carbon\Carbon;

use App\Order;
use App\Client;
use App\Service;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Order::all();
    }



    public function orderByStatus($status)
    {
        //

        $userId = Auth::id();
       
        $orders = Order::with(['service', 'client', 'user', 'requests', 'requests.user', 'payments'])->where('order_status', '=', $status)->orderBy('created_at', 'desc')

        ->get()->map(function($order) use ($userId){

            return [
                'order'=>$order,
                'deadline'=>Order::getDeadline($order->id),
                'service'=>$order->service,
                'client'=>$order->client,
                'is_requested'=>Order::isRequested($order->id, $userId),
                'request'=>Order::getRequest($order->id, $userId),
                'is_assigned'=>Order::isAssigned($order->id)
            ];
        });

       
        return $orders;
        
    }



     public function agentOrderByStatus($status)
    {
        //

        $userId = Auth::id();
       
        $orders = Order::with(['service', 'client', 'user', 'requests', 'requests.user', 'payments'])->where('order_status', '=', $status)->where('user_id', '=', $userId)->orderBy('created_at', 'desc')

        ->get()->map(function($order) use ($userId){

            return [
                'order'=>$order,
                'deadline'=>Order::getDeadline($order->id),
                'service'=>$order->service,
                'client'=>$order->client,
                'is_requested'=>Order::isRequested($order->id, $userId),
                'request'=>Order::getRequest($order->id, $userId),
                'is_assigned'=>Order::isAssigned($order->id)
            ];
        });

       
        return $orders;
        
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
            'phone'=>'required',
            'cv_file'=>'required',
            'service_id'=>'required'
        ]);


            $path = $request->cv_file->path();

            $extension = $request->cv_file->extension();

            $rand = rand(10, 99999999);

            $name = strtotime(date('d-m-Y')).'-'.$rand.'.'.$extension;

            $cv_url = Client::uploadFile($path, $name);

        //create client
        $client = new Client;
        $client->f_name = $request->f_name;
        $client->l_name = $request->l_name;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->cv_link = $cv_url;
        $client->save();


        $ref_number = Order::getRefNumber();

        $service = Service::find($request->service_id);

        $order = new Order;
        $order->ref_number = $ref_number;
        $order->client_id = $client->id;
        $order->service_id = $service->id;
        $order->cost = $service->cost;
        $order->save();

       // return ['status'=>true, 'data'=>$order];

        return view('order.payment', compact('order', 'service'));
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
    }


    public function order($id){

        $service = Service::find($id);

        return view('order.create', compact('service'));
    }
}
