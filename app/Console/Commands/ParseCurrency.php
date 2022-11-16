<?php

namespace App\Console\Commands;

use App\Jobs\CurrencyHistoryJob;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class ParseCurrency extends Command
{
    protected $listOfQuotes = [
        "USD",
        "EUR",
        "GBP",
        "RUB",
        "CNH",
    ];
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:currency';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parsing currency';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $data = [];

            foreach ($this->listOfQuotes as $quote) {
                $data[$quote] = Http::withHeaders(
                    [
                        'X-RapidAPI-Key' => config('services.tmdb.token'),
                    ]
                )->get('https://currency-exchange.p.rapidapi.com/exchange', [
                    'from' => $quote,
                    'to' => 'KZT',
                    'q' => 1
                ])->json();
            }
            print 'I\'m here';
            CurrencyHistoryJob::dispatch($data);
//            return $data;
        }catch (Exception $e) {
            Log::error('Error was occured: ' . $e->getMessage(), 500);
        }
    }
}
