<?php

namespace App\Http\Controllers;

class MarketingController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->view('home');
    }
}
