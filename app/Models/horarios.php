<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class horarios extends Model
{
    use HasFactory;
    protected $fillable=['dia','hora_inicio','hora_fin','doctor_id','consultorio_id'];
    public function doctor(){
        return $this->belongsTo(doctores::class);
    }
    public function consultorio(){
        return $this->belongsTo(Consultorio::class);
    }
}
