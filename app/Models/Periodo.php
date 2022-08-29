<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    use HasFactory;
    protected $fillable = [
        'codigo',
        'descripcion',
        'fecha_entrega_plan',
        'primer_parcial_desde',
        'primer_parcial_hasta',
        'segundo_parcial_desde',
        'segundo_parcial_hasta',
        'examen_final_desde',
        'examen_final_hasta',
        'fecha_inicio',
        'fecha_fin'
    ];
    //Relacion 1 a muchos 
    public function docente_materia(){
        return $this->hasMany(Docente_materia::class);
    }
}
