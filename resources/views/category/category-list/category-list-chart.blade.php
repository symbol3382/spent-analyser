@extends('layouts.app')
@section('body')
    @include('components.navigation.navigation')
    <div class="container mt-3">
        <div class="d-flex mb-3 justify-content-between">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a
                            href=" {{ route('category.list') }}">Categories</a>
                    </li>
                    @foreach($parentCategories as $parentCategory)
                        <li class="breadcrumb-item"><a
                                href=" {{ route('category.list', ['parent' => $parentCategory->id]) }}">{{ ucwords($parentCategory->category_name) }}</a>
                        </li>
                    @endforeach
                </ol>
            </nav>
            <button
                type="button"
                class="btn btn-primary btn-floating"
                data-mdb-target="#category-form-modal"
                data-mdb-toggle="modal"
            ><i class="fa-solid fa-plus"></i></button>
        </div>
        <x-error-box></x-error-box>
        <div class="card ">
            <div class="card-body">
                <div class="d-flex flex-wrap">
                    @foreach($categories as $category)
                        <div class="col-4 pe-3 ps-3 mb-4"
                        >
                            <div
                                class="h-100 align-items-center br-100 d-flex border shadow-3-strong p-3 pe-4 ps-4 category-grid"
                            >
                                <a class="flex-fill plain-anchor"
                                   href=" {{ route('category.list', ['parent' => $category->id]) }}"
                                >
                                    {{ ucwords($category->category_name) }}
                                </a>
                                <div class="">
                                    <button
                                        type="button"
                                        class=""
                                        data-mdb-target="#category-form-modal{{$category->id}}"
                                        data-mdb-toggle="modal"
                                    >
                                        <i class="fa-solid fa-pen shadow-5-strong"></i>
                                    </button>
                                </div>
                                <div class="ms-3 ">
                                    <form action="{{route('category.delete')}}" method="POST">
                                        @csrf
                                        <input type="hidden" value="DELETE" name="_method">
                                        <input type="hidden" value="{{$category->id}}" name="category_id">
                                        <button type="submit">
                                            <i class="fa-solid fa-trash shadow-5-strong"></i>
                                        </button>
                                    </form>
                                </div>
                                <div>

                                </div>
                            </div>
                        </div>
                        <x-category-form-modal
                            categoryId="{{$category->id}}"
                            categoryName="{{$category->category_name}}"
                            parentCategory="{{$category->parent_category_id}}"
                        ></x-category-form-modal>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <x-category-form-modal categoryId="" categoryName="" parentCategory=""></x-category-form-modal>
@endsection
