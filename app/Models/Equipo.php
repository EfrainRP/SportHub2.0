<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equipo extends Model
{
    use HasFactory;

    public function getRouteKeyName() //Specifies the search field by url
    {
        return 'name'; //Search by team name in url Ex: equipo->name
    }
    public function miembros()
    {
        return $this->hasMany(MiembroEquipo::class,'id');
    }
    public function partidoLocal(){
        return $this->hasMany(Partido::class,'id');
    }
    public function partidoVisitante(){
        return $this->hasMany(Partido::class,'id');
    }
    public function estadistica()
    {
        return $this->belongsToMany(Torneo::class,'estadisticas')->withPivot('PT','CA','DC','CC');;
    }
    public function representante()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
