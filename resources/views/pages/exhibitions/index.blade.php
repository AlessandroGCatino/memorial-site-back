@extends('layouts.app')

@section('content')
    <main class="container">
        <h1 class="text-center mt-2 ">Exhibitions List</h1>

        <a href="{{route("exhibitions.create")}}" class="btn btn-primary mb-3 ">Create New</a>

        <div class="table-responsive">
            <table class="table table-primary">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">Title</th>
                        <th scope="col" class="text-center">Duration</th>
                        <th scope="col" class="text-center">Actions</th>
                        <th scope="col" class="text-center col-1 ">Public</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($exhibitions as $item)
                        <tr>
                            <td>
                                <a href="{{route("exhibitions.show", $item)}}">{{$item->title}}</a>
                            </td>
                            <td>{{$item->expositionDates}}</td>
                            <td class="text-center">
                                <a href="{{route("exhibitions.edit", $item)}}" class="btn btn-warning mb-1">Edit</a>
                                <form action="{{route("exhibitions.destroy", $item)}}" method="post">
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