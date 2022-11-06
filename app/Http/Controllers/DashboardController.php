<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Services\AnalyticsService;
use App\Models\Category;
use App\Models\Transaction;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller {

    private $analyticsService;

    public function dashboard(Request $request) {
        $transactions = Transaction::with('category')
            ->where('user_id', Auth::id())
            ->orderBy('transaction_time', 'desc')
            ->where(function ($q) use ($request) {
                if ($request->input('filter_month', 'all') !== 'all') {
                    $q->where(DB::raw('MONTHNAME(transaction_time)'), $request->input('filter_month'));
                }
            })
            ->get();
        $categories = Category::all();

        $selectedMonth = $request->input('filter_month');

        $this->analyticsService = new AnalyticsService();
        $analytics = $this->analyticsService->prepareAnalytics($transactions);

        return view('dashboard.dashboard')->with([
            'headerNavTab'  => 'dashboard',
            'transactions'  => $transactions,
            'categories'    => $categories,
            'selectedMonth' => $selectedMonth,
            'analytics'     => json_encode($analytics),
        ]);
    }
}
