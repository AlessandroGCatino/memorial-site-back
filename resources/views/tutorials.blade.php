@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="fs-4 text-secondary my-4">
        {{ __('Tutorials') }}
    </h2>
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">{{ __('Select the question') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                              What are the "Sections"?
                            </button>
                          </h2>
                          <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                              <strong>Sections</strong> are the macrogroups of the website. You can find them on the left side/first column. "Exhibitions" are linked to a single Section and the user can see them once clicked on the name of the section.
                            </div>
                          </div>
                        </div>
                        <div class="accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                              What are the "Exhibitions"?
                            </button>
                          </h2>
                          <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                              <strong>Exhibitions</strong> are a subgroup of the website that gathers the artists and their operas. You can find them on the left side/first column. Exhibitions are linked to a single section and the user can see them once clicked on the name of the Section.
                            </div>
                          </div>
                        </div>
                        <div class="accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                              What are the "Artists"?
                            </button>
                          </h2>
                          <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                              <strong>Artists</strong> are linked to a single Exhibition. We use this part to insert all datas related to a single artist. This datas will be shown on the right/last column before the informations of the operas.
                            </div>
                          </div>
                        </div>
                        <div class="accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                              What are the "Articles"?
                            </button>
                          </h2>
                          <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                              <strong>Articles</strong> are linked to a single Artist. Articles and their informations are shown in the middle and the right part of the website. The <strong>main picture</strong> is the image that will be displayed in the middle column and the big image that will be displayed in the right column after the Artist info.
                            </div>
                          </div>
                        </div>
                        <div class="accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                              What about "OPEN CALLS"?
                            </button>
                          </h2>
                          <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                              Open Calls are a special part of this website. There is a Section called OPEN CALL, which must remain "unpublished" so that it will not be shown in the main page list. This Section contains all past and present Open Calls. There is also an Exhibition called Open Calls, and even an artist.
                              To insert a new Open Call you must create a new <strong>Article</strong> and link it with the Open Call Artist.
                              To make visible an Open Call you only have to Publish the Article. The latest Open Call will be visible on the main page of the Website.
                              If there's no Open Call published, the website will show "No open call available! Stay tuned on our socials for more info." in the tab.
                            </div>
                          </div>
                        </div>
                        <div class="accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                              So what steps do i need to follow to create a new Article(Opera)?
                            </button>
                          </h2>
                          <div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                              <figure class="text-center">
                                <img src="{{ Vite::asset('resources/asset/FlowchartCreateMemoGes.png') }}" alt="">
                              </figure>
                            </div>
                          </div>
                        </div>
                      </div>
                </div>
            </div>
        </div>
        <div class="p-4">
            <a href="" class="btn btn-warning">Tutorials</a>
        </div>
    </div>
</div>
@endsection
