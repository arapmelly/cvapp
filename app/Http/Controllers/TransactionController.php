<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use App\Transaction;


class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $transactions = DB::table('transactions')->where('transaction_status', '=', 'Completed')->orderBy('created_at', 'desc')->get();

        return $transactions;
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
        $transaction = new Transaction;
        $transaction->transaction_reference = $request->transaction_reference;
        $transaction->transaction_type = $request->transaction_type;
        $transaction->transaction_country = $request->transaction_country;
        $transaction->transaction_method = $request->transaction_method;
        $transaction->transaction_date = $request->transaction_date;
        $transaction->transaction_currency = $request->transaction_currency;
        $transaction->transaction_amount = $request->transaction_amount;
        $transaction->transaction_name = $request->transaction_name;
        $transaction->transaction_mobile = $request->transaction_mobile;
        $transaction->transaction_email = $request->transaction_email;
        $transaction->transaction_code = $request->transaction_code;
        $transaction->transaction_status = $request->transaction_status;
        $transaction->save();


        $response = [

            "api_key"=>$request->api_key,
            "api_signature"=>$requst->api_signature,
            "api_version"=> $request->api_version,
            "api_type"=>"Receipt",
            "transaction_reference"=>$request->transaction_reference,
            "transaction_status_code"=>"001",
            "transaction_status"=>"SUCCESS",
            "transaction_status_description"=>"Transaction received successfully.",
            "transaction_status_action"=>"ACCEPT",
            "transaction_status_reason"=>"VALID_TRANSACTION"
        ];


        return json_encode($response);
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
