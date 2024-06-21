@extends('layouts.app')


@section('content')
    <main class="container ">
        <p>{{$artist}}</p>
        <h1>Artist Name: {{$artist->artistName}}</h1>

        @if ($artist->coverImage)     
        <figure class="w-25 mx-auto">
            <img src="{{ asset('/storage/' . $artist->coverImage) }}" alt="" class="w-100">
        </figure>
        @else
        <div class="text-center mt-2"> No pictures of the artist uploaded</div>
        @endif
        <div class="d-flex flex-wrap mt-3">
            <div class="col-5">
                <h4>Artist Description:</h4>
                <p>{{$artist->artistDesc}}</p>
            </div>
            <div class="col-5">
                <h4>Linked Operas:</h4>
                @foreach ($articles as $article)
                    <a href="{{route("articles.show", $article)}}">{{$article->operaName}}</a>
                @endforeach
            </div>
        </div>
        <h1 class="text-capitalize">Published: {{$artist->show}}</h1>
        <a href="{{route("artists.edit", $artist)}}"><button class="btn btn-warning">Edit</button></a>
    </main>
@endsection