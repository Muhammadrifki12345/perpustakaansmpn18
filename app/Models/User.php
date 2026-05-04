<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'qr_code',
        'kelas',
        'is_approved',
    ];

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'user_id', 'followed_id')->withTimestamps();
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'user_id')->withTimestamps();
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
    
    public function waitlists()
    {
        return $this->hasMany(Waitlist::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // --- Helper Methods ---
    
    public function hasFavorited($book)
    {
        return $this->favorites()->where('book_id', $book->id)->exists();
    }

    public function hasLiked($activity)
    {
        return $this->likes()->where('activity_id', $activity->id)->exists();
    }

    public function isSuperAdmin()
    {
        return $this->role === 'superadmin';
    }

    public function isAdmin()
    {
        return in_array($this->role, ['superadmin', 'admin']);
    }

    public function isSiswa()
    {
        return $this->role === 'siswa';
    }

    public function getRoleNameAttribute()
    {
        return match($this->role) {
            'superadmin' => 'Super Admin',
            'admin' => 'Pengurus Perpustakaan',
            'siswa' => 'Siswa',
            default => 'Pengguna',
        };
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
