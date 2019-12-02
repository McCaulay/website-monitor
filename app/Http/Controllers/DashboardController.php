<?php
namespace App\Http\Controllers;

use App\Models\Website;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $websites = Website::get();
        return view('dashboard.index', compact('websites'));
    }
}
