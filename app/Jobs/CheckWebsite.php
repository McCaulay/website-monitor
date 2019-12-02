<?php
namespace App\Jobs;

use App\Models\Website;
use GuzzleHttp\TransferStats;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CheckWebsite implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The website to be checked.
     *
     * @var \App\Models\Website
     */
    protected $website;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Website $website)
    {
        $this->website = $website;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Guzzle
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', $this->website->url, [
            'on_stats' => function (TransferStats $stats) {
                // Record the website check
                $this->website->createCheck(
                    $stats->getHandlerStat('http_code'), // HTTP Code (eg 404)
                    $stats->getTransferTime() * 1000// Total time in ms
                    // $stats->getHandlerStat('namelookup_time') * 1000, // DNS Lookup time in ms
                    // $stats->getHandlerStat('connect_time') * 1000, // Connect time in ms
                    // $stats->getHandlerStat('pretransfer_time') * 1000, // Pretransfer time in ms
                    // $stats->getHandlerStat('redirect_time') * 1000, // Redirect time in ms
                    // $stats->getHandlerStat('starttransfer_time') * 1000, // Start transfer time in ms
                    // $stats->getHandlerStat('appconnect_time') * 1000, // APP connect time in ms
                    // $stats->getHandlerStat('size_download'), // Download size
                    // $stats->getHandlerStat('speed_download'), // Download speed
                );

            },
        ]);
    }
}
