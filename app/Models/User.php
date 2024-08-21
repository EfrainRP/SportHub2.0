<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Notification;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'fsurname',
        'msurname',
        'nickname',
        'gender',
        'email',
        'birthdate',
        'password', 
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function equipos(){
        return $this->hasMany(Equipo::class,'id');
    }
    public function torneos(){
        return $this->hasMany(Torneo::class,'id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'user_id');
    }
    public function estadisticaIndividual()
    {
        return $this->belongsToMany(Torneos::class,'participante_torneos')->withPivot('PT','CA','DC','CC');;
    }

}
