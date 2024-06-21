@extends('layouts.app')

@section("content")

<div class="container mt-3 ">
    <h1 class="mb-3">Edit Artist</h1>

    @if ($errors->any())
        <div class="alert alert-danger ">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{route("artists.update", $artist)}}" method="POST" enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="artistName" class="form-label">Name:</label>
            <input
                type="text"
                class="form-control"
                name="artistName"
                id="artistName"
                value="{{$artist->artistName}}"/>
        </div>

        <div class="mb-3">
            <label for="artistDesc" class="form-label">Description:</label>
            <textarea class="form-control" name="artistDesc" id="artistDesc" rows="3">{{old("artistDesc") ?? $artist->artistDesc}}</textarea>
        </div>

        <div class="mb-3">
            <div class="mb-3">
                <label for="coverImage" class="form-label">Main image:</label>
                <input
                    type="file"
                    class="form-control"
                    name="coverImage"
                    id="coverImage"
                />
            </div>
            @if ($artist->coverImage)
                <div class="my-3">
                    <label for="old_coverImage" class="form-label">Actual picture:</label>
                    <div class="row">
                        <div class="col-12">
                            <img src="{{ asset('/storage/' . $artist->coverImage) }}" class="img-fluid" alt="{{ $artist->artistName }}" id="old_coverImage" width="150"  />
                        </div>
                    </div>
                    <input class="form-check-input" type="checkbox" value="yes" id="remove" name="remove"/>
                    <label class="form-check-label" for="remove"> Remove</label>
                </div>


            @else
                <div class="text-center mt-2"> No pictures selected</div>
            @endif
        </div>
        
        <div class="mb-3">
            <label for="exhibition_id" class="form-label">Exhibition:</label>
            <select
                class="form-select form-select-lg"
                name="exhibition_id"
                id="exhibition_id"
            >
                <option selected disabled value="">Select one</option>
                @foreach ($exhibitions as $item )
                    <option
                        value="{{$item->id}}"
                        {{$item->exhibition_id == old("exhibition_id") ? "selected" : ""}}
                        >{{$item->title}}</option>
                @endforeach
                
            </select>
        </div>

        <div class="form-check mt-5 mb-5  ">
            <input class="form-check-input" type="checkbox" value="yes" id="show" name="show" {{ $artist->show == "yes" ? 'checked' : '' }}/>
            <label class="form-check-label" for="show"> Publish (if checked it will be shown on the site)</label>
        </div>
        
    
        <button
            type="submit"
            class="btn btn-primary"
        >
            Edit
        </button>
        
    </form>

</div>

@endsection
