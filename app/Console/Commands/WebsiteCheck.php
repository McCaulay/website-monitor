<?php
namespace App\Console\Commands;

use App\Jobs\CheckWebsite;
use App\Models\Website;
use Illuminate\Console\Command;

class WebsiteCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'website:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks the status of each website';

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
     * @return mixed
     */
    public function handle()
    {
        // Process 100 websites at a time from database...
        Website::active()->chunk(100, function ($websites) {
            // Loop each website
            $websites->each(function ($website) {
                // Dispatch the check website job to run
                $this->info('Dispatching ' . $website->name);
                CheckWebsite::dispatch($website);
            });
        });
    }
}
