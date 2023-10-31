<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommunityLinkForm;
use App\Models\Channel;
use App\Models\CommunityLink;
use App\Queries\CommunityLinksQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class CommunityLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Channel $channel = null)
    {
        $query = trim(request()->get('search'));

        if (request()->exists('popular')) {
            $links = CommunityLinksQuery::getMostPopular();
        } elseif ($channel) {
            $links = CommunityLinksQuery::getByChannel($channel);
        } elseif (request()->exists('search')) {
            $links = CommunityLinksQuery::busqueda(request()->get('search'));
        } else {
            $links = CommunityLinksQuery::getAll();
        }





        // Obtener todos los canales para mostrar en la vista
        $channels = Channel::orderBy('title', 'asc')->get();



        return view('community.index', compact('links', 'channels', 'channel'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommunityLinkForm $request)
    {

        $link = new CommunityLink(); //Ceamos el objeto link
        $link->user_id = Auth::id(); //Lo instanciamos

        $data = $request->validated();

        $data['user_id'] = Auth::id();
        $approved = Auth::user()->isTrusted();
        $data['approved'] = $approved;


        // Verificar si el enlace ya ha sido enviado & user trusted
        if ($link->hasAlreadyBeenSubmitted($data['link'])) {
            if ($approved) {
                return back()->with('timestamp', 'El enlace ya ha sido actualizado y guardado en la base de datos.');
            }
            if (!$approved) {
                return back()->with('willTrusted', 'Hemos tenido en cuenta tu enlace pero necesitamos que inicies sesión para mostrarlo.');
            }
        } else {
            // Si el enlace es nuevo, seguir con el flujo actual.
            CommunityLink::create($data);
            if ($approved) {
                return back()->with('success', '¡Enlace creado correctamente!');
            } else {
                return back()->with('error', 'El usuario no está aprobado.');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CommunityLink $communityLink)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CommunityLink $communityLink)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CommunityLink $communityLink)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CommunityLink $communityLink)
    {
        //
    }
}
