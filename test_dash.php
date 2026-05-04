<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::create('/dashboard', 'GET')
);

// We need to simulate login to test dashboard
// So instead, let's just test the user we know exists...
$user = \App\Models\User::where('role', 'siswa')->first();
\Illuminate\Support\Facades\Auth::login($user);

// Now try testing the method directly
try {
    $controller = app()->make(\App\Http\Controllers\DashboardController::class);
    $view = $controller->index();
    echo $view->render();
} catch (\Throwable $e) {
    echo "ERROR: " . $e->getMessage() . " on line " . $e->getLine() . " of " . $e->getFile() . "\n";
}
