<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryDeleteRequest;
use App\Http\Requests\CategoryModifyRequest;
use App\Models\Category;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class CategoryController extends Controller {

    public function categoryList(Request $request) {
        $categories = Category::whereParentCategoryId($request->input('parent'))
            ->orderBy('category_name')->get();
        $parentTrack = new Collection();
        if ($request->input('parent') && $parentCategory = Category::find($request->input('parent'))) {
            while ($parentCategory) {
                if ($parentTrack->where('id', $parentCategory->id)->count()) {
                    // the parent is already present in parent track means there is loop of category
                    break;
                }
                $parentTrack->push($parentCategory);
                $parentCategory = $parentCategory->parentCategory;
            }
            $parentTrack = $parentTrack->reverse();

        }
        return view('category.category-list.category-list-chart')->with([
            'headerNavTab'     => 'category', // to show the category selected in header nav tab
            'categories'       => $categories,
            'parentCategories' => $parentTrack,
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
