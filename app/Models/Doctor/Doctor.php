<?php

namespace App\Models\Doctor;

use App\Models\User; // ← Esta línea arregla el error
use App\Models\Doctor\Horario; // ← Esta línea arregla el error
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = ['nombres', 'apellido', 'telefono', 'matricula','especialidad', 'user_id'];

    public function consultorio()
    {
        return $this->belongsTo(Consultorio::class);
    }

    public function horarios()
    {
        return $this->hasMany(Horario::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    //Un evento tiene varios doctor.
    public function evento(){
        return $this->hasMany(Evento::class);
    }
}
