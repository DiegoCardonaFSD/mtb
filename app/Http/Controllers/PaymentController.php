<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Services\Payments\PaymentAdapter;
use App\Services\Payments\PlaceToPay;
use Illuminate\Support\Facades\Redirect;

class PaymentController extends Controller
{
    //

    public function create(Request $request, Order $order){

    	$data['order'] 		= $order;
    	$data['userAgent'] 	= $request->server('HTTP_USER_AGENT');
    	$data['ip']			= $request->ip();

    	$paymentAdapter = new PaymentAdapter(new PlaceToPay($data));
    	$response = $paymentAdapter->pay();	

    	return Redirect::to($response['processUrl']);
    }


    public function return($uuid){
    	$order = Order::where('uuid', $uuid)->first();
    	$data['order'] = $order;
    	$paymentAdapter = new PaymentAdapter(new PlaceToPay($data));
    	$response = $paymentAdapter->get();	
    	$order = $order->fresh();
    	
        return view('admin.order.show', [
            'order'     => $order,
        ]);
    }
}
