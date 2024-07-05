@extends('layouts.app')

@php
    use Illuminate\Support\Str;
    // dd($articles);
@endphp

@section('content')
    <main class="container">
        <h1 class="text-center mt-2 ">Articles List</h1>

        <a href="{{route("articles.create")}}" class="btn btn-primary mb-3 ">Create New</a>

        <div class="table-responsive">
            <table class="table table-primary">
                <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Year</th>
                        <th scope="col">Material</th>
                        <th scope="col">Description</th>
                        <th scope="col">Artist</th>
                        <th scope="col">Main Picture</th>
                        <th scope="col">Actions</th>
                        <th scope="col" class="text-center col-1 ">Public</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articles as $item)
                        <tr>
                            <td>
                                <a href="{{route("articles.show", $item)}}">{{$item->operaName}}</a>
                            </td>
                            <td>{{$item->operaYear}}</td>
                            <td>{{ Str::limit($item->operaMaterial, 100) }}</td>
                            <td>{{ Str::limit($item->operaDescription, 100) }}</td>
                            <td> 
                            @if (isset($item->artist->artistName))
                                {{ $item->artist->artistName}}
                            @endif
                            </td>
                            @if ($item->operaPicture)
                                <td>
                                    <figure style="width: 100px;">
                                        <img src="{{ asset('/storage/' . $item->operaPicture) }}" alt="" class="img-fluid">
                                    </figure>
                                </td>
                            @endif
                            <td class="text-center">
                                <a href="{{route("articles.edit", $item)}}" class="btn btn-warning mb-1">Edit</a>
                                <!-- button for delete -->
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="setDeleteAction('{{ route('articles.destroy', $item) }}')">
                                    &cross;
                                </button>
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

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Cancellation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this article?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Go Back</button>
                    <form id="deleteForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Script to set the action of the delete form -->
    <script>
        function setDeleteAction(action) {
            document.getElementById('deleteForm').action = action;
        }
    </script>
@endsection
