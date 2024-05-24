<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PictureController extends Controller
{
    public function index()
    {
        
        $articles = Article::all();
        $artists = Artist::with("articles")->get();
        $exhibitions = Exhibition::with("artists")->get();
        $sections = Section::with("exhibitions")->get();


        return view('pages.artists.index', compact('articles', "artists", "exhibitions", "sections"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $exhibitions = Exhibition::all();

        return view('pages.artists.create', compact("exhibitions"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'artistName' => ['required', 'string', 'max:255'],
            'artistDesc' => ['nullable', 'string', 'max:255'],
            'coverImage' => ['nullable', 'image'],
        ]);

        if($request->hasFile("coverImage")){
            $path = Storage::disk("public")->put("artists_images", $request->coverImage);

            $request["coverImage"] = $path;
            
        }

        $new_data = $request->all();

        if($request->hasFile("coverImage")){
            $path = Storage::disk("public")->put("artists_images", $request->coverImage);

            $new_data["coverImage"] = $path;
            
        }

        $new_artist = Artist::create($new_data);

        return redirect()->route('artists.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Artist $artist)
    {
        return view('pages.artists.show', compact('artist'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Artist $artist)
    {

        $exhibitions = Exhibition::all();

        return view('pages.artists.edit', compact('artist', "exhibitions"));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Artist $artist)
    {
        $request->validate([
            'artistName' => ['required', 'string', 'max:255'],
            'artistDesc' => ['nullable', 'string', 'max:255'],
            'coverImage' => ['nullable', 'image'],
        ]);

        if($request->hasFile("coverImage")){
            if($artist->coverImage){
                Storage::delete($artist->coverImage);
            }
            $path = Storage::disk("public")->put("artists_images", $request->coverImage);

            $request["coverImage"] = $path;
            
        }

        $validated_data = $request->all();

        if($request->hasFile("coverImage")){
            if($artist->coverImage){
                Storage::delete($artist->coverImage);
            }
            $path = Storage::disk("public")->put("artists_images", $request->coverImage);

            $validated_data["coverImage"] = $path;
            
        }

        $artist->update($validated_data);
        return redirect()->route('artists.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Artist $artist)
    {
        if($artist->coverImage){
            Storage::delete($artist->coverImage);
        }
        $artist->delete();
        return redirect()->route('dashboard.artists.index');
    }
}
