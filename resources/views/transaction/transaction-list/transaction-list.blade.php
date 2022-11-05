<div class="card border">
    <div class="card-body">
        @if(!count($transactions ?? []))
            <h5 class="card-title text-center">No Transaction</h5>
            <h5 class="card-title text-center">Please add from above form to see the list</h5>
        @else
            <div class="d-flex justify-content-between">
                <div class="p-2 flex-grow-1">
                    <h5 class="card-title">Transactions</h5>
                </div>
                <!-- Tabs navs -->
                <ul class="nav nav-tabs mb-3" id="ex1" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a
                            class="nav-link active"
                            id="trans-grid-list"
                            data-mdb-toggle="tab"
                            href="#trans-grid-list-link"
                            role="tab"
                            aria-controls="trans-grid-list-link"
                            aria-selected="true"
                        >
                            <i class="fa-solid fa-list"></i>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a
                            class="nav-link"
                            id="trans-table-list"
                            data-mdb-toggle="tab"
                            href="#trans-table-list-link"
                            role="tab"
                            aria-controls="trans-table-list-link"
                            aria-selected="true"
                        >
                            <i class="fa-solid fa-table-list"></i>
                        </a>
                    </li>
                </ul>
                <!-- Tabs navs -->
            </div>

            <!-- Tabs content -->
            <div class="tab-content" id="ex1-content">
                <div
                    class="tab-pane fade show active"
                    id="trans-grid-list-link"
                    role="tabpanel"
                    aria-labelledby="trans-grid-list"
                >
                    @include('transaction.transaction-list.transaction-grid-list.transaction-grid-list')
                </div>
                <div
                    class="tab-pane fade"
                    id="trans-table-list-link"
                    role="tabpanel"
                    aria-labelledby="trans-table-list"
                >
                    @include('transaction.transaction-list.transaction-table-list.transaction-table-list')
                </div>
            </div>
            <!-- Tabs content -->
        @endif
    </div>
</div>
