<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\Loan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::call(function () {
    $overdueLoans = Loan::where('status', 'borrowed')
        ->where('expected_return_date', '<', now()->toDateString())
        ->get();
        
    foreach ($overdueLoans as $loan) {
        $loan->markAsReturned(true); // true indicates it's an automatic return
    }
})->dailyAt('00:01');
