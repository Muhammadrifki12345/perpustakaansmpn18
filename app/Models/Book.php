<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'publisher',
        'year',
        'stock',
        'category_id',
        'shelf_id',
        'barcode',
        'borrow_count',
        'file_path',
        'cover_image',
        'synopsis',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function shelf()
    {
        return $this->belongsTo(Shelf::class);
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function waitlists()
    {
        return $this->hasMany(\App\Models\Waitlist::class);
    }
}
