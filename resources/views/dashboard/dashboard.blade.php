@extends('layouts.app')
@section('body')
    @include('components.navigation.navigation')
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                @include('transaction.create-inline')
            </div>
        </div>
    </div>
@endsection
