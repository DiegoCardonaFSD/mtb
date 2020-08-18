<?php

namespace App\Services\Payments;

use Illuminate\Http\Request;
use App\Interfaces\Payments\ElectronicPaymentInterface;
use App\Order;
use Carbon\Carbon;

class PlaceToPay implements ElectronicPaymentInterface
{
	private $order;
	private $userAgent;
	private $ip;

	function __construct(Array $data = []){
		if(isset($data['order'])){
			$this->order = $data['order'];	
		}

		if(isset($data['userAgent'])){
			$this->userAgent = $data['userAgent'];	
		}

		if(isset($data['ip'])){
			$this->ip = $data['ip'];	
		}
	}


	private function httpPost($url, $data)
	{
	    $curl = curl_init($url);
	    curl_setopt($curl, CURLOPT_POST, true);
	    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($curl, CURLOPT_SSLVERSION, 6);
	    $response = curl_exec($curl);
	    //echo $response;
		if (curl_errno($curl)) {
		    echo curl_error($curl);
		}

	    curl_close($curl);
	    return $response;
	}

	private function getBuyer(){
		$buyer = [];
		$buyer['documentType'] 	= $this->order->document_type;
		$buyer['document'] 		= $this->order->document;
		$buyer['name'] 			= $this->order->customer_name;
		$buyer['email'] 		= $this->order->customer_email;
		$buyer['mobile'] 		= $this->order->customer_mobile;
		$buyer['surname'] 		= $this->order->customer_lastname;
		return $buyer;
	}

	private function getPayment(){
		$payment = [];
	    $payment['reference'] = $this->order->id;
	    $payment['description'] = $this->order->product->name;
	    $payment['amount'] = array(
	    		'currency'	=> env('PLACE_TO_PAY_CURRENCY'),
	    		'total'		=>	$this->order->total_price
	    	);
	    $payment['allowPartial'] = false;
	    return $payment;
	}

	private function getExpiration(){
		$minutes = env('PLACE_TO_PAY_EXPIRATION_MINUTES');
		return Carbon::now()->addMinutes($minutes)->toIso8601String();
	}

	private function getAuth(){
		$auth = [];
		$secretKey 		= env('PLACE_TO_PAY_SECRET_KEY');
    	$auth['login'] 	= env('PLACE_TO_PAY_LOGIN');
    	$auth['seed']  	= date("c");

	    $nonce = "";
	    if (function_exists('random_bytes')) {
	        $nonce = bin2hex(random_bytes(16));
	    } elseif (function_exists('openssl_random_pseudo_bytes')) {
	        $nonce = bin2hex(openssl_random_pseudo_bytes(16));
	    } else {
	        $nonce = mt_rand();
	    }

    	$nonceBase64 = base64_encode($nonce);
	    $auth['nonce']  = $nonceBase64;
	    $auth['tranKey']  = base64_encode(sha1($nonce . $auth['seed'] . $secretKey, true));
	    return $auth;
	}

	private function getRequest(){
		$request = [];
		$request["ipAddress"] 		= $this->ip;
	    $request["userAgent"] 		= $this->userAgent;
	    
	    $request["locale"] 			= env('PLACE_TO_PAY_DEFAULT_LOCALE');
	    $request["returnUrl"] 		= env('PLACE_TO_PAY_RETURN_URL') . $this->order->uuid;
	    $request["cancelUrl"] 		= env('PLACE_TO_PAY_CANCEL_URL'). $this->order->uuid;

	    $request["buyer"] 			= $this->getBuyer();
	    $request["payment"] 		= $this->getPayment();
	    $request["expiration"] 		= $this->getExpiration();
	    
	    $request["skipResult"] 		= false;
	    $request["noBuyerFill"] 	= false;
	    $request["captureAddress"] 	= false;
	    $request["paymentMethod"] 	= null;

	    $request["auth"] 			= $this->getAuth();

	    return $request;
	}

    public function pay(){
    	if(!$this->order){
    		//todo:lanzar excepcion
    		return false;
    	}

    	$response = $this->execute();
    	$response = json_decode($response, true);
    	
    	if(
    		isset($response['status']['status']) &&
    		$response['status']['status'] != 'OK' 
    	){
    			//todo: lanzar exception
    			return false;
    	}

    	$this->order->request_id 	= $response['requestId'];
    	$this->order->process_url 	= $response['processUrl'];
    	$this->order->status_order 	= env('ORDER_STATUS_PROCESSING');
    	$this->order->save();

    	return $response;
    }

    private function execute(){
    	$data = $this->getRequest();
    	$url = env('PLACE_TO_PAY_SERVICE_URL');
    	return $this->httpPost($url, $data);
    }

    public function get(){
    	$request["auth"] 	= $this->getAuth();
    	$url 				= env('PLACE_TO_PAY_SERVICE_URL') . '/' . $this->order->request_id;
    	$response = $this->httpPost($url, $request);
    	$response = json_decode($response, true);
    	if(
    		isset($response['status']['status']) &&
    		$response['status']['status'] == env('ORDER_STATUS_APPROVED') 
    	){
			$this->order->status_order = env('ORDER_STATUS_ENDED');
			$this->order->status 		= env('ORDER_STATUS_PAYED');
			$this->order->save();
    	} elseif(
    		isset($response['status']['status']) &&
    		$response['status']['status'] == env('ORDER_STATUS_REJECTED')
    	){
    		$this->order->status_order = env('ORDER_STATUS_NEW');
			$this->order->status 		= env('ORDER_STATUS_REJECTED');
			$this->order->save();
    	}
    	return $response;
    }
}
