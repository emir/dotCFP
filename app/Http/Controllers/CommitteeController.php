<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Response;

class CommitteeController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index(): Response
    {
        $users = User::committee()->get();

        return response()->view('committee.index', compact('users'));
    }
}
