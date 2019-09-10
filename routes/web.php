<?php

Route::get('/', function () {
    $class_name = 'zombie';
    $dynamic = "App\Service\\" . ucfirst($class_name) . 'Service';
    return view('welcome', [
        'token' => (new $dynamic)->getToken(),
    ]);
});
