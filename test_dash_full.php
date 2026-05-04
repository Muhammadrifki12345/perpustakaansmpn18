<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$user = \App\Models\User::first(); // testing auto login as admin
\Illuminate\Support\Facades\Auth::login($user);

$response = $kernel->handle(
    Illuminate\Http\Request::create('/dashboard', 'GET')
);

echo $response->getContent();
