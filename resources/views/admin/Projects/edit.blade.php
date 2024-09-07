@extends('layouts.app')


@section('content')
    <div class="" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Project Form</h3>
                </div>

                <div class="title_right">

                </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Pleas Fill This Form<small></small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                        aria-haspopup="true" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a class="dropdown-item" href="#">Settings 1</a>
                                        </li>
                                        <li><a class="dropdown-item" href="#">Settings 2</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br />
                            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"
                                action="{{ route('project.update', $project['id']) }}" enctype="multipart/form-data"
                                method="post">
                                @csrf


                                <label for="">Client</label><br>
                                <input type="hidden" value="{{ $client[0]['id'] }}" name="client_id">
                                <div class="form-group row">

                                    <label for="new_client_name">English Title</label>
                                    <input type="text" class="form-control" id="new_client_name" name="c_en_title"
                                        value="{{ $client[0]['en_title'] }}" readonly>
                                    <label for="new_client_name">Dutch Title</label>
                                    <input type="text" class="form-control" id="new_client_name8" name="c_nl_title"
                                        value="{{ $client[0]['nl_title'] }}" readonly>
                                    <label for="new_client_name">English Sub Title</label>
                                    <input type="text" class="form-control" id="new_client_name7" name="c_en_sub_title"
                                        value="{{ $client[0]['en_sub_title'] }}" readonly>
                                    <label for="new_client_name">Dutch Sub Title</label>
                                    <input type="text" class="form-control" id="new_client_name6" name="c_nl_sub_title"
                                        value="{{ $client[0]['nl_sub_title'] }}" readonly>
                                    <label for="new_client_name">First Name</label>
                                    <input type="text" class="form-control" id="new_client_name5" name="full_name"
                                        value="{{ $client[0]['full_name'] }}" readonly>
                                    <label for="new_client_name2">Position</label>
                                    <input type="text" class="form-control" id="new_client_name2" name="position"
                                        value="{{ $client[0]['position'] }}" readonly>
                                    <label for="new_client_name3">Email</label>
                                    <input type="text" class="form-control" id="new_client_name3" name="email"
                                        value="{{ $client[0]['email'] }}" readonly>
                                    <label for="new_client_name4">Phone Number</label>
                                    <input type="text" class="form-control" id="new_client_name4" name="phone_number"
                                        value="{{ $client[0]['phone_number'] }}" readonly>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Project Title
                                        in English <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="name" required="required" class="form-control  "
                                            name="en_title" value="{{ $project['en_title'] }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Project
                                        Title
                                        in Dutch <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="name" required="required" class="form-control  "
                                            name="nl_title" value="{{ $project['nl_title'] }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Project
                                        ٍSub Title
                                        in English <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="name" required="required" class="form-control  "
                                            name="en_sub_title" value="{{ $project['en_sub_title'] }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Project Sub
                                        Title
                                        in Dutch <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="name" required="required" class="form-control  "
                                            name="nl_sub_title" value="{{ $project['nl_sub_title'] }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align"
                                        for="description">Description in English
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="description" required="required" class="form-control "
                                            name="en_description" value="{{ $project['en_description'] }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align"
                                        for="description">Description in Dutch
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="description" required="required" class="form-control "
                                            name="nl_description" value="{{ $project['nl_description'] }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="description">Link
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="description" required="required" class="form-control "
                                            name="link" value="{{ $project['link'] }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="description">Duration
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="description" required="required" class="form-control "
                                            name="duration" value="{{ $project['duration'] }}">
                                    </div>
                                </div>

                                <br>
                                <div class="form-group">
                                    <label for="main_image">Main Image</label>
                                    <input type="file" name="main_image" class="form-control-file" id="main_image">
                                </div>
                                <div class="clearfix"></div>

                                @if ($project->main_image)
                                    <div class="form-group">
                                        <label>Current Main Image:</label>
                                        <img src="{{ Storage::url($project->main_image) }}" alt="Main Image"
                                            style="max-width: 200px;">
                                    </div>
                                @endif
                                <div class="clearfix"></div>
                                <h4>Project Details</h4>
                                <div id="project-details-container">
                                    @foreach ($project->project_details as $index => $detail)
                                        <div class="project-detail-block">
                                            <input type="hidden" name="project_details[{{ $index }}][id]"
                                                value="{{ $detail->id }}">

                                            <div class="form-group">
                                                <label for="en_step">EN Step</label>
                                                <input type="text"
                                                    name="project_details[{{ $index }}][en_step]"
                                                    class="form-control" value="{{ $detail->en_step }}" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="nl_step">NL Step</label>
                                                <input type="text"
                                                    name="project_details[{{ $index }}][nl_step]"
                                                    class="form-control" value="{{ $detail->nl_step }}" required>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Add New Detail Button -->
                                <button type="button" id="add-project-detail" class="btn btn-primary">Add Project
                                    Detail</button>
                                <h4>Images</h4>
                                <div class="existing-images">
                                    @foreach ($project->project_images as $image)
                                        <div class="image-container" id="image-{{ $image->id }}">
                                            <img src="{{ Storage::url($image['image_path']) }}" alt="Project Image"
                                                style="width: 100px; height: 100px;">
                                            <button type="button" class="btn btn-danger remove-image"
                                                data-id="{{ $image->id }}">Remove</button>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="clearfix"></div>
                                <h4>Add New Images</h4>
                                <div class="new-images">
                                    <input type="file" name="image_path[]" multiple>
                                </div>

                                <h2>Select The Services </h2>
                                @foreach ($services as $service)
                                    <div>
                                        <label>
                                            <input type="checkbox" name="service_ids[]" value="{{ $service->id }}"
                                            @if(in_array($service->en_name, $selectedServices)) checked @endif>
                                            {{ $service->en_name }}
                                        </label>
                                    </div>
                                @endforeach
                                <br>
                                <h2 class="StepTitle">Achievements</h2>


                                <div class="form-group">
                                    <label for="result_name">Achievement En Title</label>
                                    <input type="text" name="achievements[0][en_title]" class="form-control"
                                        id="result_name" value="{{ $project->achievements->first()->en_title }}"
                                        >
                                </div>
                                <div class="form-group">
                                    <label for="result_name">Achievement Nl Title</label>
                                    <input type="text" name="achievements[0][nl_title]" class="form-control"
                                        id="result_name" value="{{ $project->achievements->first()->nl_title }}"
                                        >
                                </div>
                                <div class="form-group">
                                    <label for="result_name">Achievement En Sub Title</label>
                                    <input type="text" name="achievements[0][en_sub_title]" class="form-control"
                                        id="result_name" value="{{ $project->achievements->first()->en_sub_title }}"
                                    >
                                </div>
                                <div class="form-group">
                                    <label for="result_name">Achievement Nl Sub Title</label>
                                    <input type="text" name="achievements[0][en_sub_title]" class="form-control"
                                        id="result_name" value="{{ $project->achievements->first()->en_sub_title }}"
                                        >
                                </div>
                                <div class="form-group">
                                    <label for="result_name">Achievement en Description</label>
                                    <input type="text" name="achievements[0][en_description]" class="form-control"
                                        id="result_name" value="{{ $project->achievements->first()->en_description }}"
                                        >
                                </div>
                                <div class="form-group">
                                    <label for="result_name">Achievement Nl Description</label>
                                    <input type="text" name="achievements[0][nl_description]" class="form-control"
                                        id="result_name" value="{{ $project->achievements->first()->nl_description }}"
                                        >
                                </div>

                                <div id="achievements-container">
                                    <h4>Achievements Details</h4>
                                    @foreach ($project->achievements->first()->achievement_details as $index => $detail)
                                        <div class="detail1-block" data-index="{{ $index }}">
                                            <input type="hidden"
                                                name="achievements[0][achievement_details][{{ $index }}][id]"
                                                value="{{ $detail->id }}">

                                            <div class="form-group">
                                                <label for="en_step">Step (English)</label>
                                                <input type="text"
                                                    name="achievements[0][achievement_details][{{ $index }}][en_step]"
                                                    class="form-control" value="{{ $detail->en_step }}" >
                                            </div>

                                            <div class="form-group">
                                                <label for="nl_step">Step (Dutch)</label>
                                                <input type="text"
                                                    name="achievements[0][achievement_details][{{ $index }}][nl_step]"
                                                    class="form-control" value="{{ $detail->nl_step }}" >
                                            </div>

                                            <button type="button" class="btn btn-danger remove-detail1">Remove
                                                Detail</button>
                                        </div>
                                    @endforeach
                                </div>

                                <button type="button" class="btn btn-secondary" id="add-detail1">Add Detail</button>

                                <br>
                                <h2 class="StepTitle">Results</h2>


                                <div class="form-group">
                                    <label for="result_name">Result En Title</label>
                                    <input type="text" name="results[0][en_title]" class="form-control"
                                        id="result_name" value="{{ $project->results->first()->en_title }}">
                                </div>
                                <div class="form-group">
                                    <label for="result_name">Result Nl Title</label>
                                    <input type="text" name="results[0][nl_title]" class="form-control"
                                        id="result_name" value="{{ $project->results->first()->nl_title }}"
                                        >
                                </div>
                                <div class="form-group">
                                    <label for="result_name">Result En Sub Title</label>
                                    <input type="text" name="results[0][en_sub_title]" class="form-control"
                                        id="result_name" value="{{ $project->results->first()->en_sub_title }}"
                                        >
                                </div>
                                <div class="form-group">
                                    <label for="result_name">Result Nl Sub Title</label>
                                    <input type="text" name="results[0][en_sub_title]" class="form-control"
                                        id="result_name" value="{{ $project->results->first()->en_sub_title }}"
                                        >
                                </div>
                                <div class="form-group">
                                    <label for="result_name">Result en Description</label>
                                    <input type="text" name="results[0][en_description]" class="form-control"
                                        id="result_name" value="{{ $project->results->first()->en_description }}"
                                        >
                                </div>
                                <div class="form-group">
                                    <label for="result_name">Result Nl Description</label>
                                    <input type="text" name="results[0][nl_description]" class="form-control"
                                        id="result_name" value="{{ $project->results->first()->nl_description }}"
                                        >
                                </div>

                                <div id="details-container">
                                    <h4>Result Details</h4>
                                    @foreach ($project->results->first()->result_details as $index => $detail)
                                        <div class="detail-block" data-index="{{ $index }}">
                                            <input type="hidden"
                                                name="results[0][result_details][{{ $index }}][id]"
                                                value="{{ $detail->id }}">

                                            <div class="form-group">
                                                <label for="en_step">Step (English)</label>
                                                <input type="text"
                                                    name="results[0][result_details][{{ $index }}][en_step]"
                                                    class="form-control" value="{{ $detail->en_step }}" >
                                            </div>

                                            <div class="form-group">
                                                <label for="nl_step">Step (Dutch)</label>
                                                <input type="text"
                                                    name="results[0][result_details][{{ $index }}][nl_step]"
                                                    class="form-control" value="{{ $detail->nl_step }}" >
                                            </div>

                                            <button type="button" class="btn btn-danger remove-detail">Remove
                                                Detail</button>
                                        </div>
                                    @endforeach
                                </div>

                                <button type="button" class="btn btn-secondary" id="add-detail">Add Detail</button>

                                <br>
                                <h2 class="StepTitle">Challenges</h2>
                                <div class="form-group row">

                                    <div class="form-group">
                                        <label for="result_name">Challenges En Title</label>
                                        <input type="text" name="challenges[0][en_title]" class="form-control"
                                            id="result_name" value="{{ $project->challenges->first()->en_title }}"
                                            >
                                    </div>
                                    <div class="form-group">
                                        <label for="result_name">Challenges Nl Title</label>
                                        <input type="text" name="challenges[0][nl_title]" class="form-control"
                                            id="result_name" value="{{ $project->challenges->first()->nl_title }}"
                                            >
                                    </div>
                                    <div class="form-group">
                                        <label for="result_name">Challenges En Sub Title</label>
                                        <input type="text" name="challenges[0][en_sub_title]" class="form-control"
                                            id="result_name" value="{{ $project->challenges->first()->en_sub_title }}"
                                            >
                                    </div>
                                    <div class="form-group">
                                        <label for="result_name">Challenges Nl Sub Title</label>
                                        <input type="text" name="challenges[0][en_sub_title]" class="form-control"
                                            id="result_name" value="{{ $project->challenges->first()->en_sub_title }}"
                                            >
                                    </div>
                                    <div class="form-group">
                                        <label for="result_name">Challenges en Description</label>
                                        <input type="text" name="challenges[0][en_description]" class="form-control"
                                            id="result_name" value="{{ $project->challenges->first()->en_description }}"
                                        >
                                    </div>
                                    <div class="form-group">
                                        <label for="result_name">Challenges Nl Description</label>
                                        <input type="text" name="challenges[0][nl_description]" class="form-control"
                                            id="result_name" value="{{ $project->challenges->first()->nl_description }}"
                                            >
                                    </div>


                                    <div id="challenges-container">
                                        <h4>Challenges Details</h4>
                                        @foreach ($project->challenges->first()->challenges_details as $index => $detail)
                                            <div class="detail2-block" data-index="{{ $index }}">
                                                <input type="hidden"
                                                    name="challenges[0][challenges_details][{{ $index }}][id]"
                                                    value="{{ $detail->id }}">

                                                <div class="form-group">
                                                    <label for="en_step">Step (English)</label>
                                                    <input type="text"
                                                        name="challenges[0][challenges_details][{{ $index }}][en_step]"
                                                        class="form-control" value="{{ $detail->en_step }}" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="nl_step">Step (Dutch)</label>
                                                    <input type="text"
                                                        name="challenges[0][challenges_details][{{ $index }}][nl_step]"
                                                        class="form-control" value="{{ $detail->nl_step }}" required>
                                                </div>

                                                <button type="button" class="btn btn-danger remove-detail2">Remove
                                                    Detail</button>
                                            </div>
                                        @endforeach
                                    </div>

                                    <button type="button" class="btn btn-secondary" id="add-detail2">Add Detail</button>

                                    <br>
                                    <br>
                                    <h2 class="StepTitle">Client Review</h2>
                                    <div class="form-group">
                                        <label for="result_name">En Title</label>
                                        <input type="text" name="r_en_title" class="form-control"
                                            value="{{ $project->client_review['en_title'] }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="result_name">Nl Title</label>
                                        <input type="text" name="r_nl_title" class="form-control"
                                            value="{{ $project->client_review['nl_title'] }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="result_name">En Sub Title</label>
                                        <input type="text" name="r_en_sub_title" class="form-control"
                                            value="{{ $project->client_review['en_sub_title'] }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="result_name">Nl Sub Title</label>
                                        <input type="text" name="r_nl_sub_title" class="form-control"
                                            value="{{ $project->client_review['nl_sub_title'] }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="result_name">En Review</label>
                                        <input type="text" name="en_review" class="form-control"
                                            value="{{ $project->client_review['en_review'] }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="result_name">Nl Review</label>
                                        <input type="text" name="nl_review" class="form-control"
                                            value="{{ $project->client_review['nl_review'] }}">
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label for="main_image">Client Image</label>
                                        <input type="file" name="image_src" class="form-control-file"
                                            id="main_image">
                                    </div>
                                    <div class="clearfix"></div>

                                    @if ($project->client_review['image_src'])
                                        <div class="form-group">
                                            <label>Current Client Image:</label>
                                            <img src="{{ Storage::url($project->client_review['image_src']) }}"
                                                alt="Client Image" style="max-width: 200px;">
                                        </div>
                                    @endif
                                    <div class="clearfix"></div>




                                    <div class="ln_solid"></div>
                                    <div class="item form-group">
                                        <div class="col-md-6 col-sm-6 offset-md-3">
                                            <button class="btn btn-primary" type="button">Cancel</button>
                                            <button class="btn btn-primary" type="reset">Reset</button>
                                            <button type="submit" class="btn btn-success">Submit</button>
                                        </div>
                                    </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        let detailIndex5 = {{ $project->project_details->count() }};
        document.getElementById('add-project-detail').addEventListener('click', function() {
            let container = document.getElementById('project-details-container');
            let newDetail = `
        <div class="project-detail-block">
            <div class="form-group">
                <label for="en_step">EN Step</label>
                <input type="text" name="project_details[${detailIndex5}][en_step]" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="nl_step">NL Step</label>
                <input type="text" name="project_details[${detailIndex5}][nl_step]" class="form-control" required>
            </div>
        </div>
    `;
            container.insertAdjacentHTML('beforeend', newDetail);
            detailIndex5++;
        });


        /////////////////////////////

        let detailIndex1 = {{ $project->achievements->first()->achievement_details->count() }};

        document.getElementById('add-detail1').addEventListener('click', function() {
            let detailsContainer = document.getElementById('achievements-container');
            let newDetailBlock = document.createElement('div');
            newDetailBlock.classList.add('detail1-block');
            newDetailBlock.dataset.index = detailIndex1;

            newDetailBlock.innerHTML = `
        <div class="form-group">
            <label for="en_step">Step (English)</label>
            <input type="text" name="achievements[0][achievement_details][${detailIndex1}][en_step]" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="nl_step">Step (Dutch)</label>
            <input type="text" name="achievements[0][achievement_details][${detailIndex1}][nl_step]" class="form-control" required>
        </div>
        <button type="button" class="btn btn-danger remove-detail1">Remove Detail</button>
    `;

            detailsContainer.appendChild(newDetailBlock);

            detailIndex1++;
        });

        document.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-detail1')) {
                e.target.closest('.detail1-block').remove();
            }
        });



        /////////////////////////Chal
        let detailIndex2 = {{ $project->achievements->first()->achievement_details->count() }};

        document.getElementById('add-detail2').addEventListener('click', function() {
            let detailsContainer = document.getElementById('challenges-container');
            let newDetailBlock = document.createElement('div');
            newDetailBlock.classList.add('detail2-block');
            newDetailBlock.dataset.index = detailIndex1;

            newDetailBlock.innerHTML = `
<div class="form-group">
    <label for="en_step">Step (English)</label>
    <input type="text" name="challenges[0][challenges_details][${detailIndex1}][en_step]" class="form-control" required>
</div>
<div class="form-group">
    <label for="nl_step">Step (Dutch)</label>
    <input type="text" name="challenges[0][challenges_details][${detailIndex1}][nl_step]" class="form-control" required>
</div>
<button type="button" class="btn btn-danger remove-detail2">Remove Detail</button>
`;

            detailsContainer.appendChild(newDetailBlock);

            detailIndex2++;
        });

        document.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-detail2')) {
                e.target.closest('.detail2-block').remove();
            }
        });







        /////////////////////////////Results
        let detailIndex = {{ $project->results->first()->result_details->count() }};

        document.getElementById('add-detail').addEventListener('click', function() {
            let detailsContainer = document.getElementById('details-container');
            let newDetailBlock = document.createElement('div');
            newDetailBlock.classList.add('detail-block');
            newDetailBlock.dataset.index = detailIndex;

            newDetailBlock.innerHTML = `
        <div class="form-group">
            <label for="en_step">Step (English)</label>
            <input type="text" name="results[0][result_details][${detailIndex}][en_step]" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="nl_step">Step (Dutch)</label>
            <input type="text" name="results[0][result_details][${detailIndex}][nl_step]" class="form-control" required>
        </div>
        <button type="button" class="btn btn-danger remove-detail">Remove Detail</button>
    `;

            detailsContainer.appendChild(newDetailBlock);

            detailIndex++;
        });

        document.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-detail')) {
                e.target.closest('.detail-block').remove();
            }
        });








        ///////////////////////////////////////////////////////////




        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.remove-image').forEach(button => {
                button.addEventListener('click', function() {
                    const imageId = this.getAttribute('data-id');
                    const container = document.getElementById('image-' + imageId);

                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'remove_images[]';
                    input.value = imageId;

                    container.appendChild(input);

                    container.style.display = 'none';
                });
            });
        });
    </script>
@endsection
