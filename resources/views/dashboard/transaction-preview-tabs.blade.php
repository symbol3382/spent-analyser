<div class="card mt-5">
    <div class="card-body">
        <div class="row">
            <div class="col-2">
                <div class="card border mb-4">
                    <div class="card-body">
                        <div
                            class="nav nav-pills flex-column nav-tabs text-center"
                            id="v-tabs-tab"
                            role="tablist"
                            aria-orientation="vertical"
                        >
                            <form action="{{ route('dashboard') }}" method="get">

                                <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="fa-solid fa-calendar-days"></i>
                                </span>
                                    <select
                                        class="form-select form-select br-0_25rem form-select-sm-mdb @error('category') is-invalid @enderror"
                                        name="filter_month"
                                        id="category-select"
                                        aria-describedby="validationForCategory"
                                        aria-label="Default select example">
                                        <option value="" {{ $selectedMonth == 'all' ? 'Selected' : ''}}>All
                                        </option>

                                        <option value="January" {{ $selectedMonth === 'January' ? 'Selected' : ''  }}>
                                            January
                                        </option>
                                        <option value="February" {{ $selectedMonth === 'February' ? 'Selected' : ''  }}>
                                            February
                                        </option>
                                        <option value="March" {{ $selectedMonth === 'March' ? 'Selected' : ''  }}>March
                                        </option>
                                        <option value="April" {{ $selectedMonth === 'April' ? 'Selected' : ''  }}>April
                                        </option>
                                        <option value="May" {{ $selectedMonth === 'May' ? 'Selected' : ''  }}>May
                                        </option>
                                        <option value="June" {{ $selectedMonth === 'June' ? 'Selected' : ''  }}>June
                                        </option>
                                        <option value="July" {{ $selectedMonth === 'July' ? 'Selected' : ''  }}>July
                                        </option>
                                        <option value="August" {{ $selectedMonth === 'August' ? 'Selected' : ''  }}>
                                            August
                                        </option>
                                        <option
                                            value="September" {{ $selectedMonth === 'September' ? 'Selected' : ''  }}>
                                            September
                                        </option>
                                        <option value="October" {{ $selectedMonth === 'October' ? 'Selected' : ''  }}>
                                            October
                                        </option>
                                        <option value="November" {{ $selectedMonth === 'November' ? 'Selected' : ''  }}>
                                            November
                                        </option>
                                        <option value="December" {{ $selectedMonth === 'December' ? 'Selected' : ''  }}>
                                            December
                                        </option>

                                    </select>
                                </div>

                                <button class="btn btn-secondary" type="submit">Apply Filter</button>
                            </form>

                        </div>
                    </div>
                </div>

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
                                id="v-tabs-analytics-tab"
                                data-mdb-toggle="tab"
                                href="#v-tabs-analytics"
                                role="tab"
                                aria-controls="v-tabs-analytics"
                                aria-selected="false"
                            >
                                Spent Analytics
                            </a>
                            <a
                                class="nav-link"
                                id="v-tabs-transaction-list-tab"
                                data-mdb-toggle="tab"
                                href="#v-tabs-transaction-list"
                                role="tab"
                                aria-controls="v-tabs-transaction-list"
                                aria-selected="true"
                            >
                                Transaction List
                            </a>

                        </div>
                    </div>
                </div>
                <!-- Tab navs -->
            </div>

            <div class="col-10">
                <!-- Tab content -->
                <div class="tab-content" id="v-tabs-tabContent">

                    <div
                        class="tab-pane fade show active"
                        id="v-tabs-analytics"
                        role="tabpanel"
                        aria-labelledby="v-tabs-analytics-tab"
                    >
                        @include('analytics.spent-analytics')
                    </div>
                    <div
                        class="tab-pane fade"
                        id="v-tabs-transaction-list"
                        role="tabpanel"
                        aria-labelledby="v-tabs-transaction-list-tab"
                    >
                        @include('transaction.transaction-list.transaction-list')
                    </div>
                </div>
                <!-- Tab content -->
            </div>
        </div>
    </div>
</div>
