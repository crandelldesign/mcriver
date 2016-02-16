<?php

namespace mcriver\Http\Controllers;

use mcriver\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use mcriver\Category;
use mcriver\Item;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        
        /*if(!\Auth::check() || (\Auth::check() && \Auth::user()->is_admin == 0))
            return redirect()->action('AdminController@getNotAdmin');
            exit;*/
            //return redirect('/');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $view = view('admin.index');
        return $view;
    }

    public function getProducts($category_id = null)
    {
        if (!$category_id) {
            return $this->productsIndex();
        } else {
            return $this->products($category_id);
        }
    }

    protected function productsIndex()
    {
        $view = view('admin.products-index');
        $view->categories = Category::orderBy('display_order')->get();
        return $view;
    }

    protected function products($category_id)
    {
        $view = view('admin.products');
        $view->category = Category::find($category_id);
        return $view;
    }

    public function postPostCategories(Request $request, $category_id = null)
    {
        if (!$category_id)
            $category = new Category;
        else
            $category = Category::find($category_id);

        $category->name = $request->input('categoryName');
        $category->slug = $this->toAscii($category->name);
        $category->description = $request->input('categoryDescription');
        $category->is_no_sizes = $request->input('isHasSizes');
        if (!$category_id) {
            $categoryCount = Category::count();
            $category->display_order = $categoryCount;
        }
        $category->save();

        return redirect('/admin/products');
    }

    public function postPostCategoriesOrder(Request $request)
    {
        $displayOrder = 0;
        foreach ($request->input('categoryOrder') as $categoryOrder) {
            $category = Category::find($categoryOrder['id']);
            $category->display_order = $displayOrder;
            $category->save();
            $displayOrder++;
        }
        return 'success';
    }

    public function getDeleteCategory(Request $request, $category_id)
    {
        $items = Item::where('category_id',$category_id)->update(['category_id' => 0]);

        $category = Category::find($category_id);
        $category->delete();
        return redirect('/admin/products');
    }
}
