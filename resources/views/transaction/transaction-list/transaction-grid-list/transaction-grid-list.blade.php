@foreach($transactions as $transaction)
    <x-transaction-form-modal
        transactionAmount="{{$transaction->amount}}"
        transactionComment="{{$transaction->comment}}"
        transactionCategoryId="{{$transaction->category_id}}"
        transactionTime="{{$transaction->transaction_time}}"
        transactionId="{{ $transaction->id }}"
    >

    </x-transaction-form-modal>

    <div class="card mb-3 border shadow-0 {{
        $transaction->transaction_type === \App\Models\Transaction::$transactionType_Credit ? "bg-credit" : "bg-debit"
    }} trans-grid-hover">
        <div class="card-body">
            <div class="row align-items-center d-flex">
                <div class="col-8">
                    <div class="col-12">
                        <h5 class="card-title">
                            {{ ucwords($transaction->category->category_name) }}
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
                    <button type="button" class="ms-2 trans-grid-action" data-mdb-toggle="modal"
                            data-mdb-target="#trans-modify-modal{{$transaction->id}}">
                        <i class="fa-solid fa-pencil shadow-5-strong"></i>
                    </button>

                    <form class="ps-2 display-inline-block" action="{{route('transaction.delete') }}" method="POST">
                        @csrf
                        <input type="hidden" name="_method" value="delete">
                        <input type="hidden" name="transaction_id" value="{{ $transaction->id }}">
                        <button type="submit" class="trans-grid-action">
                            <i class="fa-solid fa-trash shadow-5-strong"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
