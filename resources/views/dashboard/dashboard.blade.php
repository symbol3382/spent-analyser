@extends('layouts.app')
@section('body')
    @include('components.navigation.navigation')
    <div class="container-fluid mt-5">
        <div class="card ">
            <div class="card-body">
                @include('transaction.create-inline')
            </div>
        </div>
        @include('dashboard.transaction-preview-tabs')
    </div>
@endsection
