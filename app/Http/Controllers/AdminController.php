<?php

namespace mcriver\Http\Controllers;

use mcriver\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use mcriver\Category;

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
        $view->categories = Category::all();
        return $view;
    }

    protected function products($category_id)
    {
        $view = view('admin.products');
        return $view;
    }

    public function postPostProducts(Request $request, $category_id = null)
    {
        if(!$category_id)
            $category = new Category;
        else
            $category = Category::find($category_id);

        $category->name = $request->input('categoryName');
        $category->slug = $this->toAscii($category->name);
        $category->description = $request->input('categoryDescription');
        $category->save();

        return redirect('/admin/products');
    }

}
