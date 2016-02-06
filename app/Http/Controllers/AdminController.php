<?php

namespace mcriver\Http\Controllers;

use mcriver\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

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
        $view = view('admin.products-index');
        return $view;
    }
}
