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
                            <h2>Project Form </h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                        aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#">Settings 1</a>
                                        <a class="dropdown-item" href="#">Settings 2</a>
                                    </div>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br />
                            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"
                                action="{{ route('project.store') }}" enctype="multipart/form-data" method="post">

                                @csrf
                                <label class="control-label col-md-3 col-sm-3 ">Select Client</label>
                                <div class="center-horizontal">
                                    <div class="form-group row">

                                        <div class="col-md-9 col-sm-9 ">
                                            <select class="form-control" id="client" name="client_id">
                                                <option value="">Select Existing Client</option>
                                                @foreach ($clients as $client)
                                                    <option value="{{ $client->id }}">
                                                        {{ $client->full_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <br>

                                <label class="control-label col-md-3 col-sm-3 ">
                                    <h5>Or Add New Client!!!</h5>
                                </label>
                                <div class="center-horizontal">


                                    <div class="form-group row">
                                        <label for="new_client_name">English Title</label>
                                        <input type="text" class="form-control" id="new_client_name" name="c_en_title">
                                        <label for="new_client_name">Dutch Title</label>
                                        <input type="text" class="form-control" id="new_client_name8" name="c_nl_title">
                                        <label for="new_client_name">English Sub Title</label>
                                        <input type="text" class="form-control" id="new_client_name7"
                                            name="c_en_sub_title">
                                        <label for="new_client_name">Dutch Sub Title</label>
                                        <input type="text" class="form-control" id="new_client_name6"
                                            name="c_nl_sub_title">
                                        <label for="new_client_name">Full Name</label>
                                        <input type="text" class="form-control" id="new_client_name5" name="full_name">
                                        <label for="new_client_name2">Position</label>
                                        <input type="text" class="form-control" id="new_client_name2" name="position">
                                        <label for="new_client_name3">Email</label>
                                        <input type="text" class="form-control" id="new_client_name3" name="email">
                                        <label for="new_client_name4">Phone Number</label>
                                        <input type="text" class="form-control" id="new_client_name4"
                                            name="phone_number">
                                    </div>
                                </div>

                                <h1 style="color: black; ">Project Information</h1>
                                <br>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Project
                                        Title
                                        in English <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="name" required="required" class="form-control  "
                                            name="en_title">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Project
                                        Title
                                        in Dutch <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="name" required="required" class="form-control  "
                                            name="nl_title">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Project
                                        ٍSub Title
                                        in English <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="name" required="required" class="form-control  "
                                            name="en_sub_title">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Project
                                        Sub
                                        Title
                                        in Dutch <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="name" required="required" class="form-control  "
                                            name="nl_sub_title">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align"
                                        for="description">Description in
                                        English
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="description" required="required" class="form-control "
                                            name="en_description">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align"
                                        for="description">Description in
                                        Dutch
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="description" required="required" class="form-control "
                                            name="nl_description">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="description">Link
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="description" required="required" class="form-control "
                                            name="link">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="description">Duration
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="description" required="required" class="form-control "
                                            name="duration">
                                    </div>
                                </div>



                                <div class="center-horizontal">
                                    <h2 class="StepTitle">More Details For Project</h2>
                                    <div class="form-group row">
                                        <div id="project_details">
                                            <div class="project_detail">
                                                <label for="project_details[0][en_step]">English Name:</label>
                                                <input type="text" id="project_details[0][en_name]"
                                                    name="project_details[0][en_step]" class="form-control  "><br>

                                                <label for="project_details[0][nl_step]">Dutch Name:</label>
                                                <input type="text" id="project_details[0][nl_step]"
                                                    name="project_details[0][nl_step]" class="form-control  "><br>

                                                <br>

                                                <button type="button" class="btn btn-danger" class="delete-detail">Delete
                                                    Detail </button>
                                            </div>
                                            <br>
                                        </div>



                                    </div>


                                    <button type="button" class="btn btn-secondary" id="add-more-details">Add More Details</button>
                                </div>



                                <div class="center-horizontal">
                                    <div class="clearfix"></div>
                                    <div class="form-group row">
                                        <label for="image">
                                            <h3 style="color: black;">Project Main Image </h3>
                                        </label>
                                        <input type="file" name="main_image" accept="image/*">
                                    </div>
                                    <br>
                                    <div class="clearfix"></div>
                                    <div class="form-group row">
                                        <label for="image">
                                            <h3 style="color: black;">Project Images</h3>
                                        </label>
                                        <input type="file" name="image_path[]" accept="image/*" multiple>
                                    </div>
                                </div>
                                <div class="center-horizontal">
                                    <label for="image">
                                        <h3 style="color: black;">Project Services</h3>
                                    </label>
                                    <div class="form-group row">
                                        <label class="control-label col-md-3 col-sm-3 ">Select Project Services</label>
                                        <div class="col-md-9 col-sm-9 ">
                                            <select class="select2_multiple form-control" name="service_ids[]"
                                                multiple="multiple">
                                                @foreach ($services as $service)
                                                    <option value="{{ $service->id }}">{{ $service->en_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="clearfix"></div>
                                <br>
                                <br>

                                <h2 class="StepTitle" style="color: black;">Project Achievements </h2>
                                <div class="center-horizontal">


                                    <div class="form-group row">
                                        <div id="achievementss-container">
                                            <h4 style="color: black;">Achievements</h4>

                                            <div class="result-block">
                                                <div class="form-group">
                                                    <label for="result_name">En Title</label>
                                                    <input type="text" name="achievements[0][en_title]"
                                                        class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="result_name">Nl Title</label>
                                                    <input type="text" name="achievements[0][nl_title]"
                                                        class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="result_name">En Sub Title</label>
                                                    <input type="text" name="achievements[0][en_sub_title]"
                                                        class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="result_name">Nl Sub Title</label>
                                                    <input type="text" name="achievements[0][nl_sub_title]"
                                                        class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="result_name">En Description</label>
                                                    <input type="text" name="achievements[0][en_description]"
                                                        class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="result_name">Nl Description</label>
                                                    <input type="text" name="achievements[0][nl_description]"
                                                        class="form-control">
                                                </div>

                                                <div id="achievements-container">
                                                    <h4>Achievement Details</h4>

                                                    <div class="a_detail-block">
                                                        <div class="form-group">
                                                            <label for="detail_name">Detail English Name</label>
                                                            <input type="text"
                                                                name="achievements[0][achievement_details][0][en_step]"
                                                                class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="detail_name">Detail Dutch Name</label>
                                                            <input type="text"
                                                                name="achievements[0][achievement_details][0][nl_step]"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                </div>

                                                <button type="button" class="btn btn-secondary" id="add-a-detail">Add
                                                    Detail</button>

                                            </div>
                                        </div>


                                    </div>





                                    <!--<button type="button" id="add-more-details">Add More Details</button>-->
                                </div>

                                <br>
                                <h2 class="StepTitle" style="color: black;">Project Challenges </h2>
                                <div class="center-horizontal">
                                    <div class="form-group row">
                                        <div id="achievementss-container">
                                            <h4 style="color: black;">Challenges</h4>

                                            <div class="result-block">
                                                <div class="form-group">
                                                    <label for="result_name">En Title</label>
                                                    <input type="text" name="challenges[0][en_title]"
                                                        class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="result_name">Nl Title</label>
                                                    <input type="text" name="challenges[0][nl_title]"
                                                        class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="result_name">En Sub Title</label>
                                                    <input type="text" name="challenges[0][en_sub_title]"
                                                        class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="result_name">Nl Sub Title</label>
                                                    <input type="text" name="challenges[0][nl_sub_title]"
                                                        class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="result_name">En Description</label>
                                                    <input type="text" name="challenges[0][en_description]"
                                                        class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="result_name">Nl Description</label>
                                                    <input type="text" name="challenges[0][nl_description]"
                                                        class="form-control">
                                                </div>

                                                <div id="challenges-container">
                                                    <h4>Challenge Details</h4>

                                                    <div class="c_detail-block">
                                                        <div class="form-group">
                                                            <label for="detail_name">Detail English Name</label>
                                                            <input type="text"
                                                                name="challenges[0][challenges_details][0][en_step]"
                                                                class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="detail_name">Detail Dutch Name</label>
                                                            <input type="text"
                                                                name="challenges[0][challenges_details][0][nl_step]"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                </div>

                                                <button type="button" class="btn btn-secondary" id="add-c-detail">Add
                                                    Detail</button>

                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <h2 class="StepTitle" style="color: black;">Project Results </h2>
                                <div class="center-horizontal">

                                    <div class="form-group row">
                                        <div id="result-container">
                                            <h4 style="color: black;">Results</h4>

                                            <div class="result-block">
                                                <div class="form-group">
                                                    <label for="result_name">En Title</label>
                                                    <input type="text" name="results[0][en_title]"
                                                        class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label for="result_name">Nl Title</label>
                                                    <input type="text" name="results[0][nl_title]"
                                                        class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="result_name">En Sub Title</label>
                                                    <input type="text" name="results[0][en_sub_title]"
                                                        class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="result_name">Nl Sub Title</label>
                                                    <input type="text" name="results[0][nl_sub_title]"
                                                        class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="result_name">En Description</label>
                                                    <input type="text" name="results[0][en_description]"
                                                        class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="result_name">Nl Description</label>
                                                    <input type="text" name="results[0][nl_description]"
                                                        class="form-control">
                                                </div>

                                                <div id="details-container">
                                                    <h4 style="color: black;">Result Details</h4>

                                                    <div class="detail-block">
                                                        <div class="form-group">
                                                            <label for="detail_name">Detail English Name</label>
                                                            <input type="text"
                                                                name="results[0][result_details][0][en_step]"
                                                                class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="detail_name">Detail Dutch Name</label>
                                                            <input type="text"
                                                                name="results[0][result_details][0][nl_step]"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                </div>

                                                <button type="button" class="btn btn-secondary" id="add-detail">Add
                                                    Detail</button>

                                            </div>
                                        </div>
                                    </div>

                                </div>




                                <h2 class="StepTitle" style="color: black;">Client Review </h2>
                                <div class="center-horizontal">
                                    <h2 class="StepTitle">Client Review</h2>
                                    <div class="form-group">
                                        <label for="result_name">En Title</label>
                                        <input type="text" name="r_en_title" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="result_name">Nl Title</label>
                                        <input type="text" name="r_nl_title" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="result_name">En Sub Title</label>
                                        <input type="text" name="r_en_sub_title" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="result_name">Nl Sub Title</label>
                                        <input type="text" name="r_nl_sub_title" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="result_name">En Review</label>
                                        <input type="text" name="en_review" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="result_name">Nl Review</label>
                                        <input type="text" name="nl_review" class="form-control">
                                    </div>
                                    <div class="form-group row">
                                        <label for="image">Client Image</label>
                                        <input type="file" name="image_src" accept="image/*">
                                    </div>
                                </div>


                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-9 col-sm-9  offset-md-3">
                                        <button type="button" class="btn btn-primary">Cancel</button>
                                        <button type="reset" class="btn btn-primary">Reset</button>
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>

    <style>
        .center-horizontal {
            width: 50%;
            /* or any width */
            margin: 0 auto;
            /* Automatically adjust left and right margins */
            text-align: center;
            /* Optional: Center text inside the div */
        }
    </style>



    <script>
        ////////////////////////Results
        let detailIndex = 1;
        document.getElementById('add-detail').addEventListener('click', function() {
            let detailsContainer = document.getElementById('details-container');
            let newDetailBlock = document.querySelector('.detail-block').cloneNode(true);

            newDetailBlock.querySelectorAll('input').forEach(input => {
                input.name = input.name.replace(/\[0\]\[result_details\]\[0\]/, '[0][result_details][' +
                    detailIndex + ']');
                input.value = '';
            });

            detailsContainer.appendChild(newDetailBlock);

            detailIndex++;
        });
        ///////////////////////////////////////Achivement
        let detailIndex1 = 1;
        document.getElementById('add-c-detail').addEventListener('click', function() {
            let detailsContainer = document.getElementById('challenges-container');
            let newDetailBlock = document.querySelector('.c_detail-block').cloneNode(true);

            newDetailBlock.querySelectorAll('input').forEach(input => {
                input.name = input.name.replace(/\[0\]\[challenges_details\]\[0\]/,
                    '[0][challenges_details][' + detailIndex1 + ']');
                input.value = '';
            });

            detailsContainer.appendChild(newDetailBlock);

            detailIndex1++;
        });


        let detailIndex2 = 1;
        document.getElementById('add-a-detail').addEventListener('click', function() {
            let detailsContainer = document.getElementById('achievements-container');
            let newDetailBlock = document.querySelector('.a_detail-block').cloneNode(true);

            newDetailBlock.querySelectorAll('input').forEach(input => {
                input.name = input.name.replace(/\[0\]\[achievement_details\]\[0\]/,
                    '[0][achievement_details][' + detailIndex2 + ']');
                input.value = '';
            });

            detailsContainer.appendChild(newDetailBlock);

            detailIndex2++;
        });


        ///////////////////////////////////
        document.getElementById('add-more-details').addEventListener('click', function() {
            var achievementsDiv = document.getElementById('project_details');
            var index = achievementsDiv.children.length - 1;

            var newachievement = document.createElement('div');
            newachievement.className = 'project_detail';

            newachievement.innerHTML = `
    <h6>Detail ${index+1} </h6>
        <label for="project_details[${index}][en_step]">English Name:</label>
        <input type="text" id="achievements[${index}][en_achievement_name]" name="project_details[${index}][en_step]"  class="form-control  "><br>

        <label for="achievements[${index}][nl_achievement_name]">Dutch Name:</label>
        <input type="text" id="achievements[${index}][nl_achievement_name]" name="project_details[${index}][nl_step]"  class="form-control  "><br>

        <button type="button" class="delete-detail">Delete Detail</button>
    `;

            achievementsDiv.appendChild(newachievement);
        });
        document.addEventListener('click', function(event) {
            if (event.target && event.target.classList.contains('delete-detail')) {
                event.target.closest('.project_detail').remove();
            }
        });










        /////////
        ////////////////

        document.addEventListener('click', function(event) {
            if (event.target && event.target.classList.contains('delete-achievement')) {
                event.target.closest('.achievement').remove();
            }
        });



        ////////////////////
        document.addEventListener('DOMContentLoaded', function() {
            const clientSelect = document.getElementById('client');
            const newClientInput = document.getElementById('new_client_name');
            const newClientInput2 = document.getElementById('new_client_name2');
            const newClientInput3 = document.getElementById('new_client_name3');
            const newClientInput4 = document.getElementById('new_client_name4');
            const newClientInput5 = document.getElementById('new_client_name5');
            const newClientInput6 = document.getElementById('new_client_name6');
            const newClientInput7 = document.getElementById('new_client_name7');
            const newClientInput8 = document.getElementById('new_client_name8');

            clientSelect.addEventListener('change', function() {
                if (clientSelect.value) {
                    newClientInput.disabled = true;
                    newClientInput.value = '';
                    newClientInput2.disabled = true;
                    newClientInput2.value = '';
                    newClientInput3.disabled = true;
                    newClientInput3.value = '';
                    newClientInput4.disabled = true;
                    newClientInput4.value = '';
                    newClientInput5.disabled = true;
                    newClientInput5.value = '';
                    newClientInput6.disabled = true;
                    newClientInput6.value = '';
                    newClientInput7.disabled = true;
                    newClientInput7.value = '';
                    newClientInput8.disabled = true;
                    newClientInput8.value = '';
                } else {
                    newClientInput.disabled = false;
                    newClientInput2.disabled = false;
                    newClientInput3.disabled = false;
                    newClientInput4.disabled = false;
                    newClientInput5.disabled = false;
                    newClientInput6.disabled = false;
                    newClientInput7.disabled = false;
                    newClientInput8.disabled = false;
                }
            });

            newClientInput.addEventListener('input', function() {
                if (newClientInput.value) {
                    clientSelect.disabled = true;
                    clientSelect.value = '';
                } else {
                    clientSelect.disabled = false;
                }
            });
        });
    </script>
@endsection
