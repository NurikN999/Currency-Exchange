<?php

namespace App\Jobs;

use App\Models\Currency;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CurrencyHistoryJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $currencyHistory = new Currency();
        $currencyHistory->USD = $this->data['USD'];
        $currencyHistory->EUR = $this->data['EUR'];
        $currencyHistory->GBP = $this->data['GBP'];
        $currencyHistory->RUB = $this->data['RUB'];
        $currencyHistory->CNH = $this->data['CNH'];
        $currencyHistory->save();
    }
}
