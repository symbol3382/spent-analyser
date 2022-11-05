<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionDeleteRequest;
use App\Http\Requests\TransactionStoreRequest;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller {

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
            'transaction_type' => $request->input('is_credit', Transaction::$transactionType_Debit)
        ]);
        return $transaction;
    }

    public function deleteTransaction(TransactionDeleteRequest $request) {
        Transaction::find($request->input('transaction_id'))->delete();
        return redirect()->back();
    }
}
