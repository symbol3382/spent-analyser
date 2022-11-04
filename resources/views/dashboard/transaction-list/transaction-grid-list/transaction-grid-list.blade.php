@foreach($transactions as $transaction)

    <div class="card mb-3 border shadow-0 {{
        $transaction->transaction_type === \App\Models\Transaction::$transactionType_Credit ? "bg-credit" : "bg-debit"
    }}">
        <div class="card-body">
            <div class="row align-items-center d-flex">
                <div class="col-9">
                    <div class="col-12">
                        <h5 class="card-title">
                            {{ $transaction->category->category_name }} {{ $transaction->transaction_type  }}
                        </h5>
                    </div>
                    <div class="col-12">
                        <p class="card-text">
                            {{ $transaction->transaction_time->format('Y-m-d | h:i A')}}
                        </p>
                    </div>
                </div>
                <div class="col-3 text-center">
                    <i class="fa-solid fa-indian-rupee-sign fa-lg"></i>
                    <h3 class="display-inline-block">
                        {{ $transaction->amount }}
                    </h3>
                </div>
            </div>
        </div>
    </div>


@endforeach
