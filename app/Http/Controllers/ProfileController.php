<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
Auth

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $data = $request->validate([
        'imageUpload' => 'required|file|image|max:200', // Validaciones para el campo de la imagen del perfil (máximo 200KB, formatos permitidos: jpeg, png, jpg, gif)
    ]);

    if ($request->hasFile('imageUpload')) {
        $image = $request->file('imageUpload');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->storeAs('profile_images', $imageName, 'public'); // Almacena la imagen en el directorio 'public/profile_images'
        
        // Almacena la ruta de la imagen en la base de datos
        Auth::user()->profile->update([
            'profile_image' => 'profile_images/' . $imageName,
        ]);
    }

    return redirect()->route('profile.edit')->with('success', 'Profile image updated successfully');
}


    /**
     * Display the specified resource.
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        // Necesitaré esto para el futuro
        // Tu lógica para obtener y mostrar el formulario de edición del perfil
        // Puedes usar Auth::user() para obtener el usuario autenticado
        //return view('profile.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profile $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
