<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Artist;
use App\Models\Exhibition;
use App\Models\Picture;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index()
    {
        
        $articles = Article::with('artist')->orderby("created_at", "desc")->get();
        $artists = Artist::with("articles")->get();
        $exhibitions = Exhibition::with("artists")->get();
        $sections = Section::with("exhibitions")->get();
        return view('pages.articles.index', compact('articles', "artists", "exhibitions", "sections"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $artists = Artist::all();

        return view('pages.articles.create', compact("artists"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'operaName' => ['required', 'string', 'max:255'],
            'operaDescription' => ['nullable', 'string'],
            'operaYear' => ['nullable', 'string', 'max:255'],
            'operaMaterial' => ['nullable', 'string'],
            'operaPicture' => ['nullable', 'image'],
        ]);

        if($request->hasFile("operaPicture")){
            $path = Storage::disk("public")->put("articles_images", $request->operaPicture);

            $request["operaPicture"] = $path;
            
        }

        $new_data = $request->all();

        

        if($request->hasFile("operaPicture")){
            $path = Storage::disk("public")->put("articles_images", $request->operaPicture);

            $new_data["operaPicture"] = $path;
            
        }

        $new_article = Article::create($new_data);

        if ($request->has('images')) {
            foreach ($request->file('images') as $index => $image) {
                if ($image->isValid()) {
                    $path = Storage::disk('public')->put("articles_images/more_images", $image);

                    $validated_data['images'][$index] = $path;

                    // Creazione del record di immagine nel database
                    Picture::create([
                        'article_id' => $new_article->id,
                        'singlePicture' => $path,
                    ]);
                }
            }
        }

        return redirect()->route('articles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {

        $artist = Artist::where("id", $article->id)->first();

        return view('pages.articles.show', compact('article', 'artist'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {

        $artists = Artist::where("id", $article->artist_id)->get();;
        $more_images = Picture::where('article_id', $article->id)
            ->get();

        return view('pages.articles.edit', compact('article', "artists", "more_images"));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'operaName' => ['required', 'string', 'max:255'],
            'operaDescription' => ['nullable', 'string'],
            'operaYear' => ['nullable', 'string', 'max:255'],
            'operaMaterial' => ['nullable', 'string'],
            'operaPicture' => ['nullable', 'image'],
        ]);


        // dd($request);

        if($request->hasFile("operaPicture")){

            
            if($article->operaPicture){
                Storage::delete($article->operaPicture);
            }
            $path = Storage::disk("public")->put("articles_images", $request->operaPicture);

            $request["operaPicture"] = $path;
            
        }

        $validated_data = $request->all();

        if(!$request->show){
            $validated_data["show"] = "no";
        }

        if($request->hasFile("operaPicture")){

            
            if($article->operaPicture){
                Storage::delete($article->operaPicture);
            }
            $path = Storage::disk("public")->put("articles_images", $request->operaPicture);

            $validated_data["operaPicture"] = $path;
            
        }


        //this handles Multi Images

        $old_images = Picture::where("article_id", $article->id)->get();

        if ($request->deleteAll && $old_images){
            if($old_images){
                foreach ($old_images as $image) {
                    Storage::delete($image->singlePicture);
                    $image->delete();
                }
            }
        } else if ($request->has('images')) {
            if($old_images){
                foreach ($old_images as $image) {
                    Storage::delete($image->singlePicture);
                    $image->delete();
                }
            }
            foreach ($request->file('images') as $index => $image) {
                if ($image->isValid()) {
                    $path = Storage::disk('public')->put("articles_images/more_images", $image);

                    $validated_data['images'][$index] = $path;

                    // Creazione del record di immagine nel database
                    Picture::create([
                        'article_id' => $article->id,
                        'singlePicture' => $path,
                    ]);
                }
            }
        }
        
        $article->update($validated_data);

        return redirect()->route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {

        if($article->operaPicture){
            Storage::delete($article->operaPicture);
        }

        $old_images = Picture::where("article_id", $article->id)->get();

        if($old_images){
            foreach ($old_images as $image) {
                Storage::delete($image->singlePicture);
                $image->delete();
            }
        }
        $article->delete();
        return redirect()->route('articles.index');
    }
}
