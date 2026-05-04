<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth()->toDateString());

        // 1. Laporan Peminjaman (Detail)
        $loans = Loan::with(['user', 'book'])
            ->whereBetween('loan_date', [$startDate, $endDate])
            ->orderBy('loan_date', 'desc')
            ->get();

        // 2. Buku Terpopuler in this period
        // Selecting only necessary columns to avoid GROUP BY issues with books.*
        $popularBooks = Book::select('books.id', 'books.title', 'books.author', DB::raw('COUNT(loans.id) as period_borrow_count'))
            ->join('loans', 'books.id', '=', 'loans.book_id')
            ->whereBetween('loans.loan_date', [$startDate, $endDate])
            ->groupBy('books.id', 'books.title', 'books.author')
            ->orderBy('period_borrow_count', 'desc')
            ->take(10)
            ->get();

        // 3. Siswa Teraktif in this period
        $activeUsers = User::where('role', 'siswa')
            ->select('users.id', 'users.name', DB::raw('COUNT(loans.id) as period_loans_count'))
            ->join('loans', 'users.id', '=', 'loans.user_id')
            ->whereBetween('loans.loan_date', [$startDate, $endDate])
            ->groupBy('users.id', 'users.name')
            ->orderBy('period_loans_count', 'desc')
            ->take(10)
            ->get();

        return view('reports.index', compact('loans', 'popularBooks', 'activeUsers', 'startDate', 'endDate'));
    }

    public function export(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $loans = Loan::with(['user', 'book'])
            ->whereBetween('loan_date', [$startDate, $endDate])
            ->get();

        $fileName = 'Laporan_Peminjaman_' . $startDate . '_to_' . $endDate . '.csv';
        
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['Tanggal Pinjal', 'Nama Siswa', 'Judul Buku', 'Status', 'Tgl Kembali Seharusnya', 'Tgl Kembali Aktual'];

        $callback = function() use($loans, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($loans as $loan) {
                fputcsv($file, [
                    $loan->loan_date,
                    $loan->user->name,
                    $loan->book->title,
                    $loan->status,
                    $loan->expected_return_date,
                    $loan->actual_return_date ?? '-',
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
