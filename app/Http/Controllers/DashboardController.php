<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller {
    public function dashboard() {
        $transactions = Transaction::with('category')
            ->where('user_id', Auth::id())
            ->orderBy('transaction_time', 'desc')
            ->get();
        $categories = Category::all();
        return view('dashboard.dashboard')->with([
            'headerNavTab' => 'dashboard',
            'transactions' => $transactions,
            'categories'   => $categories,
        ]);
    }
}
