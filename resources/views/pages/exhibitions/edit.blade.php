@extends('layouts.app')

@section("content")

<div class="container mt-3 ">
    <h1 class="mb-3">Edit Exhibition</h1>

    @if ($errors->any())
        <div class="alert alert-danger ">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{route("exhibitions.update", $exhibition)}}" method="POST" enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Title:</label>
            <input
                type="text"
                class="form-control"
                name="title"
                id="title"
                value="{{$exhibition->title}}"/>
        </div>
        
        <div class="mb-3">
            <label for="expositionDates" class="form-label">Duration:</label>
            <input
                type="text"
                class="form-control"
                name="expositionDates"
                id="expositionDates"
                value="{{$exhibition->expositionDates}}"/>
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
                        {{$item->id == $exhibition->section_id ? "selected" : ""}}
                        >{{$item->name}}</option>
                @endforeach
                
            </select>
        </div>

        <div class="form-check mt-5 mb-5  ">
            <input class="form-check-input" type="checkbox" value="yes" id="show" name="show" {{ $exhibition->show == "yes" ? 'checked' : '' }}>
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
