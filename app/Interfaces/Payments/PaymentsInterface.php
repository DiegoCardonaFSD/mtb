<?php

namespace App\Interfaces\Payments;

interface PaymentsInterface
{
    public function pay();
    public function get();
}