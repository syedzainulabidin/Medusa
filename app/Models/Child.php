<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    public function reports()
    {
        return $this->hasMany(Report::class);
    }
    public function parent()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected $fillable = ['user_id', 'name', 'dob', 'gender'];
}
