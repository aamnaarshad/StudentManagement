<?php

namespace App\Models;

// Note: I don't have your original User.php (it wasn't uploaded), so this
// starts from Laravel's default scaffold with 'role' and isAdmin() added.
// If your actual file already has custom fields/casts, just add the
// 'role' entries below into your existing version instead of overwriting it.

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}
