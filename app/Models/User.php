<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'role',
        'password', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays/JSON.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
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

    /**
     * 👨‍👧 Parent - has many children
     */
    public function children()
    {
        return $this->hasMany(Child::class);
    }

    /**
     * 👪 Parent - has many bookings (as parent)
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'parent_id');
    }

    /**
     * 🏥 Hospital - receives many bookings
     */
    public function bookingsReceived()
    {
        return $this->hasMany(Booking::class, 'hospital_id');
    }

    /**
     * 📊 Reports by parent (optional, if report model exists)
     */
    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
