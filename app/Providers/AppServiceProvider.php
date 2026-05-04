<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Loan;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // --- DEFINISI HAK AKSES (GATES) ---
        
        // Akses Katalog (Hanya Siswa & Pengurus - Super Admin DILARANG)
        \Illuminate\Support\Facades\Gate::define('access-catalog', function ($user) {
            return in_array($user->role, ['siswa', 'admin']);
        });

        // Akses Operasional (Hanya Pengurus/Admin - Super Admin DILARANG)
        \Illuminate\Support\Facades\Gate::define('admin-access', function ($user) {
            return $user->role === 'admin';
        });

        // Akses Daftar Tunggu (Admin & Super Admin)
        \Illuminate\Support\Facades\Gate::define('access-waitlist', function ($user) {
            return in_array($user->role, ['admin', 'superadmin']);
        });

        // Akses Laporan & Pengguna (Hanya Super Admin)
        \Illuminate\Support\Facades\Gate::define('superadmin-only', function ($user) {
            return $user->role === 'superadmin';
        });

        // Just-In-Time check for overdue loans (Fallback for environments without Cron)
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('loans')) {
                $overdueLoans = Loan::where('status', 'borrowed')
                    ->where('expected_return_date', '<', now()->toDateString())
                    ->get();
                    
                foreach ($overdueLoans as $loan) {
                    $loan->markAsReturned(true);
                }
            }
        } catch (\Exception $e) {
            // Ignore during migrations
        }
    }
}
