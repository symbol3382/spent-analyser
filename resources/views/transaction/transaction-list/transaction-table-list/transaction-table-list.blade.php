<div class="table-responsive">

    <table class="table ">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Category</th>
            <th scope="col">amount</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($transactions as $key => $transaction)
            <tr class="{{ $transaction->transaction_type === \App\Models\Transaction::$transactionType_Credit ? "bg-credit" : "bg-debit" }}">
                <th scope="row">{{ $key + 1 }}</th>
                <td> {{ucfirst($transaction->category->category_name)}}</td>
                <td><i class="fa-solid fa-indian-rupee-sign fa-xs"></i> {{ $transaction->amount }}</td>
                <td>
                    <form class="ps-2 display-inline-block" action="{{route('transaction.delete') }}" method="POST">
                        @csrf
                        <input type="hidden" name="_method" value="delete">
                        <input type="hidden" name="transaction_id" value="{{ $transaction->id }}">
                        <button type="submit" class="trans-grid-delete">
                            <i class="fa-solid fa-trash shadow-5-strong"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
