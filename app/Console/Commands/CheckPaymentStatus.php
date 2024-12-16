<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CheckPaymentStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-payment-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $payments = DB::table('payments')
            ->where('payment_status', 'pending')
            ->get();
    
        foreach ($payments as $payment) {
            $this->checkPaymentStatus($payment->id_reservation);
        }
    }
    
}
