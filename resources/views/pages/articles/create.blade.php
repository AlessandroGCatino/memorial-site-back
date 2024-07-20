@extends('layouts.app')

@section("content")

<div class="container mt-3 ">
    <h1 class="mb-3">Create a new Article</h1>

    @if ($errors->any())
        <div class="alert alert-danger ">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{route("articles.store")}}" method="POST" enctype="multipart/form-data" id="articleForm">

        @csrf

        <div class="mb-3">
            <label for="operaName" class="form-label">Name:</label>
            <input
                type="text"
                class="form-control"
                name="operaName"
                id="operaName"/>
        </div>

        <div class="mb-3">
            <label for="operaDescription" class="form-label">Description:</label>
            <textarea class="form-control" name="operaDescription" id="operaDescription" rows="3" ></textarea>
        </div>
        
        <div class="mb-3">
            <label for="operaYear" class="form-label">Year:</label>
            <input
                type="text"
                class="form-control"
                name="operaYear"
                id="operaYear"/>
        </div>

        <div class="mb-3">
            <label for="operaMaterial" class="form-label">Materials: (insert "none" for the openCalls)</label>
            <input type="text"  class="form-control" name="operaMaterial" id="operaMaterial" maxlength="255"/>
        </div>


        <div class="mb-3 d-flex justify-content-between">
            <div class="mb-3 col-5">
                <label for="operaPicture" class="form-label">Main image:</label>
                <input
                    type="file"
                    class="form-control"
                    name="operaPicture"
                    id="operaPicture"
                />
            </div>
            <div class="mb-3 col-6">
                <label for="videoUrl" class="form-label">
                    Video:
                </label>
                <input
                    type="text"
                    class="form-control"
                    name="videoUrl"
                    id="videoUrl"
                />
                <small class="text-muted">Insert the embed code e.g. "https://www.youtube.com/embed/dQw4w9WgXcQ?si=dic6wPdf1-SHva4o"</small>
            </div>
        </div>        
        
        <div class="mb-3">
            <label for="artist_id" class="form-label">Artist:</label>
            <select
                class="form-select form-select-lg"
                name="artist_id"
                id="artist_id"
            >
                <option selected disabled value="">Select one</option>
                @foreach ($artists as $item )
                    <option
                        value="{{$item->id}}"
                        {{$item->id == old("artist_id") ? "selected" : ""}}
                        >{{$item->artistName}}</option>
                @endforeach
                
            </select>
        </div>

        <div class="row mt-4" id="moreImagesContainer">
            <label for="cover_image" class="form-label">More images:</label>
            
            <div class="col-12 col-sm-10 col-lg-6 col-xxl-4 mb-4 text-center mx-auto" id="image-container-1">
                <div class="position-relative">
                    <div class="rounded overflow-hidden">
                        <img id="selectedImage" src="{{ Vite::asset('resources/asset/add-img.jpg') }}"
                            alt="example placeholder" class="img-fluid object-fit-cover"
                            style="max-width: fit-content; max-height:300px;" />
                    </div>
                    <div class="position-absolute top-50 start-50 translate-middle">
                        <div data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-rounded">
                            <label class="form-label text-white m-1" for="customFile1">+</label>
                            <input type="file" name="images[]" class="form-control d-none" id="customFile1"
                                onchange="displaySelectedImage(event, 'selectedImage')" />
                        </div>
                        @error('images[]')
                            <div class="alert alert-danger mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="btn btn-outline-danger position-absolute top-0 end-0 d-none"
                        onclick="removeElement('image-container-1')">
                        <i class="fas fa-x"></i>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- <div class="form-check  ">
            <input class="form-check-input" type="checkbox" value="yes" id="show" name="show"/>
            <label class="form-check-label" for="show"> Publish (if checked it will be shown on the site)</label>
        </div> --}}

        <span>Visible: </span>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="show" id="show1" value="yes">
            <label class="form-check-label" for="show1">
              Yes
            </label>
        </div>
        <div class="form-check mb-5">
            <input class="form-check-input" type="radio" name="show" id="show2" value="no">
            <label class="form-check-label" for="show2">
              No
            </label>
        </div>
    
        <button
            type="submit"
            class="btn btn-primary mb-5 "
        >
            Create
        </button>
        
    </form>

