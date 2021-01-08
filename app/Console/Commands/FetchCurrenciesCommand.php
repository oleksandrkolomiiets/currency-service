<?php

namespace App\Console\Commands;

use App\Services\CurrencyService;
use Illuminate\Console\Command;

class FetchCurrenciesCommand extends Command
{
    protected CurrencyService $service;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currencies:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch currencies';

    /**
     * Create a new command instance.
     *
     * @param CurrencyService $service
     */
    public function __construct(CurrencyService $service)
    {
        $this->service = $service;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if ($this->service->fetchAndInsert()) {
            $this->info('Finished successfully!');
        } else {
            $this->error('Something went wrong!');
        }

        return 0;
    }
}
