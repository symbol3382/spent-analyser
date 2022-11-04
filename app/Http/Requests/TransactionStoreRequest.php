<?php

namespace App\Http\Requests;

use App\Models\Transaction;
use Illuminate\Foundation\Http\FormRequest;

class TransactionStoreRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        $isCredit = Transaction::$transactionType_Credit;
        return [
            'transaction_amount' => 'required|min:0',
            'category'           => 'required',
            'is_credit'          => "nullable|in:$isCredit",
        ];
    }
}
