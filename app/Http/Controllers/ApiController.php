<?php

namespace mcriver\Http\Controllers;

use Illuminate\Http\Request;

use mcriver\Http\Requests;
use mcriver\Http\Controllers\Controller;
use mcriver\Category;

class ApiController extends Controller
{
    public function getProducts($category_id = null)
    {
        if (!$category_id) {
            return Category::orderBy('display_order')->get();
        } else {
            return Category::find($category_id);
        }
    }
}
