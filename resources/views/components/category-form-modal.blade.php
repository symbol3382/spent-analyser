<div class="modal fade" id="category-form-modal{{$categoryId}}" tabindex="-1"
     aria-labelledby="category-form-modal-label"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="category-form-modal-label">
                    Category {{ $categoryId ? 'Modify' : "Create" }}</h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('category.create') }}" method="post">
                @csrf
                @if($categoryId)
                    <input type="hidden" value="{{$categoryId}}" name="category_id">
                @endif
                <div class="modal-body">
                    <label for="category-name">Category Name</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-sitemap"></i></span>
                        <input
                            name="category_name"
                            value="{{$categoryName}}"
                            type="text"
                            class="form-control br-0_25rem @error('category') is-invalid @enderror"
                            id="category-name"
                            placeholder="Category Name"
                            aria-label="Category"
                            aria-describedby="basic-addon1"
                        />
                    </div>
                    <label for="parent-category">Parent Category</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-sitemap"></i></span>
                        <select
                            class="form-select form-select br-0_25rem form-select-sm-mdb @error('category') is-invalid @enderror"
                            name="parent_category_id"
                            id="parent-category"
                            aria-describedby="validationForCategory"
                            aria-label="Default select example">
                            <option value="" selected>No Parent Category</option>
                            @foreach($allCategories as $category)
                                @if($category->id != $categoryId)
                                    <option
                                        value="{{ $category->id }}"
                                        {{
                                            $parentCategory == $category->id
                                            ? "Selected" : ""
                                        }}
                                    >
                                        {{ ucwords($category->category_name) }}

                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
