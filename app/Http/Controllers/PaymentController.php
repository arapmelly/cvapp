<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Validator;
use Carbon\Carbon;

use App\Payment;
use App\Order;
use App\Service;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        return Payment::all();
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

            'transaction_code'=>'required'
        ]);

        $payment = new Payment;
        $payment->order_id = $request->order_id;
        $payment->transaction_code = $request->transaction_code;
        $payment->save();


        $exists = DB::table('transactions')->where('transaction_code', '=', $request->transaction_code)->where('transaction_status', '=', 'Completed')->count();


        if($exists > 0){

            $amount = DB::table('transactions')->where('transaction_code', '=', $request->transaction_code)->where('transaction_status', '=', 'Completed')->pluck('transaction_amount')->first();

            $payment = Payment::find($payment->id);
            $payment->is_paid = true;
            $payment->amount = $amount;
            $payment->update();
           

            return view('order.success');

        } else {

            $order = Order::find($request->order_id);

            
            $service = Service::find($order->service_id);


            return view('order.payment', compact('order', 'service'))->with('notice', 'Your payment has not been validated. Please try again');

            
        }


        
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
}
