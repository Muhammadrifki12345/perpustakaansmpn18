<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Loan;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class SendDueReminders extends Command
{
    protected $signature = 'app:send-due-reminders';
    protected $description = 'Kirim peringatan buku jatuh tempo via WhatsApp';

    public function handle()
    {
        // Cari buku yang harus kembali besok atau sudah telat
        $loans = Loan::with('user', 'book')
            ->where('status', 'borrowed')
            ->whereDate('expected_return_date', '<=', Carbon::now()->addDays(1))
            ->get();

        if ($loans->isEmpty()) {
            $this->info("Tidak ada buku jatuh tempo yang perlu diingatkan.");
            return;
        }

        foreach ($loans as $loan) {
            $phone = $loan->user->phone;
            if (!$phone) continue;

            if (str_starts_with($phone, '08')) {
                $phone = '628' . substr($phone, 2);
            }

            $message = "Halo {$loan->user->name}, peringatan dari Perpustakaan: Buku '{$loan->book->title}' dikembalikan maksimal tanggal {$loan->expected_return_date}. Harap segera dikembalikan ya, tanpa denda cuma jangan diulangi!";
            
            // Simulasikan pengiriman WA ke Log
            Log::info("Mengirim WA ke {$phone}: {$message}");

            // Integrasi Fonnte (Minta token ke fonnte.com dan isi di .env)
            $token = env('FONNTE_TOKEN', '');
            if (!empty($token)) {
                Http::withHeaders([
                    'Authorization' => $token
                ])->post('https://api.fonnte.com/send', [
                    'target' => $phone,
                    'message' => $message,
                ]);
            }

            // Set is_late = true jika hari ini sudah melewati expected_return_date
            if (Carbon::now()->startOfDay()->greaterThan(Carbon::parse($loan->expected_return_date)->startOfDay())) {
                $loan->update(['is_late' => true]);
            }
        }

        $this->info("Peringatan WhatsApp telah dieksekusi (Lihat storage/logs/laravel.log).");
    }
}
