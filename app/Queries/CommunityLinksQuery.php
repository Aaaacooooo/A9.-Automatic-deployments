<?php

namespace App\Queries;

use App\Models\Channel;
use App\Models\CommunityLink;


class CommunityLinksQuery
{
    public static function getByChannel(Channel $channel)
    {
        $query = CommunityLink::where('approved', true);

        // Si se proporciona un canal, filtrar por ese canal
        if ($channel) {
            $query->where('channel_id', $channel->id);
        }

        // Convertir la instancia de colección en Query Builder y obtener los enlaces paginados
        return $query->latest('updated_at')->paginate(25);
    }

    public static function getAll()
    {
        // Obtener todos los enlaces de la comunidad aprobados y paginados
        return CommunityLink::where('approved', true)->latest('updated_at')->paginate(25);
    }

    public static function getMostPopular()
    {
        $query = CommunityLink::where('approved', true);

        // Verificar si se desea ordenar por popularidad
        if (request()->exists('popular')) {
            $query->withCount('users')->orderByDesc('users_count');
        } else {
            // Ordenar por la lógica original si no se solicita popular
            $query->latest('updated_at');
        }
        return $query->paginate(25);
    }
}