</div>

<script>
    let imageCounter = 2;

    function removeElement(elementId) {
        var elementToRemove = document.getElementById(elementId);
        if (!elementToRemove) return; // Exit if the element does not exist

        var fileInput = elementToRemove.querySelector('input[type="file"]');
        var selectElement = elementToRemove.querySelector('select');

        elementToRemove.parentNode.removeChild(elementToRemove);
    }

    document.addEventListener('DOMContentLoaded', function() {

        document.getElementById('articleForm').addEventListener('change', function(event) {
            if (event.target.name === 'images[]') {
                const input = event.target;
                const hasImage = input.files.length > 0;
                const parentDiv = input.closest('.col-12');

                const categorySelect = parentDiv.querySelector('select[name="categories[]"]');

                // Utilizzare l'ID univoco per selezionare il bottone
                var deleteButton = parentDiv.querySelector('.btn-outline-danger');

                if (hasImage) {
                    categorySelect.removeAttribute('disabled');
                    categorySelect.setAttribute('required', 'required');
                    deleteButton.classList.remove('d-none')
                } else {
                    categorySelect.removeAttribute('required');
                    categorySelect.setAttribute('disabled', 'disabled');
                }
            }
        });

        window.displaySelectedImage = function(event, elementId) {
            const selectedImage = document.getElementById(elementId);
            const fileInput = event.target;

            const uniqueId = 'image-input-' + imageCounter; // ID univoco per il contenitore


            if (fileInput.files && fileInput.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    selectedImage.src = e.target.result;
                };

                reader.readAsDataURL(fileInput.files[0]);
            }

            if (selectedImage.src.startsWith('data:')) {
                console.log(selectedImage)
                return
            } else {
                // Altrimenti, crea un nuovo elemento solo se non esiste già
                const parentElement = document.getElementById('moreImagesContainer');
                const childElement = document.createElement('div');
                childElement.classList.add('col-12', 'mb-4', 'col-sm-10', 'col-lg-6', 'col-xxl-4', 'text-center', 'mx-auto');
                childElement.setAttribute('id', uniqueId);

                // Utilizza la variabile globale per generare ID univoci
                const currentImageCounter = imageCounter;

                console.log('immagine caricata')

                childElement.innerHTML = `
                    <div class="position-relative">
                        <div class="rounded overflow-hidden">
                            <img id="selectedImage${currentImageCounter}" src="{{ Vite::asset('resources/asset/add-img.jpg') }}"
                                alt="example placeholder" class="img-fluid object-fit-cover" style="max-width:fit-content; max-height: 300px"/>
                        </div>
                        <div class="position-absolute top-50 start-50 translate-middle">
                            <div data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-rounded">
                                <label class="form-label text-white m-1" for="customFile${currentImageCounter}">+</label>
                                <input type="file" name="images[]" class="form-control d-none" id="customFile${currentImageCounter}" onchange="displaySelectedImage(event, 'selectedImage${currentImageCounter}')" />
                            </div>
                        </div>
                        <div class="btn btn-outline-danger position-absolute top-0 end-0 d-none" onclick="removeElement('${uniqueId}')">
                            <i class="fas fa-x"></i>
                        </div>
                    </div>
                    `;

                parentElement.appendChild(childElement);

                // Incrementa la variabile globale per il prossimo ID
                imageCounter++;
            }
        };
    });

</script>

<style>
    #moreImagesContainer>div .btn {
        display: none
    }

    #moreImagesContainer>div:hover .btn {
        display: block
    }
</style>

@endsection
