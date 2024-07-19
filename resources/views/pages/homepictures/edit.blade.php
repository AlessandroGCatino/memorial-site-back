@extends('layouts.app')


@section("content")

<div class="container mt-3 ">
    <h1 class="mb-3">Edit HomePicture</h1>

    @if ($errors->any())
        <div class="alert alert-danger ">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('homepictures.update', $homepicture) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="xAxis" class="form-label">Horizontal Placement (in %):</label>
            <input
        
                type="number"
                class="form-control"
                name="xAxis"
                id="xAxis"
                value="{{$homepicture->xAxis}}"/>
        </div>

        <div class="mb-3">
            <label for="yAxis" class="form-label">Vertical Placement (in %):</label>
            <input
        
                type="number"
                class="form-control"
                name="yAxis"
                value="{{$homepicture->yAxis}}"/>
        </div>

        <div class="mb-3 d-flex justify-content-between">
            <div class="mb-3 col-5">
                <label for="imagePic" class="form-label">
                    Image:
                    <label class="form-check-label">
                        <input
                            @checked($homepicture->selectedMode == "image")
                            class="form-check-input"
                            name="selectedMode"
                            type="radio"
                            value="image"
                            aria-label="Image selected"
                        />
                    </label>
                </label>
                <input
                    type="file"
                    class="form-control"
                    name="imagePic"
                    id="imagePic"
                />
            </div>
            <div class="col-1 d-flex justify-content-center align-items-center">
                or
            </div>
            <div class="mb-3 col-6">
                <label for="videoUrl" class="form-label">
                    Video:
                    <label class="form-check-label">
                        <input
                            class="form-check-input"
                            name="selectedMode"
                            type="radio"
                            value="video"
                            aria-label="Video selected"
                            @checked($homepicture->selectedMode == "video")
                        />
                    </label>
                    
                </label>
                <input
                    value="{{ $homepicture->videoUrl }}"
                    type="text"
                    class="form-control"
                    name="videoUrl"
                    id="videoUrl"
                />
                <small class="text-muted">Insert the embed code e.g. "https://www.youtube.com/embed/dQw4w9WgXcQ?si=dic6wPdf1-SHva4o"</small>
            </div>
        </div>
        
        <div class="mb-3">
            <label for="height" class="form-label">Height:</label>
            <input
        
                type="number"
                class="form-control"
                name="height"
                id="height"
                value="{{$homepicture->height}}"/>
        </div>

        <div class="mb-3">
            <label for="width" class="form-label">Width:</label>
            <input
        
                type="number"
                class="form-control"
                name="width"
                id="width"
                value="{{$homepicture->width}}"/>
        </div>

        <div class="mb-3">
            <label for="layer" class="form-label">Layer (a higher layer means the image is on top): </label>
            <input
        
                type="number"
                class="form-control"
                name="layer"
                id="layer"
                value="{{$homepicture->layer}}"/>
        </div>

        <div class="mb-3">
            <label for="linksTo" class="form-label">Links to:</label>
            <input
        
                placeholder="Insert the link of the article you want the image to redirect you to."
                type="text"
                class="form-control"
                name="linksTo"
                id="linksTo"
                value="{{$homepicture->linksTo}}"/>
        </div>
        
    
        <button
            type="submit"
            class="btn btn-primary mb-5 "
        >
            Save changes
        </button>
    </form>

</div>


@endsection
