<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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

        $openCall = Section::where('name', 'openCall')
        ->with(['exhibitions' => function ($query) {
            $query->with(['artists' => function ($query) {
                $query->with(['articles' => function ($query) {
                    $query->where('show', 'yes')->with('pictures');
                }]);
            }]);
        }])
        ->first();

        return response()->json([
            "test" => "true",
            "sections" => $sections,
            "openCall" => $openCall
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
                "error" => "Nessun progetto trovato"
            ]);
        }
    }
}
