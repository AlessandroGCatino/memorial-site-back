@extends('layouts.app')

@section("content")

<div class="container mt-3 ">
    <h1 class="mb-3">Create a new Artist</h1>

    @if ($errors->any())
        <div class="alert alert-danger ">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{route("artists.store")}}" method="POST" enctype="multipart/form-data">

        @csrf

        <div class="mb-3">
            <label for="artistName" class="form-label">Name:</label>
            <input
                type="text"
                class="form-control"
                name="artistName"
                id="artistName"/>
        </div>

        <div class="mb-3">
            <label for="artistDesc" class="form-label">Description:</label>
            <textarea class="form-control" name="artistDesc" id="artistDesc" rows="3"></textarea>
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
                        {{$item->id == old("exhibition_id") ? "selected" : ""}}
                        >{{$item->title}}</option>
                @endforeach
                
            </select>
        </div>

        <span>Visible: </span>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="show" id="show1" value="yes">
            <label class="form-check-label" for="show1">
              Yes
            </label>
        </div>
        <div class="form-check mb-5">
            <input class="form-check-input" type="radio" name="show" id="show2" value="no">
            <label class="form-check-label" for="show2">
              No
            </label>
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
