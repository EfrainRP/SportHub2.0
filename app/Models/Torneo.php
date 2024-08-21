<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Torneo extends Model
{
    use HasFactory;
  
    public function organizador()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function estadistica()
    {
        return $this->belongsToMany(Equipo::class,'estadisticas')->withPivot('PT','CA','DC','CC');
    }
    public function estadisticaIndividual()
    {
        return $this->belongsToMany(User::class,'participante_torneos')->withPivot('PT','CA','DC','CC');
    }
    public function tienenPartidos()
    {
        return $this->belongsToMany(Partido::class,'partido_torneos');
    }
    public function getRouteKeyName() //Specifies the search field by url
    {
        return 'name'; //Search by team name in url Ex: torneo->name
    }

}
