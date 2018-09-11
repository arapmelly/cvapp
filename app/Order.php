<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Log;


use Carbon\Carbon;

use App\User;
use App\Order;
use App\Request;

class Order extends Model
{
    //



    public function client(){

		return $this->belongsTo('App\Client');
	}


	public function service(){

		return $this->belongsTo('App\Service');
	}


    public function user(){

        return $this->belongsTo('App\User');
    }


    public function requests(){

        return $this->hasMany('App\Request');
    }


     public function payments(){

        return $this->hasMany('App\Payment');
    }



    public static function getRefNumber(){

    	$count = DB::table('orders')->count();

    	if($count > 0){

    		$latest = DB::table('orders')->latest()->first();

    		$latest_ref = $latest->ref_number;

    		$new_ref = $latest_ref+ 1;

    		return $new_ref;

    	} else {

    		$ref = 1000;

    		return $ref;

    	}
    }



    public static function getDeadline($id){

     

      $order = Order::find($id);

      $deadline = $order->created_at->addDays(3)->diffForHumans(null, true);


      return $deadline;


    }



    public static function isRequested($orderId, $userId){

     

      $count = DB::table('requests')->where('order_id', '=', $orderId)->where('user_id', '=', $userId)->count();

      if($count > 0){

        return true;

      } else {

        return false;

      }


    }




    public static function getRequest($orderId, $userId){

     

      $r = DB::table('requests')->where('order_id', '=', $orderId)->where('user_id', '=', $userId)->get()->first();

     

     return $r;

     

    }




    public static function isAssigned($orderId){

     

      $r = DB::table('requests')->where('order_id', '=', $orderId)->where('status', '=', 'accepted')->count();

     

     if($r > 0){

        return true;
     } else {

        return false;
     }

     

    }







}
