@extends('layouts.app')

@section('content')
    <main class="container">
        <h1 class="text-center mt-2 ">Sections List</h1>

        <a href="{{route("sections.create")}}" class="btn btn-primary mb-3 ">Create New</a>

        <div class="table-responsive">
            <table class="table table-primary">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">Name</th>
                        <th scope="col" class="text-center">Actions</th>
                        <th scope="col" class="text-center col-1 ">Public</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sections as $item)
                        <tr>
                            <td>
                                <a href="{{route("sections.show", $item)}}">{{$item->name}}</a>
                            </td>
                            <td class="text-center">
                                <a href="{{route("sections.edit", $item)}}" class="btn btn-warning mb-1">Edit</a>
                                <form action="{{route("sections.destroy", $item)}}" method="post">
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