<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function home()
    {
        $siteName = 'Student Management System';
        return view('pages.home', ['siteName' => $siteName]);
    }

    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        return view('pages.contact');
    }
}