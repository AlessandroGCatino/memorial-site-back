@extends('layouts.app')

@section('content')
    <main class="container">
        <h1 class="text-center mt-2 ">Artists List</h1>

        <a href="{{route("artists.create")}}" class="btn btn-primary mb-3 ">Create New</a>

        <div class="table-responsive">
            <table class="table table-primary">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">Name</th>
                        <th scope="col" class="text-center">Description</th>
                        <th scope="col" class="text-center">Cover Image</th>
                        <th scope="col" class="text-center">Actions</th>
                        <th scope="col" class="text-center col-1 ">Public</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($artists as $item)
                        <tr>
                            <td>
                                <a href="{{route("artists.show", $item)}}">{{$item->artistName}}</a>
                            </td>
                            <td>{{$item->artistDesc}}</td>
                            
                            @if ($item->coverImage)
                                <td>
                                    <figure style="width: 100px ;">
                                        <img src="{{ asset('/storage/' . $item->coverImage) }}" alt="" class="img-fluid">
                                    </figure>
                                </td>
                            @endif
                            <td class="text-center">
                                <a href="{{route("artists.edit", $item)}}" class="btn btn-warning mb-1">Edit</a>
                                <form action="{{route("artists.destroy", $item)}}" method="post">
                                    @csrf
                                    @method("DELETE")

                                    <button type="submit" class="btn btn-danger">&cross;</button>
                                </form>
                            </td>
                            <td class="text-center col-1 ">
                                <span class="text-uppercase">{{$item->show}}</span>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        
    </main>
@endsection