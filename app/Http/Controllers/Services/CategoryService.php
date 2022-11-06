<?php

namespace App\Http\Controllers\Services;

use App\Models\Category;

class CategoryService {

    public function getTopParent(?Category $category): Category {
        return $category->parent_category_id ? $this->getTopParent($category->parentCategory) : $category;
    }
}
