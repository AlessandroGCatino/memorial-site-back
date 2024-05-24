<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Artist;
use App\Models\Exhibition;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index()
    {
        
        $articles = Article::all();
        $artists = Artist::with("articles")->get();
        $exhibitions = Exhibition::with("artists")->get();
        $sections = Section::with("exhibitions")->orderby("created_at", "desc")->get();


        return view('pages.sections.index', compact('articles', "artists", "exhibitions", "sections"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.sections.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255']
        ]);
        
        $update_data = $request->all();
        
        $new_section = Section::create($update_data);

        return redirect()->route('sections.index');
    }

    /**
     * Display the specified resource.
     */
    
    public function show(Section $section)
    {
        return view('pages.sections.show', compact('section'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {

        return view('pages.sections.edit', compact('section'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Section $section)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255']
        ]);

        $validated_data = $request->all();

        $section->update($validated_data);
        return redirect()->route('sections.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section)
    {
        
        $section->delete();
        return redirect()->route('sections.index');
    }
}
