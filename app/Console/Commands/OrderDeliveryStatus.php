<?php

namespace App\Console\Commands;

use App\Http\Controllers\Backend\OrderController;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class OrderDeliveryStatus extends Command
{
    protected $signature = 'command:OrderDeliveryStatus';

    protected $description = 'Check Order Delivery Status';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $orders = New OrderController ();
        $orders->checkOrderStatus();

    }
}
