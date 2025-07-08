<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = ['user_id', 'child_id', 'vaccine', 'hospital_id', 'date', 'notes'];

    public function parent()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function child()
    {
        return $this->belongsTo(Child::class);
    }

    public function vaccine()
    {
        return $this->belongsTo(Vaccine::class);
    }

    public function hospital()
    {
        return $this->belongsTo(User::class, 'hospital_id');
    }
}
