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

    public function getSignUp($step = null)
    {
        if (!$step) {
            return $this->signupStep1();
        } elseif ($step == 2) {
            return $this->signupStep2();
        } elseif ($step == 3) {
            return $this->signupStep3();
        } elseif ($step == 4) {
            return $this->signupStep4();
        } else {
            return redirect('/sign-up');
        }
    }

    protected function signupStep1($step = null)
    {
        $vw = view('home.sign-up');
        $vw->title = "McRiver Raid 2015";
        $vw->description = "";
        $vw->active_page = "sign-up";
        return $vw;
    }

    protected function signupStep2()
    {
        if (\Auth::check()) {
            return redirect('/sign-up/3');
        }
        $vw = view('home.sign-up2');
        $vw->title = "McRiver Raid 2015";
        $vw->description = "";
        $vw->active_page = "sign-up";
        return $vw;
    }

    protected function signupStep3()
    {
        /*if (\Auth::check()) {
            return redirect('/sign-up/3');
        }*/
        $vw = view('home.sign-up3');
        $vw->title = "McRiver Raid 2015";
        $vw->description = "";
        $vw->active_page = "sign-up";
        return $vw;
    }

    protected function signupStep4()
    {
        /*if (\Auth::check()) {
            return redirect('/sign-up/3');
        }*/
        $vw = view('home.sign-up4');
        $vw->title = "McRiver Raid 2015";
        $vw->description = "";
        $vw->active_page = "sign-up";
        return $vw;
    }

    public function postSignin(Request $request)
    {
        $credentials = [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ];

        if(\Auth::attempt($credentials)) {
            //$user = \Auth::user();
            //$user->password = bcrypt($request->get('password'));
            //$user->save();
            return redirect()->back();
        } else {
            return redirect()->back()->withErrors('Incorrect old password.')->with('message', 'Password changed successfully.');
        }
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
