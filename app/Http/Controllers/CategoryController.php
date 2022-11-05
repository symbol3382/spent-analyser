<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryDeleteRequest;
use App\Http\Requests\CategoryModifyRequest;
use App\Models\Category;
use Auth;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller {

    public function categoryList() {
        $categories = Category::orderBy('category_name')->get();

        return view('category.category-list.category-list-chart')->with([
            'headerNavTab' => 'category', // to show the category selected in header nav tab
            'categories'   => $categories,
        ]);
    }

    public function categoryCreate(CategoryModifyRequest $request): RedirectResponse {
        if ($request->has('category_id')) {
            $category = Category::find($request->input('category_id'));
            $category->category_name = $request->input('category_name');
            $category->parent_category_id = $request->input('parent_category_id');
            $category->update();
        } else {
            Category::updateOrCreate([
                'category_name' => $request->input('category_name'),
            ], [
                'parent_category_id' => $request->input('parent_category_id'),
                'created_by'         => Auth::id(),
            ]);
        }
        return redirect()->back();
    }

    public function categoryDelete(CategoryDeleteRequest $request): RedirectResponse {
        Category::find($request->input('category_id'))->delete();
        return redirect()->back();
    }
}
