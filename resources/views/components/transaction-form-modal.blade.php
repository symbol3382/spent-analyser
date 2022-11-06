<div class="modal fade" id="trans-modify-modal{{$transactionId}}" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modify Transaction Detail</h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"
                        onclick="resetCategoryType({{ $transactionId }})"></button>
            </div>
            <form action="{{ route('transaction.modify') }}" method="POST" id="transaction-modify{{ $transactionId }}">
                @csrf
                <div class="modal-body">
                    <input type="hidden" value="{{ $transactionId }}" name="transaction_id">

                    {{-- Transaction Amount Field --}}
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fa-solid fa-indian-rupee-sign"></i>
                        </span>
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Amount"
                            id="transaction-amount"
                            name="transaction_amount"
                            value="{{ $transactionAmount }}"
                            aria-label="transaction-amount"
                            aria-describedby="basic-addon1"
                        />
                        <div class="input-group-text br-0_25rem_r">
                            <label class="form-check-label" for="amountIdCredit">
                                <i class="fa-solid fa-credit-card"></i>
                                Credit
                                &nbsp;
                            </label>
                            <input class="form-check-input mt-0" name="is_credit" id="amountIdCredit" type="checkbox"
                                   value="{{ \App\Models\Transaction::$transactionType_Credit }}"
                                   aria-label="Is Amount Credited" />
                        </div>
                    </div>

                    {{-- Transaction Comment Field --}}
                    <div class="input-group br-0_25rem_r  mb-3">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="fa-solid fa-comment"></i>
                        </span>
                        <input
                            type="text"
                            name="transaction_comment"
                            class="form-control @error('transaction_comment') is-invalid @enderror br-0_25rem_r"
                            placeholder="Comment"
                            aria-label="Comment"
                            aria-describedby="basic-addon1"
                            value="{{ $transactionComment }}"
                        />
                        <div id="validationServerUsernameFeedback" class="invalid-feedback">
                            @error('transaction_comment') {{ $message }} @enderror
                        </div>
                    </div>

                    {{-- Transaction Category Field --}}
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-sitemap"></i></span>
                        <select
                            class="form-select form-select br-0_25rem form-select-sm-mdb @error('category') is-invalid @enderror"
                            name="category"
                            id="category-select{{ $transactionId }}"
                            aria-describedby="validationForCategory"
                            aria-label="Default select example">
                            <option value="" selected>Select Category</option>
                            @foreach($categories as $category)
                                <option
                                    value="{{ $category->category_name }}"
                                    {{ $category->id == $transactionCategoryId ? "selected" : "" }}
                                > {{ ucwords($category->category_name) }}</option>
                            @endforeach
                        </select>
                        <input
                            type="text"
                            class="form-control br-0_25rem @error('category') is-invalid @enderror "
                            id="category-create{{ $transactionId }}"
                            placeholder="Add New Category"
                            aria-label="Category"
                            aria-describedby="basic-addon1"
                            hidden
                        />
                        <span class="input-group-text br-0_25rem_r" id="basic-addon2">
                        <button type="button" id="category-select-toggle{{ $transactionId }}"
                                onclick="toggleCategoryAdd({{ $transactionId }})">
                            <i class="fa-solid fa-plus"></i> Add New
                        </button>
                    </span>
                    </div>

                    {{-- Transaction Time Field --}}
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="addon-wrapping"><i
                                class="fa-solid fa-calendar-days"></i></span>
                        <input type="datetime-local" class="form-control br-0_25rem_r" id="transaction-date"
                               value="{{ $transactionTime }}"
                               name="transaction_time">
                        <div id="validationServerUsernameFeedback" class="invalid-feedback">

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal"
                            onclick="resetCategoryType({{ $transactionId }})">Close
                    </button>
                    <button type="submit" class="btn btn-primary">Save
                        changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
