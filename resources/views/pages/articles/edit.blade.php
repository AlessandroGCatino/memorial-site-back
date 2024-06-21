@extends('layouts.app')

@section("content")

<div class="container mt-3 ">
    <h1 class="mb-3">Edit Article</h1>

    @if ($errors->any())
        <div class="alert alert-danger ">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{route("articles.update", $article)}}" method="POST" enctype="multipart/form-data" id="articleForm">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="operaName" class="form-label">Name:</label>
            <input
                type="text"
                class="form-control"
                name="operaName"
                id="operaName"
                value="{{$article->operaName}}"/>
        </div>

        <div class="mb-3">
            <label for="operaDescription" class="form-label">Description:</label>
            <textarea class="form-control" name="operaDescription" id="operaDescription" rows="3">{{old("operaDescription") ?? $article->operaDescription}}</textarea>
        </div>
        
        <div class="mb-3">
            <label for="operaYear" class="form-label">Year:</label>
            <input
                type="text"
                class="form-control"
                name="operaYear"
                id="operaYear"
                value="{{$article->operaYear}}"/>
        </div>

        <div class="mb-3">
            <label for="operaMaterial" class="form-label">Materials:</label>
            <input type="text" class="form-control" name="operaMaterial" id="operaMaterial" rows="3" maxlength="255" value="{{$article->operaMaterial}}"/>
        </div>


        <div class="mb-3">
            <div class="mb-3">
                <label for="operaPicture" class="form-label">Main image:</label>
                <input
                    type="file"
                    class="form-control"
                    name="operaPicture"
                    id="operaPicture"
                />
            </div>
            @if ($article->operaPicture)
                <div class="my-3">
                    <label for="old_operaPicture" class="form-label">Actual picture:</label>
                    <div class="row">
                        <div class="col-12">
                            <img src="{{ asset('/storage/' . $article->operaPicture) }}" class="img-fluid" alt="{{ $article->operaName }}" id="old_operaPicture" width="150"  />
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center mt-2"> No pictures selected</div>
            @endif
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
                        {{$item->artist_id == old("artist_id") ? "selected" : ""}}
                        >{{$item->artistName}}</option>
                @endforeach
                
            </select>
        </div>

        <div class="row mt-4" id="moreImagesContainer">
            <div class="mb-3">
                <label for="operaMaterial" class="form-label">Other images: (select all of them again, in order)</label>
                <input type="file" class="form-control" name="images[]" multiple/>
            </div>

            


            <span>Now assigned: </span>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="yes" id="deleteAll" name="deleteAll"/>
                <label class="form-check-label" for="deleteAll"> Delete All</label>
            </div>
            @foreach ($more_images as $index => $image)
                <div class="col-12 col-sm-10 col-lg-6 col-xxl-4 mb-4 text-center mx-auto" id="image-container-{{ $index }}">
                    <div class="position-relative">
                        <div class="rounded overflow-hidden position-relative">
                            @if (Str::startsWith($image->singlePicture, 'https'))
                                <img id="selectedImage{{ $index }}" src="{{ $image->singlePicture }}"
                                    alt="{{ $image->category }}" class="img-fluid object-fit-center more-images-display rounded "
                                    style="max-width: fit-content; max-height:300px;">
                            @else
                                <img id="selectedImage{{ $index }}"
                                    src="{{ asset('/storage/' . $image->singlePicture) }}" alt="{{ $image->category }}"
                                    class="img-fluid rounded" style="max-width: fit-content; max-height:300px;">
                            @endif
                            {{-- <div class="btn btn-outline-danger position-absolute top-0 end-0"
                            onclick="removeElement('image-container-{{ $index }}')">
                            &cross;
                            </div> --}}
                        </div>
                        {{-- <div class="position-absolute top-50 start-50 translate-middle">
                            <div data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-rounded d-none">
                                <label class="form-label text-white m-1"
                                    for="customFile{{ $index }}">+</label>
                                <input type="file" name="images[]" class="form-control d-none"
                                    id="customFile{{ $index }}" value="{{$image->singlePicture}}" 
                                    onchange="displaySelectedImage(event, 'selectedImage{{ $index }}')" />
                            </div>
                            @error('images[]')
                                <div class="alert alert-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>                          --}}
                    </div>
                </div>
            @endforeach


            {{-- <div class="col-12 col-sm-10 col-lg-6 col-xxl-4 mb-4 text-center mx-auto" id="image-container-{{ $more_images->count() }}">
                <input type="hidden" name="image_id[]" id="none_id_{{ $more_images->count() }}"
                    value="">
                <div class="position-relative">
                    <div class="rounded overflow-hidden position-relative">
                        <img id="selectedImage{{ $more_images->count() }}"
                            src="{{ Vite::asset('resources/asset/add-img.jpg') }}"
                            alt="example placeholder" class="img-fluid object-fit-cover"
                            style="max-width:fit-content; max-height: 300px" />       

                        <div class="btn btn-outline-danger position-absolute top-0 end-0 d-none"
                            onclick="removeElement('image-container-{{ $more_images->count() }}')">
                            &cross;
                        </div>
                    </div>

                    <div class="position-absolute top-50 start-50 translate-middle">
                        <div class="btn btn-primary btn-rounded">
                            <label class=" form-label text-white m-1"
                                for="customFile{{ $more_images->count() }}">+</label>
                            <input type="file" name="images[]" class="form-control d-none"
                                id="customFile{{ $more_images->count() }}"
                                onchange="displaySelectedImage(event, 'selectedImage{{ $more_images->count() }}')" />
                        </div>
                        @error('images[]')
                            <div class="alert alert-danger mt-1">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>
            </div> --}}
        </div>

        <span>Visible: </span>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="show" value="yes" {{ $article->show == "yes" ? 'checked' : '' }}>
            <label class="form-check-label" for="show1">
              Yes
            </label>
        </div>
        <div class="form-check mb-5">
            <input class="form-check-input" type="radio" name="show" value="no" {{ $article->show == "no" ? 'checked' : '' }}>
            <label class="form-check-label" for="show2">
              No
            </label>
        </div>
        
    
        <button
            type="submit"
            class="btn btn-primary mb-5 "
        >
            Edit
        </button>
    </form>

</div>


<script>

    let imageCounter = {{ $more_images->count() + 1 }} || 0;

    function removeElement(elementId) {
        var elementToRemove = document.getElementById(elementId);
        if (!elementToRemove) return; // Exit if the element does not exist

        var fileInput = elementToRemove.querySelector('input[type="file"]');
        var selectElement = elementToRemove.querySelector('select');

        elementToRemove.parentNode.removeChild(elementToRemove);
    }

    const dataTransfer = new DataTransfer();
    dataTransfer.items.add(myFile);
    fileInput.files = dataTransfer.files;

    document.addEventListener('DOMContentLoaded', function() {

        

        window.displaySelectedImage = function(event, elementId) {
            const selectedImage = document.getElementById(elementId);
            const uniqueId = 'image-input-' + imageCounter; // ID univoco per il contenitore

            const fileInput = event.target;
            const reader = new FileReader();

            reader.onload = function(e) {
                if (selectedImage) {
                    selectedImage.src = e.target.result;    
                } else {
                    console.error('Element not found:', elementId);
                }
            };

            if (fileInput.files && fileInput.files[0]) {
                reader.readAsDataURL(fileInput.files[0]);
            }

            

            const parentDiv = selectedImage.closest('.col-12');
            const imageIdInput = parentDiv.querySelector('input[name="image_id[]"]');


            if (selectedImage.src.startsWith('data:') || selectedImage.src.startsWith(
                    'http://127.0.0.1:8000/storage')) {

                return

            } else {

                imageIdInput.value = "none";

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
                        <input type="hidden" name="image_id[]" id="none_id_${currentImageCounter}" value="">
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
                            &cross;
                        </div>
                    </div>`;

                parentElement.appendChild(childElement);



                // Incrementa la variabile globale per il prossimo ID
                imageCounter++;
            }
        };

        document.getElementById('articleForm').addEventListener('change', function(event) {
                if (event.target.name === 'images[]') {
                    const input = event.target;
                    const hasImage = input.files.length > 0;
                    const parentDiv = input.closest('.col-12');

                    // Utilizzare l'ID univoco per selezionare il bottone
                    var deleteButton = parentDiv.querySelector('.btn-outline-danger');

                    if (hasImage) {
                        deleteButton.classList.remove('d-none')
                    }
                }
            });
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
