@extends('layouts.app')


@section('content')
    <main class="container ">
        <h1>Actual Image: </h1>
     
        <figure class="w-25 mx-auto">
            <img src="{{ asset('/storage/' . $homepicture->imagePic) }}" alt="" class="w-100">
        </figure>

        <div class="d-flex flex-wrap mt-3">
            <div class="col-4">
                <h4>Position:</h4>
                <p>X:{{$homepicture->xAxis}}% <br> Y:{{$homepicture->yAxis}}%</p>
            </div>
            <div class="col-4">
                <h6>Heigth:</h6>
                {{$homepicture->height}}px
                <h6>Width:</h6>
                {{$homepicture->width}}px
            </div>
            <div class="col-4">
                <h6>Links To:</h6>
                {{$homepicture->linksTo}}
                <h6>Layer</h6>
                {{$homepicture->layer}}
            </div>
        </div>
        <a href="{{route("homepictures.edit", $homepicture)}}"><button class="btn btn-warning">Edit</button></a>
    </main>
@endsection