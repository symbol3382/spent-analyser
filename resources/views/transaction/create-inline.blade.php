<form action="{{route('transaction.create')}}" method="post">
    {{@csrf_field()}}
    <div class="row">

        <div class="col-3">

            <div class="col-12">
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
                               value="{{ \App\Models\Transaction::$transactionType_Credit }}" aria-label="Is Amount Credited" />
                    </div>
                    <div id="validationServerUsernameFeedback" class="invalid-feedback">
                        @error('transaction_amount') {{ $message }} @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="col-12">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-sitemap"></i></span>
                    <select
                        class="form-select form-select br-0_25rem form-select-sm-mdb @error('category') is-invalid @enderror"
                        name="category"
                        id="category-select"
                        aria-describedby="validationForCategory"
                        aria-label="Default select example">
                        <option selected>Select Category</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
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
                        <button type="button" id="category-select-toggle" onclick="toggleCategoryAdd()">
                            <i class="fa-solid fa-plus"></i> Add New
                        </button>
                    </span>
                </div>
            </div>

        </div>

        <div class="col-3">
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="addon-wrapping"><i class="fa-solid fa-calendar-days"></i></span>
                <input type="datetime-local" class="form-control br-0_25rem_r" id="transaction-date"
                       name="transaction_time">
                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    Please choose a username.
                </div>
            </div>
        </div>


        <div class="col-2 text-center">
            <button class="btn btn-primary" type="submit">Add Transaction</button>
        </div>
    </div>
</form>

<script>
    let currentCategoryMode = 'select';
    let toggleCategoryAdd = () => {
        let categorySelect = $("#category-select");
        let categoryCreate = $("#category-create");
        let categorySelectToggleBtn = $('#category-select-toggle');
        let faPlus = $('#fa-plus');

        currentCategoryMode = currentCategoryMode === 'select' ? 'create' : 'select';

        let visible = currentCategoryMode === 'select' ? categorySelect : categoryCreate;
        let hidden = currentCategoryMode === 'select' ? categoryCreate : categorySelect;


        visible.removeAttr('hidden');
        hidden.attr('hidden', true);

        visible.attr('name', 'category');
        hidden.removeAttr('name');

        categorySelectToggleBtn.html(currentCategoryMode === 'select' ? '<i class="fa-solid fa-plus"></i> Add New' : '<i class="fa-solid fa-arrow-left"></i>');
    }

    $(document).ready(function () {
        let transactionDatePicker = $('#transaction-date');
        let d = new Date();
        const dateTimeLocalValue = (new Date(d.getTime() - d.getTimezoneOffset() * 60000).toISOString()).slice(0, -8);
        transactionDatePicker.val(dateTimeLocalValue)
    });
</script>
