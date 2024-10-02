<?php

namespace App\Console\Commands;

use App\Http\Controllers\DriverController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\PayoutController;
use App\Models\Driver;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;


class CheckOrderPaymentStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:CheckOrderPaymentStatus';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check Order Payment Status';

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
        $payouts = New PaymentController();
        $payouts->checkPaymentStatus();

    }
}
