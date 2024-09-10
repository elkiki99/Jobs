<?php

namespace App\Http\Controllers;

class LegalPagesController extends Controller
{
    public function cookies()
    {
        return view('legal.cookies');
    }

    public function help()
    {
        return view('legal.help');
    }

    public function privacy()
    {
        return view('legal.privacy');
    }

    public function support()
    {
        return view('legal.support');
    }
    
    public function terms()
    {
        return view('legal.terms');
    }
}
