<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Order;

class CheckPaymentInProgress extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:checkpaymentinprogress';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Busca ordenes que hay pendientes de pago en el sistema y las verifica a traves del servicio de consulta de PlaceToPay';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $orders = Order::where('status_order', 'PROCESSING')->get();
        foreach ($orders as $order) {
            $data['order'] = $order;
            $paymentAdapter = new PaymentAdapter(new PlaceToPay($data));
            $response = $paymentAdapter->get();
        }
    }
}
