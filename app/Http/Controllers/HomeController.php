<?php

namespace App\Http\Controllers;

use App\Conference;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function index(Request $request): \Illuminate\Http\Response
    {
        $conference = Conference::findBySlugOrFail($request->route('subdomain'));

        return response()->view('conferences.home', compact('conference'));
    }
}
