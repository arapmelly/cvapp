<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //

    public function agentstats(){

    	$orders = DB::table('orders')->where('order_status', '=', 'new')->where('is_assigned', '=', false)->get();

    	$agent_orders = DB::table('orders')->where('is_assigned', '=', true)->where('user_id', '=', Auth::id())->get();

    	$new_orders = $orders->count();

    	$assigned_orders = $agent_orders->where('order_status', '=', 'assigned')->count();

    	$completed = $agent_orders->where('order_status', '=', 'completed')->count();

    	$closed = $agent_orders->where('order_status', '=', 'closed')->count();

    	return [

    		'new'=>$new_orders,
    		'assigned'=>$assigned_orders,
    		'completed'=>$completed,
    		'closed'=>$closed
    	];
    }
}
