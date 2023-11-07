<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;


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
        $request->validate([
            'imageUpload' => 'required|file|image|max:200',
        ]);

        // Obtener la imagen cargada desde la solicitud del formulario
        $requestImage = $request->file('imageUpload');

        // Crear una instancia de la clase Image y cargar la imagen en ella, utilizamos la librería Intervention Image
        $img = Image::make($requestImage);

        // Redimensionar la imagen manteniendo la proporción y asegurándose de que no se haga más grande
        $img->resize(null, 400, function ($constraint) {
            $constraint->aspectRatio(); // Mantener la proporción de la imagen
            $constraint->upsize(); // Evitar que la imagen se haga más grande si ya es más pequeña que el tamaño especificado
        });

        // Generar un nombre único basado en el hash de la imagen para evitar conflictos de nombres
        $name = $requestImage->hashName();

        // Definir la ruta donde se guardará la imagen redimensionada
        $path = config('filesystems.disks.public.root') . '/profile_images/' . $name;

        // Guardar la imagen redimensionada en la ubicación especificada
        $img->save($path);


        Profile::updateOrCreate(
            ['user_id' => Auth::id()],
            ['imageUpload' => './profile_images/' . $name]
            //imageUpload: "profile_images/Ar3ubS14rK3J0dkRkHsslCmQu54zqfPkWPpuqzda.jpg",
        );

        return redirect()->route('edit-profile')->with('success', 'Profile image updated successfully');
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
    public function edit()
    {
        $user = auth()->user();
        $profile = $user->profile;

        return view('profile.edit', compact('user', 'profile'));
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
