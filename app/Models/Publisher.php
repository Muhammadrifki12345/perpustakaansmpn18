<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    protected $table = 'publishers';
    protected $fillable = ['name', 'address', 'phone', 'email'];

    public function books()
    {
        // Many projects use string for publisher in Book, 
        // but if it were a relationship, it would be:
        // return $this->hasMany(Book::class);
        // However, looking at Book model, it uses a string field.
        // I will keep the model simple for now to fix the controller crash.
    }
}
