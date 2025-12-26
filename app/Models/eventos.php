<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class eventos extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo(related: User::class);
    }
    
    public function doctor() {
        return $this->belongsTo(related: doctores::class);
    }
    
    public function consultorio() {
        return $this->belongsTo(related: Consultorio::class);
    }
    public function eventos() {
        return $this->hasMany(related: eventos::class);
    }
    
}
