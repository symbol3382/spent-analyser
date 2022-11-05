<div class="card mt-5">
    <div class="card-body">
        <div class="row w-100">
            <div class="col-3">
                <!-- Tab navs -->
                <div class="card border ">
                    <div class="card-body">
                        <div
                            class="nav nav-pills flex-column nav-tabs text-center"
                            id="v-tabs-tab"
                            role="tablist"
                            aria-orientation="vertical"
                        >
                            <a
                                class="nav-link active"
                                id="v-tabs-transaction-list-tab"
                                data-mdb-toggle="tab"
                                href="#v-tabs-transaction-list"
                                role="tab"
                                aria-controls="v-tabs-transaction-list"
                                aria-selected="true"
                            >
                                Transaction List
                            </a>
                            <a
                                class="nav-link"
                                id="v-tabs-analytics-tab"
                                data-mdb-toggle="tab"
                                href="#v-tabs-analytics"
                                role="tab"
                                aria-controls="v-tabs-analytics"
                                aria-selected="false"
                            >
                                Spent Analytics
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Tab navs -->
            </div>

            <div class="col-9">
                <!-- Tab content -->
                <div class="tab-content" id="v-tabs-tabContent">
                    <div
                        class="tab-pane fade show active"
                        id="v-tabs-transaction-list"
                        role="tabpanel"
                        aria-labelledby="v-tabs-transaction-list-tab"
                    >
                        @include('transaction.transaction-list.transaction-list')
                    </div>
                    <div
                        class="tab-pane fade"
                        id="v-tabs-analytics"
                        role="tabpanel"
                        aria-labelledby="v-tabs-analytics-tab"
                    >
                        Profile content
                    </div>
                </div>
                <!-- Tab content -->
            </div>
        </div>
    </div>
</div>
