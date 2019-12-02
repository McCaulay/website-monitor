<?php
namespace App\Http\Controllers;

use App\Models\Check;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard.index', $this->data());
    }

    /**
     * Get the application data.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function data()
    {
        $websites = Auth::user()->websites;
        $averageResponseTime = $this->getAverageResponseTimeToday();
        $checkCount = $this->getChecksCountToday();

        // Get response times
        $checkResponses = $this->getResponses();

        // Build times
        $responseTimes = $checkResponses->map(function ($check) {
            return $check->load_time;
        })->reverse()->values();

        // Build texts
        $responseTimeTexts = $checkResponses->map(function ($check) {
            return $check->website->name . ' ' . $check->created_at->format('g:ia');
        })->reverse()->values();

        return [
            'websites' => $websites,
            'averageResponseTime' => $averageResponseTime,
            'checkCount' => $checkCount,
            'responseTimes' => $responseTimes,
            'responseTimeTexts' => $responseTimeTexts,
        ];
    }

    /**
     * Get the average website response time today.
     *
     * @return float
     */
    private function getAverageResponseTimeToday(): float
    {
        return round(Auth::user()->websites->map(function ($website) {
            return $website->checks()
                ->whereDate('created_at', now())
                ->get()
                ->map(function ($check) {
                    return $check->load_time;
                });
        })->flatten()->avg(), 2);
    }

    /**
     * Get the number of website checks ran today.
     *
     * @return int
     */
    private function getChecksCountToday(): int
    {
        return Auth::user()->websites->reduce(function ($carry, $website) {
            return $carry + $website->checks()->whereDate('created_at', now())->count();
        });
    }

    /**
     * Get the response times data.
     *
     * @return \Illuminate\Support\Collection
     */
    private function getResponses()
    {
        return Check::with('website')->whereHas('website', function ($query) {
            $query->where('user_id', Auth::id());
        })->latest()
            ->limit(30)
            ->get();
    }
}
