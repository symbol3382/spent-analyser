<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionDeleteRequest;
use App\Http\Requests\TransactionStoreRequest;
use App\Http\Requests\TransactionUpdateRequest;
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
        Transaction::create([
            'amount'           => $request->input('transaction_amount'),
            'user_id'          => Auth::id(),
            'transaction_time' => $request->input('transaction_time'),
            'category_id'      => $category->id,
            'transaction_type' => $request->input('is_credit', Transaction::$transactionType_Debit),
            'comment'          => $request->input('transaction_comment'),
        ]);
        return redirect()->back();
    }

    public function updateTransaction(TransactionUpdateRequest $request) {
        $transaction = Transaction::find($request->input('transaction_id'));

        $category = Category::firstOrCreate([
            'category_name' => strtolower($request->input('category')),
        ], [
            'created_by' => Auth::id(),
        ]);

        $transaction->amount = $request->input('transaction_amount');
        $transaction->transaction_time = $request->input('transaction_time');
        $transaction->category_id = $category->id;
        $transaction->transaction_type = $request->input('is_credit', Transaction::$transactionType_Debit);
        $transaction->comment = $request->input('transaction_comment');

        $transaction->update();

        return redirect()->back();
    }

    public function deleteTransaction(TransactionDeleteRequest $request) {
        Transaction::find($request->input('transaction_id'))->delete();
        return redirect()->back();
    }
}
