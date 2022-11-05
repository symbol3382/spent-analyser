@foreach($transactions as $transaction)

    <div class="card mb-3 border shadow-0 {{
        $transaction->transaction_type === \App\Models\Transaction::$transactionType_Credit ? "bg-credit" : "bg-debit"
    }}">
        <div class="card-body">
            <div class="row align-items-center d-flex">
                <div class="col-8">
                    <div class="col-12">
                        <h5 class="card-title">
                            {{ ucfirst($transaction->category->category_name) }}
                        </h5>
                    </div>
                    <div class="col-12">
                        <p class="card-text">
                            {{ $transaction->transaction_time->format('Y-m-d | h:i A')}}
                        </p>
                    </div>
                </div>
                <div class="col-4 text-end">
                    <i class="fa-solid fa-indian-rupee-sign fa-lg"></i>
                    <h3 class="display-inline-block">
                        {{ $transaction->amount }}
                    </h3>
                    <form class="ps-2 display-inline-block" action="{{route('transaction.delete') }}" method="POST">
                        @csrf
                        <input type="hidden" name="_method" value="delete">
                        <input type="hidden" name="transaction_id" value="{{ $transaction->id }}">
                        <button type="submit" class="trans-grid-delete">
                            <i class="fa-solid fa-trash shadow-5-strong"></i>
                        </button>
                    </form>
                    {{--                    <a href="{{ route('') }}" class="p-3 trans-grid-delete">--}}
                    {{--                    </a>--}}
                </div>
            </div>
        </div>
    </div>
@endforeach
