<?php

use App\Http\Resources\Talk;
use App\Http\Resources\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/v1/speakers', function () {
    $speakers = \App\User::with('talks')->whereHas('talks', function ($query) {
        $query->where('status', 1);
    })->orderBy('name', 'ASC')->get();

    return response()->json(User::collection($speakers));
});

Route::get('/v1/talks', function () {
    $talks = \App\Talk::with('user')->whereStatus(1)->get();

    return response()->json(Talk::collection($talks));
});
