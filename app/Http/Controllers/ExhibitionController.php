<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Artist;
use App\Models\Exhibition;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExhibitionController extends Controller
{
    public function index()
    {
        
        $articles = Article::all();
        $artists = Artist::with("articles")->get();
        $exhibitions = Exhibition::with("artists")->orderby("created_at", "desc")->get();
        $sections = Section::with("exhibitions")->get();


        return view('pages.exhibitions.index', compact('articles', "artists", "exhibitions", "sections"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $sections = Section::all();

        return view('pages.exhibitions.create', compact("sections"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'expositionDates' => ['required','string', 'max:255']
        ]);

        $new_data = $request->all();

        $new_exhibition = Exhibition::create($new_data);

        return redirect()->route('exhibitions.index');
    }

    /**
     * Display the specified resource.
     */
    
    public function show(Exhibition $exhibition)
    {
        return view('pages.exhibitions.show', compact('exhibition'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exhibition $exhibition)
    {

        $sections = Section::all();

        return view('pages.exhibitions.edit', compact('exhibition', "sections"));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exhibition $exhibition)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'expositionDates' => ['nullable', 'string', 'max:255']
        ]);

        $validated_data = $request->all();

        $exhibition->update($validated_data);
        return redirect()->route('exhibitions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exhibition $exhibition)
    {
        $exhibition->delete();
        return redirect()->route('exhibitions.index');
    }
}
