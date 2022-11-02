<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionStoreRequest;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactoinController extends Controller {
    public function createTransaction(TransactionStoreRequest $request) {
        $category = Category::firstOrCreate([
            'category_name' => strtolower($request->input('category')),
        ], [
            'created_by' => Auth::id(),
        ]);
        $transaction = Transaction::create([
            'amount'           => $request->input('transaction_amount'),
            'user_id'          => Auth::id(),
            'transaction_time' => $request->input('transaction_time'),
            'category_id'      => $category->id,
        ]);
        return $transaction;
        dd($request->all());
    }
}
