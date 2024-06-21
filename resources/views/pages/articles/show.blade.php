@extends('layouts.app')


@section('content')
    <main class="container ">
        <h1>Title: {{$article->operaName}}</h1>
        <figure class="w-25 mx-auto">
            <img src="{{ asset('/storage/' . $article->operaPicture) }}" alt="" class="w-100">
        </figure>
        <div class="d-flex flex-wrap">
            <div class="col-5">
                <h4>Opera Year: </h4>
                <p>{{$article->operaYear}}</p>
            </div>
            <div class="col-5">

                <h4>Opera Materials:</h4>
                <p>{{$article->operaMaterial}}</p>
            </div>
            <div class="col-5">
                <h4>Opera Description:</h4>
                <p>{{$article->operaDescription}}</p>
            </div>
            <div class="col-5">
                <h4>Artist:</h4>
                <a href="{{route("artists.show", $artist)}}">
                    <p>{{$artist->artistName}}</p>
                </a>
            </div>
        </div>
        <h1 class="text-capitalize">Published: {{$article->show}}</h1>
        <a href="{{route("articles.edit", $article)}}"><button class="btn btn-warning">Edit</button></a>
    </main>
@endsection