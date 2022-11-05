<?php

namespace App\View\Components;

use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CategoryFormModal extends Component {

    public $categoryId = null;
    public $categoryName;
    public $parentCategory;
    public $allCategories;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($categoryName, $parentCategory, $categoryId = null) {
        $this->categoryName = $categoryName;
        $this->categoryId = $categoryId;
        $this->parentCategory = $parentCategory;
        $this->allCategories = Category::orderBy('category_name')->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Application|Factory|View
     */
    public function render() {
        return view('components.category-form-modal');
    }
}
