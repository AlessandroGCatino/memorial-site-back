@extends('layouts.app')

@section("content")

<div class="container mt-3 ">
    <h1 class="mb-3">Edit Section</h1>

    @if ($errors->any())
        <div class="alert alert-danger ">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{route("sections.update", $section)}}" method="POST" enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input
                type="text"
                class="form-control"
                name="name"
                id="name"
                value="{{$section->name}}"/>
        </div>

        <div class="form-check mt-5 mb-5  ">
            <input class="form-check-input" type="checkbox" value="yes" id="show" name="show" {{ $section->show == "yes" ? 'checked' : '' }}/>
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
