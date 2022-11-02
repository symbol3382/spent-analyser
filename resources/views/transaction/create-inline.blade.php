<form action="{{route('transaction.create')}}" method="post">
    {{@csrf_field()}}
    <div class="row">

        <div class="col-4">
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">
                    <i class="fa-solid fa-indian-rupee-sign"></i>
                </span>
                <input
                    type="number"
                    name="transaction_amount"
                    class="form-control "
                    placeholder="Amount"
                    aria-label="Amount"
                    aria-describedby="basic-addon1"
                />
                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    Please choose a username.
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="col-12">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-sitemap"></i></span>
                    <select class="form-select form-select form-select-sm-mdb" name="category"
                            aria-label="Default select example">
                        <option selected>Category</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                    <div id="validationServerUsernameFeedback" class="invalid-feedback">
                        Please choose a username.
                    </div>
                </div>
            </div>
            <div class="col-12">
                <a href="" class="">
                    <i class="fa-solid fa-plus"></i> Add New Category
                </a>
            </div>
        </div>

        <div class="col-3">
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="addon-wrapping"><i class="fa-solid fa-calendar-days"></i></span>
                <input type="datetime-local" class="form-control" id="transaction-date" name="transaction-time">
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
    $(document).ready(function () {
        let transactionDatePicker = $('#transaction-date');
        let d = new Date();
        const dateTimeLocalValue = (new Date(d.getTime() - d.getTimezoneOffset() * 60000).toISOString()).slice(0, -8);
        transactionDatePicker.val(dateTimeLocalValue)
    });
</script>
