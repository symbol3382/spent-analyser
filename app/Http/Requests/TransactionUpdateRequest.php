<?php

namespace App\Http\Requests;

use App\Models\Transaction;
use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TransactionUpdateRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array {
        $isCredit = Transaction::$transactionType_Credit;
        return [
            'transaction_id'     => ['required', Rule::exists('transactions', 'id')->where('user_id', Auth::id())],
            'transaction_amount' => 'required|min:1',
            'category'           => 'required',
            'is_credit'          => "nullable|in:$isCredit",
        ];
    }
}
