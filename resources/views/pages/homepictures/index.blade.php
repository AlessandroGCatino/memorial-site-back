@extends('layouts.app')



@section('content')
    <main class="container">
        <h1 class="text-center mt-2 ">Homepage Pictures</h1>

        <a href="{{route("homepictures.create")}}" class="btn btn-primary mb-3 ">Create New</a>
        <p class="text-danger">*there can only be 9 homepage pictures. Edit the ones you want to remove!</p>


        <div class="table-responsive">
            <table class="table table-primary">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">Image</th>
                        <th scope="col" class="text-center">Links to</th>
                        <th scope="col" class="text-center">Details</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($homepics as $item)
                            @php
                                error_log($item->id);
                            @endphp
                        <tr>
                            <td>
                                <figure style="width: 100px; margin: 0 auto;">
                                    <img src="{{ asset('/storage/' . $item->imagePic) }}" alt="" class="img-fluid">
                                </figure>
                            </td>

                            <td>
                                {{$item->linksTo}}
                            </td>
                            
                            <td class="text-center">
                                <a href="{{route("homepictures.show", $item)}}" class="btn btn-primary mb-1">See More...</a>
                            </td>

                            <td class="text-center">
                                <a href="{{route("homepictures.edit", $item)}}" class="btn btn-warning mb-1">Edit</a>
                                <form action="{{route("homepictures.destroy", $item)}}" method="post">
                                    @csrf
                                    @method("DELETE")

                                    <!-- Bottone per aprire la modale di cancellazione -->
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="setDeleteAction('{{ route('homepictures.destroy', $item) }}')">
                                        &cross;
                                    </button>
                                </form>
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
                    Are you sure you want to delete this home picture?
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