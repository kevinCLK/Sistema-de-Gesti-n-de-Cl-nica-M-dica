<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class doctores extends Model
{
    use HasFactory;
    protected $fillable=['nombres','apellidos','telefono','licencia_medica','especilidad','user_id'];


    public function Consultorio(){
        return $this->belongsTo(Consultorio::class);
    }
    public function horarios(){
        return $this->hasMany(horarios::class);
    }
    public function User(){
        return $this->belongsTo(User::class);
    }

    public function eventos() {
        return $this->hasMany(related: eventos::class);
    }
}
