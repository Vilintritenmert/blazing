<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Vilintritenmert\SimpleCurrency;
use Illuminate\Support\Facades\Cache;

class UpdateCurrencies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currency_update';

    /**
    * Simple Currency 
    */
   protected $simple_currency;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update currencies cost';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(SimpleCurrency $simple_currency)
    {
        parent::__construct();
        $this->simple_currency = $simple_currency;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $currencies = $this->simple_currency->get();
        Cache::forever('currencies', $currencies);
    }
}
