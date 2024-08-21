<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partido extends Model
{
    use HasFactory;

    public function local()
    {
        return $this->belongsTo(Equipo::class,'equipoLocal_id');
    }
    public function visitante()
    {
        return $this->belongsTo(Equipo::class,'equipoVisitante_id');
    }
    public function estadistica()
    {
        return $this->belongsToMany(Estadistica::class,'partido_id');
    }
    public function estanTorneos()
    {
        return $this->belongsToMany(Torneo::class,'partido_torneos');
    }
}
