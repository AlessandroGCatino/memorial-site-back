@extends('layouts.app')

{{-- "image",
    "xAxis",
    "yAxis",
    "height",
    "width",
    "linksTo",
    "layer" --}}

@section("content")

<div class="container mt-3 ">
    <h1 class="mb-3">Create a new Homepage Pic</h1>

    @if ($errors->any())
        <div class="alert alert-danger ">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{route("homepictures.store")}}" method="POST" enctype="multipart/form-data">

        @csrf

        <div class="mb-3">
            <label for="xAxis" class="form-label">Horizontal Placement (in %):</label>
            <input
                required
                type="number"
                class="form-control"
                name="xAxis"
                id="xAxis"/>
        </div>

        <div class="mb-3">
            <label for="yAxis" class="form-label">Vertical Placement (in %):</label>
            <input
                required
                type="number"
                class="form-control"
                name="yAxis"
                id="yAxis"/>
        </div>


        <div class="mb-3">
            <div class="mb-3">
                <label for="imagePic" class="form-label">Image:</label>
                <input
                    required
                    type="file"
                    class="form-control"
                    name="imagePic"
                    id="imagePic"
                />
            </div>
        </div>
        
        <div class="mb-3">
            <label for="height" class="form-label">Height:</label>
            <input
                required
                type="number"
                class="form-control"
                name="height"
                id="height"/>
        </div>

        <div class="mb-3">
            <label for="width" class="form-label">Width:</label>
            <input
                required
                type="number"
                class="form-control"
                name="width"
                id="width"/>
        </div>

        <div class="mb-3">
            <label for="layer" class="form-label">Layer (a higher layer means the image is on top):</label>
            <input
                required
                type="number"
                class="form-control"
                name="layer"
                id="layer"/>
        </div>

        <div class="mb-3">
            <label for="linksTo" class="form-label">Links to:</label>
            <input
                required
                placeholder="Insert the link of the article you want the image to redirect you to."
                type="text"
                class="form-control"
                name="linksTo"
                id="linksTo"/>
        </div>
        
    
        <button
            type="submit"
            class="btn btn-primary"
        >
            Create
        </button>
        
    </form>

</div>

@endsection
