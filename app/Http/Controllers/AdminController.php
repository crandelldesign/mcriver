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
        $view->active_page = 'home';
        return $view;
    }

    public function getChangePassword()
    {
        $view = view('admin.change-password');
        $view->active_page = 'change-password';
        return $view;
    }

    public function postChangePassword(Request $request)
    {
        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $credentials = [
            'email' => \Auth::user()->email,
            'password' => $request->get('current_password'),
        ];

        if(\Auth::validate($credentials)) {
            $user = \Auth::user();
            $user->password = bcrypt($request->get('password'));
            $user->save();
            return redirect('/admin')->with('message', 'Password changed successfully.');
        } else {
            return redirect()->back()->withErrors('Incorrect old password.');
        }
    }

    public function getSignUps()
    {
        $view = view('admin.index');
        $view->active_page = 'sign-ups';
        return $view;
    }

    public function getEquipment()
    {
        $view = view('admin.index');
        $view->active_page = 'equipment';
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
        $view->active_page = 'products';
        return $view;
    }

    protected function products($category_id)
    {
        $view = view('admin.products');
        $category = Category::find($category_id);
        $items = $category->items()->where('parent_id',0)->orderBy('display_order')->get();
        foreach ($items as $item) {
            $item->children = $item->children()->orderBy('display_order')->get();
        }
        $view->category = $category;
        $view->items = $items;
        $view->active_page = 'products';
        return $view;
    }

    /* Editing Functions */
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

    public function postPostItem(Request $request, $item_id = null)
    {
        if (!$item_id)
            $item = new Item;
        else
            $item = Item::find($item_id);

        $item->name = $request->input('productName');
        $item->short_name = $request->input('productShortName');
        $item->slug = $this->toAscii($item->name);
        $item->price = $request->input('productPrice');
        $item->is_one_size = $request->input('isOneSize');
        $item->category_id = $request->input('categoryId');
        if (!$item_id) {
            $itemCount = Item::where('category_id',$request->input('categoryId'))->where('parent_id',0)->count();
            $item->display_order = $itemCount;
        }
        $item->save();

        return redirect('/admin/products/'.$request->input('categoryId'));
    }

    public function postPostItemsOrder(Request $request)
    {
        $displayOrder = 0;
        //print_r($request->input('itemOrder'));
        //exit;
        foreach ($request->input('itemOrder') as $itemOrder) {
            $item = Item::find($itemOrder['id']);
            $item->display_order = $displayOrder;
            $item->save();
            $displayOrder++;
            $childrenDisplayOrder = 0;
            if(isset($itemOrder['children'])) {
                foreach ($itemOrder['children'] as $childrenOrder) {
                    print_r($childrenOrder);
                    $item = Item::find($childrenOrder['id']);
                    $item->display_order = $childrenDisplayOrder;
                    $item->parent_id = $itemOrder['id'];
                    $item->save();
                    $childrenDisplayOrder++;
                }
            }
        }
        return 'success';
    }

    public function getDeleteItem(Request $request, $category_id, $item_id)
    {
        $items = Item::where('parent_id',$item_id)->update(['parent_id' => 0]);

        $item = Item::find($item_id);
        $item->delete();
        return redirect('/admin/products/'.$category_id);
    }
}
