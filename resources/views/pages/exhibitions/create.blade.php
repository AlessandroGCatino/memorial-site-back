@extends('layouts.app')

@section("content")

<div class="container mt-3 ">
    <h1 class="mb-3">Create a new Exhibition</h1>

    @if ($errors->any())
        <div class="alert alert-danger ">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{route("exhibitions.store")}}" method="POST" enctype="multipart/form-data">

        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Title:</label>
            <input
                type="text"
                class="form-control"
                name="title"
                id="title"/>
        </div>
        
        <div class="mb-3">
            <label for="expositionDates" class="form-label">Duration:</label>
            <input
                type="text"
                class="form-control"
                placeholder="Month Year - Month Year"
                name="expositionDates"
                id="expositionDates"/>
        </div>
        
        <div class="mb-3">
            <label for="section_id" class="form-label">Section:</label>
            <select
                class="form-select form-select-lg"
                name="section_id"
                id="section_id"
            >
                <option selected disabled value="">Select one</option>
                @foreach ($sections as $item )
                    <option
                        value="{{$item->id}}"
                        {{$item->id == old("section_id") ? "selected" : ""}}
                        >{{$item->name}}</option>
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
