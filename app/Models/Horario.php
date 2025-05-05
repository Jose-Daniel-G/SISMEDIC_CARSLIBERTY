<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $fillable = ['dia', 'hora_inicio', 'hora_fin', 'profesor_id', 'curso_id'];

    // Un horario pertenece a un profesor
    public function profesor()
    {
        return $this->belongsTo(Profesor::class);
    }

    // Si un horario solo pertenece a un curso, usa belongsTo
    // public function curso()
    // {
    //     return $this->belongsTo(Curso::class);
    // }

    // Si un horario puede estar asociado a varios cursos (revisar si esto es necesario)
    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'curso_horario');
    }

    // Relación con Cliente a través de la tabla intermedia 'cliente_curso'
    public function clientes()
    {
        return $this->belongsToMany(Cliente::class, 'cliente_curso');
    }
    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
