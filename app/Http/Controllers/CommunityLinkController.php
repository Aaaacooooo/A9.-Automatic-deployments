<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\CommunityLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommunityLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $channels = Channel::orderBy('title', 'asc')->get();
        $links = CommunityLink::where('approved', 1)->paginate(25);
        return view('community/index', compact('links', 'channels'));
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
    public function store(Request $request)

    {

        $data = $request->validate([

            'title' => 'required|max:255',

            'channel_id' => 'required|exists:channels,id',

            'link' => 'required|unique:community_links|url|max:255',


        ]);

        $data['user_id'] = Auth::id();

        $approved = Auth::user()->isTrusted();

        $data['approved'] = $approved;

        CommunityLink::create($data);

        if ($approved) {
            return back()->with('success', 'link created successfully!');
        } else {
            return back()->with('error', 'The user is not approved');
        }
        // if($mensaje = Session::get('error')){
        //     return back()->with('error', 'You have no permission for this page!');
        // };


        
        
        
        //return back()->with('success', 'link created successfully!');;
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
