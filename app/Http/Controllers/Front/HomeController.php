<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use App;

class HomeController extends Controller
{
    public function index() {
        return view('front/home');
    }

    public function changLang(Request $request) {
        App::setLocale($request->lang);
        session()->put('locale', $request->lang);

        return redirect()->back();
    }

    public function policy() {
        return view('front/policy');
    }
}
