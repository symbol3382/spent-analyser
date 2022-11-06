<?php

namespace App\View\Components;

use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TransactionFormModal extends Component {

    public $transaction;

    public $transactionId;
    public $transactionAmount;
    public $transactionComment;
    public $transactionCategoryId;
    public $transactionTime;
    public $categories;


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($transactionId, $transactionAmount, $transactionComment, $transactionCategoryId, $transactionTime) {
        $this->transactionId = $transactionId;
        $this->transactionAmount = $transactionAmount;
        $this->transactionComment = $transactionComment;
        $this->transactionCategoryId = $transactionCategoryId;
        $this->transactionTime = $transactionTime;
        $this->categories = Category::orderBy('category_name')->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|\Closure|string
     */
    public function render() {
        return view('components.transaction-form-modal');
    }
}
