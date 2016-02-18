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

    public function getSignUp()
    {
        $vw = view('home.sign-up');
        $vw->title = "McRiver Raid 2015";
        $vw->description = "";
        $vw->active_page = "sign-up";
        return $vw;
    }

    public function getSignUpStep2()
    {
        $vw = view('home.sign-up2');
        $vw->title = "McRiver Raid 2015";
        $vw->description = "";
        $vw->active_page = "sign-up";
        return $vw;
    }

    public function getNotPermitted()
    {
        $vw = view('home.not-permitted');
        $vw->title = "McRiver Raid 2015";
        $vw->description = "";
        $vw->active_page = "home";
        return $vw;
    }
}
