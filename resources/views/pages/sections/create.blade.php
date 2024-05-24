@extends('layouts.app')

@section("content")

<div class="container mt-3 ">
    <h1 class="mb-3">Create a new Section</h1>

    @if ($errors->any())
        <div class="alert alert-danger ">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{route("sections.store")}}" method="POST" enctype="multipart/form-data">

        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input
                type="text"
                class="form-control"
                name="name"
                id="name"/>
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
