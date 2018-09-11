<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Order;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'order_id'=>'required'
        ]);

        $userId = Auth::id();

        $req = DB::table('requests')->insert(

            ['order_id' => $request->order_id, 'user_id' => $userId]
        );

        return ['status'=>1, 'data'=>$req];
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


    public function assign($id){

        $update = DB::table('requests')->where('id', $id)->update(['status' => 'accepted']);

        $order_id = DB::table('requests')->where('id', '=', $id)->pluck('order_id')->first();

        $user_id = DB::table('requests')->where('id', '=', $id)->pluck('user_id')->first();

        $order = Order::find($order_id);
        $order->order_status = 'assigned';
        $order->is_assigned = true;
        $order->user_id = $user_id;
        $order->update();

        return ['status'=>1, 'data'=>$update];
    }
}
