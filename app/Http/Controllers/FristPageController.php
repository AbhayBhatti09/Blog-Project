<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FristPageController extends Controller
{
    public function home(){
        return view('home.home');
    }

    public function about_us(){
        return view('home.aboutus');
    }

    public function contact_us(){
        return view('home.contactus');
    }
}
