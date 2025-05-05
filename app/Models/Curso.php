<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'descripcion', 'horas_requeridas', 'estado'];


    public function profesores() {
        return $this->belongsToMany(Profesor::class, 'curso_profesor');
    }
    public function horarios() {
        return $this->belongsToMany(Horario::class, 'curso_horario');
    }
    public function events()
    {
        return $this->hasMany(Event::class);
    }
    public function clientes()
    {
        return $this->belongsToMany(Cliente::class, 'cliente_curso')
                    ->withPivot('horas_realizadas');
    }
    public function historialCursos()
    {
        return $this->hasMany(HistorialCurso::class);
    }
    // public function profesores(){ first I used this one
    //     return $this->hasMany(Profesor::class);
    // }
    // En el modelo Profesor
    // public function profesores()
    // {
    //     return $this->belongsToMany(Profesor::class, 'curso_profesor', 'curso_id', 'profesor_id');
    // }

    // public function profesores()
    // {
    //     return $this->belongsToMany(Profesor::class, 'curso_profesor');
    // }
    // public function clientes()
    // {
    //     // return $this->belongsToMany(Cliente::class, 'cliente_curso');
    //     return $this->belongsToMany(Cliente::class, 'cliente_curso')
    //         ->withPivot('horas_realizadas', 'fecha_realizacion')
    //         ->withTimestamps();
    // }
}
