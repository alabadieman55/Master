<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class AnalyticsController extends Controller
{
    public function revenueAnalytics(Request $request)
    {
        $days = $request->input('days', 30); // Default to 30 days

        $data = Cache::remember('revenue_analytics_' . $days, now()->addHours(6), function () use ($days) {
            return DB::table('orders')
                ->select(
                    DB::raw('DATE(created_at) as date'),
                    DB::raw('SUM(total) as total')
                )
                ->where('status', 'ordered')
                ->where('created_at', '>=', now()->subDays($days))
                ->groupBy('date')
                ->orderBy('date', 'asc')
                ->get();
        });


        return view('analytics.analytics', compact('data', 'days'));
    }
}
