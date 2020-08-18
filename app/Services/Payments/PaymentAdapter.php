<?php

namespace App\Services\Payments;

use Illuminate\Http\Request;
use App\Order;
use App\Interfaces\Payments\PaymentsInterface;
use App\Interfaces\Payments\ElectronicPaymentInterface;

class PaymentAdapter implements PaymentsInterface
{
	private $payment;

	function __construct(ElectronicPaymentInterface $payment){
		$this->payment = $payment;
	}

    public function pay(){
    	return $this->payment->pay();
    }

    public function get(){
    	return $this->payment->get();
    }
}
