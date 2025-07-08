<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'child_id',
        'hospital_id',
        'vaccine',
        'date',
        'status',
    ];

    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }
    public function hospital()
    {
        return $this->belongsTo(User::class, 'hospital_id');
    }
    public function child()
    {
        return $this->belongsTo(Child::class);
    }
}
