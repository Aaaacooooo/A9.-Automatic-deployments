<?php

namespace App\Models;

use App\Models\Channel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class CommunityLink extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'user_id',
        'channel_id',
        'link',
        'approved'
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class, 'channel_id');
    }

    //Si un usuario es confiable y el enlace está repetido se actualiza el timestamp y aparecerá en la primera posición del listado.
    public static function hasAlreadyBeenSubmitted($link) //Funcion protegida y estática
    {
        if ($existing = static::where('link', $link)->first()) {
            /* Consulta que busca el link que es igual al valor pasado en la función
        y si se encuentra una fila, se asigna a la variable $existing*/
            if (Auth::user()->isTrusted()) {
                // si el usuario es de confianza se ejecutará
                $existing->touch();
                //actualiza el timestamp updated_at del modelo
                $existing->save();
                //se guarda en la base de datos para persistir los cambios
            }
            return true; //devuleve true
        }
        return false; //devuleve false
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'community_link_users');
    }
}
