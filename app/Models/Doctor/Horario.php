<?php

namespace App\Models\Doctor;

use App\Models\Doctor\Doctor; // ← Esta línea arregla el error
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $fillable = ['dia', 'hora_inicio', 'hora_fin', 'doctor_id', 'consultorio_id'];

    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }

    public function consultorio(){
        return $this->belongsTo(Consultorio::class);
    }
}
