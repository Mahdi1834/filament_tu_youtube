<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // User::create(
    //     [
    //         "name" => "name",
    //         "email" => "kj,u,u,j",
    //         "password" => "123456",
    //     ]
    // );
    return view('welcome');
});
