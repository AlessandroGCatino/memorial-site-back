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
                                {{$item->title}}
                            </td>
                            <td>{{$item->expositionDates}}</td>
                            <td class="text-center">
                                <a href="{{route("exhibitions.edit", $item)}}" class="btn btn-warning mb-1">Edit</a>
                                <form action="{{route("exhibitions.destroy", $item)}}" method="post">
                                    @csrf
                                    @method("DELETE")
                                    <!-- button for delete -->
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="setDeleteAction('{{ route('exhibitions.destroy', $item) }}')">
                                        &cross;
                                    </button>
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

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Cancellation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this exhibition?
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