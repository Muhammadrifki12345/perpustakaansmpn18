<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = [
        'user_id',
        'book_id',
        'invoice_number',
        'loan_date',
        'expected_return_date',
        'actual_return_date',
        'booking_date',
        'status',
        'is_late',
        'notes',
    ];

    protected $casts = [
        'loan_date' => 'datetime',
        'expected_return_date' => 'datetime',
        'actual_return_date' => 'datetime',
        'booking_date' => 'datetime',
        'is_late' => 'boolean',
    ];

    /**
     * Generate a unique invoice number.
     * Format: INV-YYYYMMDD-XXX (e.g. INV-20260428-001)
     */
    public static function generateInvoiceNumber(): string
    {
        $datePrefix = 'INV-' . now()->format('Ymd') . '-';
        $lastInvoice = static::where('invoice_number', 'like', $datePrefix . '%')
            ->orderBy('invoice_number', 'desc')
            ->first();

        if ($lastInvoice) {
            $lastNumber = (int) substr($lastInvoice->invoice_number, -3);
            $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '001';
        }

        return $datePrefix . $newNumber;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * Mark the loan as returned and handle book stock/waitlist logic.
     */
    public function markAsReturned($isAutomatic = false)
    {
        if ($this->status === 'returned') {
            return false;
        }

        $isLate = false;
        if ($this->expected_return_date && now() > $this->expected_return_date) {
            $isLate = true;
        }

        $this->update([
            'status' => 'returned',
            'actual_return_date' => now()->toDateString(),
            'is_late' => $this->is_late || $isLate, // Retain true if it was already marked as late
        ]);

        $book = $this->book;
        if ($book) {
            // Check for waitlist
            $nextInLine = Waitlist::where('book_id', $book->id)
                ->where('status', 'waiting')
                ->orderBy('created_at', 'asc')
                ->first();

            if ($nextInLine) {
                // Directly book for the next person
                $nextInLine->update(['status' => 'assigned']);
                
                Loan::create([
                    'user_id' => $nextInLine->user_id,
                    'book_id' => $book->id,
                    'loan_date' => now()->toDateString(),
                    'expected_return_date' => now()->addDays((int) Setting::getValue('loan_duration', 7))->toDateString(),
                    'status' => 'borrowed'
                ]);
            } else {
                // Increment stock if no one is waiting
                $book->increment('stock');
            }
        }

        // Log activity
        Activity::create([
            'user_id' => $this->user_id,
            'type' => 'returned',
            'details' => [
                'book_id' => $this->book_id,
                'title' => $book?->title ?? 'Buku',
                'method' => $isAutomatic ? 'automatic' : 'manual'
            ]
        ]);

        return true;
    }
}
