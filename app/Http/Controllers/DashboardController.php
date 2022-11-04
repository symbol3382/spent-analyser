<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller {
    public function dashboard() {
        $transactions = Transaction::with('category')
            ->where('user_id', Auth::id())
            ->orderBy('transaction_time', 'desc')
            ->get();
        return view('dashboard.dashboard')->with(['transactions' => $transactions]);
    }
}
