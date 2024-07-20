<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Exhibition;
use App\Models\HomePicture;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index(){

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

        $homePictures = HomePicture::all();

        $aboutUsPage = Article::where('operaName', 'AboutUs')->get();
        $HCNPage = Article::where('operaName', 'HolocaustCentreNorth')->get();


        return response()->json([
            "homePic" => $homePictures,
            "sections" => $sections,
            "openCall" => $openCall,
            "aboutUsPage" => $aboutUsPage,
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
