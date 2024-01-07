<?php

namespace App\Http\Controllers\API;

use Midtrans\Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\transaction;
use Midtrans\Notification;

class MidtransController extends Controller
{
    public function callback(Request $request){
        //setkonfigurasi midtrans
        Config::$serverKey = config('app.midtrans.serverKey');
        Config::$clientKey = config('app.midtrans.clientKey');
        Config::$isProduction = config('app.midtrans.isProductiona');
        Config::$isSanitized = config('app.midtrans.isSanitized');
        Config::$is3ds = config('app.midtrans.is3ds');

        //buat midtrans notification
        $notification = new Notification();

        //asign fariabel 
        $status = $notification->transaction_status;
        $type = $notification->trasaction_type;
        $fraud = $notification->fraud_status;
        $order_id = $notification->order_id;

        //cari transaksi berdasarkan id
        $transaction = transaction::findOrFail($order_id);

        //hendel notifikasi status midtrans
        if($status=='capture'){
            if($type =='credit_card'){
                if($fraud == 'challenge'){
                    $transaction->status = 'PENDING';
                }
                else{
                    $transaction->status = 'SUCCESS';
                }
            }
        }else if ($status=='settlement'){
            $transaction->status= 'SUCCES';

        }
        else if ($status == 'pending') {
            $transaction->status='PENDING';
        }
        else if ($status =='deny')
        {
            $transaction->status='CANCELLED';
        }
        else if ($status == 'expire'){
            $transaction->status = 'CANCELLED';
        }
        else if($status=='cancel'){
            $transaction->status ='CANCELLED';
        }
        $transaction->save();
    }

    public function success(){
        return view('midtrans.success');
    }
   public function unfinish(){
    return view('midtrans.unfinish');
   }
   public function error(){
    return view('midtrans.eror');
   }
}