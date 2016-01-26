<?php

namespace mcriver\Http\Controllers;

use Illuminate\Http\Request;

use mcriver\Http\Requests;
use mcriver\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function getIndex()
	{
        $vw = view('home.index');
        $vw->title = "McRiver Raid 2015";
        $vw->description = "";
        $vw->active_page = "home";
        return $vw;
	}
}
