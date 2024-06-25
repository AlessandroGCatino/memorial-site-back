<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Exhibition;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index(){


        // $sections = Section::with('exhibitions.artists.articles.pictures')
        // ->where('show', '!=', 'no')
        // ->get();

        $sections = Section::where('show', '!=', 'no')
        ->with(['exhibitions' => function ($query) {
            $query->where('show', '!=', 'no')
                ->with(['artists' => function ($query) {
                    $query->where('show', '!=', 'no')
                        ->with(['articles' => function ($query) {
                            $query->where('show', '!=', 'no')
                                ->with(['pictures']);
                        }]);
                }]);
        }])
        ->get();

        $openCall = Section::whereRaw('LOWER(name) LIKE ?', ['opencall%'])
        ->with(['exhibitions' => function ($query) {
            $query->with(['artists' => function ($query) {
                $query->with(['articles' => function ($query) {
                    $query->where('show', 'yes')->with('pictures');
                }]);
            }]);
        }])
        ->first();

        $homePictures = Exhibition::with(['artists.articles' => function ($query) {
            $query->where('show', "yes");
        }])
        ->whereRaw('LOWER(title) LIKE ?', ['%memorial gestures%'])
        ->where('show', 'yes') // Condizione per il campo "show" dell'exhibition
        ->orderby('id', 'desc')
        ->first();

        return response()->json([
            "homePic" => $homePictures,
            "sections" => $sections,
            "openCall" => $openCall,
            
        ]);
    }

    public function show($id){
        $sections = Section::with('exhibitions.artists.articles')->where("id", $id)->first();
        if ($sections){
            return response()->json([
                "success" => "true",
                "sections" => $sections
            ]);
        } else {
            return response()->json([
                "success" => "false",
                "error" => "No articles were found"
            ]);
        }
    }

    public function homePage(){
        

    }
}
