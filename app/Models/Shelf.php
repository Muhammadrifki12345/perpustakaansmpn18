<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shelf extends Model
{
    protected $fillable = ['name', 'location_code', 'description'];

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
