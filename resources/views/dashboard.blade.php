@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="fs-4 text-secondary my-4">
        {{ __('Dashboard') }}
    </h2>
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">{{ __('User Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <a href="{{route("articles.index")}}" class="btn btn-primary mb-3 ">Articles List</a>
                    <a href="{{route("artists.index")}}" class="btn btn-primary mb-3 ">Artists List</a>
                    <a href="{{route("exhibitions.index")}}" class="btn btn-primary mb-3 ">Exhibitions List</a>
                    <a href="{{route("sections.index")}}" class="btn btn-primary mb-3 ">Sections List</a>
                    <a href="{{route("homepictures.index")}}" class="btn btn-primary mb-3 ">Homepage Pics List</a>
                </div>
            </div>
        </div>
        <div class="p-4">
            <a href="{{route("tutorials")}}" class="btn btn-warning">Tutorials</a>
        </div>
    </div>
</div>
@endsection
