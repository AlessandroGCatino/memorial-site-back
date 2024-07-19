<?php

namespace App\Http\Controllers;

use App\Models\HomePicture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomePicturesController extends Controller
{
    public function index()
    {
        $homepics = HomePicture::all();
        return view('pages.homepictures.index', compact('homepics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.homepictures.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'imagePic' => ['nullable'],
            'videoUrl' => ['nullable'],
            'selectedMode' => ['required'],
            'xAxis' => ['required'],
            'yAxis' => ['required'],
            'height' => ['required'],
            'width' => ['required'],
            'linksTo' => ['required'],
            'layer' => ['required']
        ]);

        if($request->hasFile("imagePic")){
            $path = Storage::disk("public")->put("homepage_images", $request->imagePic);
            $request["imagePic"] = $path;
        }

        $new_data = $request->all();

        if($request->hasFile("imagePic")){
            $path = Storage::disk("public")->put("homepage_images", $request->imagePic);
            $new_data["imagePic"] = $path;
        }

        $new_HomePic = HomePicture::create($new_data);

        return redirect()->route('homepictures.index');
    }

    // /**
    //  * Display the specified resource.
    //  */
    public function show(HomePicture $homepicture)
    {

        return view('pages.homepictures.show', compact('homepicture'));

    }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    public function edit(HomePicture $homepicture)
    {
        return view('pages.homepictures.edit', compact('homepicture'));
    }

    // /**
    //  * Update the specified resource in storage.
    //  */
    public function update(Request $request, HomePicture $homepicture)
    {
        $request->validate([
            'imagePic' => ['nullable'],
            'videoUrl' => ['nullable'],
            'selectedMode' => ['required'],
            'xAxis' => ['nullable'],
            'yAxis' => ['nullable'],
            'height' => ['nullable'],
            'width' => ['nullable'],
            'linksTo' => ['nullable'],
            'layer' => ['nullable']
        ]);

        if($request->hasFile("imagePic")){
            if($homepicture->imagePic){
                Storage::delete($homepicture->imagePic);
            }
            $path = Storage::disk("public")->put("homepage_images", $request->imagePic);
            $request["imagePic"] = $path;
        }

        if($request->selectedMode == 'image'){
            $request["videoUrl"] = null;
        }

        $validated_data = $request->all();

        if($request->hasFile("imagePic")){
            if($homepicture->imagePic){
                Storage::delete($homepicture->imagePic);
            }
            $path = Storage::disk("public")->put("homepage_images", $request->imagePic);
            $validated_data["imagePic"] = $path;
            
        }

        $homepicture->update($validated_data);
        return redirect()->route('homepictures.index');
    }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    public function destroy(HomePicture $homepicture)
    {
        if($homepicture->imagePic){
            Storage::delete($homepicture->imagePic);
        }
        $homepicture->delete();
        return redirect()->route('homepictures.index');
    }
}
