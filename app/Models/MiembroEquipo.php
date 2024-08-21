<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MiembroEquipo extends Model
{
    use HasFactory;

    public function miembros()
    {
        return $this->belongsTo(Equipo::class,'equipo_id');
    }
    public function getRouteKeyName() //Specifies the search field by url
    {
        return 'user_miembro'; //Search by team name in url Ex: equipo->name
    }
}
