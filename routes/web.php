<?php

use Laraboost\Model;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $user = Model::get('Car');
    // dd($user);
    return $user;
});