<form action="{{route('transaction.create')}}" method="post">
    {{@csrf_field()}}
    <div class="row">
        <div class="col-5">
            <div class="row">
                <div class="col-6">
                    <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">
                        <i class="fa-solid fa-indian-rupee-sign"></i>
                    </span>
                        <input
                            type="number"
                            name="transaction_amount"
                            class="form-control @error('transaction_amount') is-invalid @enderror "
                            placeholder="Amount"
                            aria-label="Amount"
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
                        <div id="validationServerUsernameFeedback" class="invalid-feedback">
                            @error('transaction_amount') {{ $message }} @enderror
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="input-group br-0_25rem_r">
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
                        />
                        <div id="validationServerUsernameFeedback" class="invalid-feedback">
                            @error('transaction_comment') {{ $message }} @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-5">
            <div class="row">
                <div class="col-6">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-sitemap"></i></span>
                        <select
                            class="form-select form-select br-0_25rem form-select-sm-mdb @error('category') is-invalid @enderror"
                            name="category"
                            id="category-select"
                            aria-describedby="validationForCategory"
                            aria-label="Default select example">
                            <option value="" selected>Select Category</option>
                            @foreach($categories as $category)
                                <option
                                    value="{{ $category->category_name }}"> {{ ucwords($category->category_name) }}</option>
                            @endforeach
                        </select>
                        <input
                            type="text"
                            class="form-control br-0_25rem @error('category') is-invalid @enderror "
                            id="category-create"
                            placeholder="Add New Category"
                            aria-label="Category"
                            aria-describedby="basic-addon1"
                            hidden
                        />
                        <span class="input-group-text br-0_25rem_r" id="basic-addon2">
                        <button type="button" id="category-select-toggle" class="plain-button" onclick="toggleCategoryAdd()">
                            <i class="fa-solid fa-plus"></i> Add New
                        </button>
                    </span>
                    </div>
                </div>
                <div class="col-6">

                    <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="addon-wrapping"><i
                                class="fa-solid fa-calendar-days"></i></span>
                        <input type="datetime-local" class="form-control br-0_25rem_r" id="transaction-date"
                               name="transaction_time">
                        <div id="validationServerUsernameFeedback" class="invalid-feedback">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-2 text-center d-flex  align-items-baseline justify-content-center">
            <button class="btn btn-primary w-100" type="submit">Add Transaction</button>
        </div>
    </div>
</form>

<script>
    $(document).ready(function () {
        let transactionDatePicker = $('#transaction-date');
        let d = new Date();
        const dateTimeLocalValue = (new Date(d.getTime() - d.getTimezoneOffset() * 60000).toISOString()).slice(0, -8);
        transactionDatePicker.val(dateTimeLocalValue)
    });
</script>
