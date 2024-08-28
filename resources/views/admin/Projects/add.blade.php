@extends('layouts.app')


@section('content')
    <div class="right_col" role="main">
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

                <div class="col-md-12 col-sm-10 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Project <small></small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                        aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">Settings 1</a>
                                        </li>
                                        <li><a href="#">Settings 2</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">


                            <p>Please fill this Form To add New Project
                            </p>
                            <div id="wizard" class="form_wizard wizard_horizontal"><!-- -->
                                <ul class="wizard_steps">
                                    <li>
                                        <a href="#step-1">
                                            <span class="step_no">1</span>
                                            <span class="step_descr">
                                                Step 1<br />
                                                <small>Project and Client</small>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#step-2">
                                            <span class="step_no">2</span>
                                            <span class="step_descr">
                                                Step 2<br />
                                                <small>Achievements</small>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#step-3">
                                            <span class="step_no">3</span>
                                            <span class="step_descr">
                                                Step 3<br />
                                                <small>Challenges</small>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#step-4">
                                            <span class="step_no">4</span>
                                            <span class="step_descr">
                                                Step 4<br />
                                                <small>Project Live Links</small>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#step-5">
                                            <span class="step_no">5</span>
                                            <span class="step_descr">
                                                Step 5<br />
                                                <small>Project Technology</small>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#step-6">
                                            <span class="step_no">6</span>
                                            <span class="step_descr">
                                                Step 6<br />
                                                <small>Images</small>
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                                <div id="step-1" class="col-md-12 col-sm-3 ">
                                    <form class="form-horizontal form-label-left" id="form1"
                                        enctype="multipart/form-data" action="/upload">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="client">Select Client</label>
                                            <select class="form-control" id="client" name="client_id">
                                                <option value="">Select Existing Client</option>
                                                @foreach ($clients as $client)
                                                    <option value="{{ $client->id }}">
                                                        {{ $client->first_name }},{{ $client->last_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <label for="">Or Add New Client</label><br>
                                        <div class="form-group row">

                                            <label for="new_client_name">First Name</label>
                                            <input type="text" class="form-control" id="new_client_name"
                                                name="first_name">
                                            <label for="new_client_name2">Last Name</label>
                                            <input type="text" class="form-control" id="new_client_name2"
                                                name="last_name">
                                            <label for="new_client_name3">Email</label>
                                            <input type="text" class="form-control" id="new_client_name3" name="email">
                                            <label for="new_client_name4">Phone Number</label>
                                            <input type="text" class="form-control" id="new_client_name4"
                                                name="phone_number">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                for="name">Project Title in English <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input type="text" id="name" required="required"
                                                    class="form-control  " name="en_title">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                for="name">Project Title in Dutch <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input type="text" id="name" required="required"
                                                    class="form-control  " name="nl_title">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                for="description">Description in English
                                                <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input type="text" id="description" required="required"
                                                    class="form-control " name="en_description">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                for="description">Description in Dutch
                                                <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input type="text" id="description" required="required"
                                                    class="form-control " name="nl_description">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                for="description">Result in English
                                                <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input type="text" id="description" required="required"
                                                    class="form-control " name="en_result">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                for="description">Result in Dutch
                                                <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input type="text" id="description" required="required"
                                                    class="form-control " name="nl_result">
                                            </div>
                                        </div>
                                        <!--  <div class="form-group row">
                                                                        <label for="image">Project Image</label>
                                                                        <input type="file" name="image_path[]" accept="image/*" multiple required>
                                                                    </div>-->
                                        <div class="form-group " id="date-of-birthday-id">
                                            <label for="birthday_date">Begin Date</label>
                                            <input type="date" name="begin_date" id="birthday_date"
                                                class="form-control" value="">
                                        </div>
                                        <div class="form-group" id="date-of-birthday-id">
                                            <label for="birthday_date">End Date</label>
                                            <input type="date" name="end_date" id="birthday_date"
                                                class="form-control" value="">
                                        </div>
                                        <br>
                                        <h2>Select The Services </h2>
                                        @foreach ($services as $service)
                                            <div>
                                                <label>
                                                    <input type="checkbox" name="service_ids[]"
                                                        value="{{ $service->id }}">
                                                    {{ $service->en_name }}
                                                </label>
                                            </div>
                                        @endforeach


                                    </form>

                                </div>
                                <div id="step-2">
                                    <h2 class="StepTitle">Achievements</h2>
                                    <form class="form-horizontal form-label-left" id="form2">
                                        @csrf
                                        <input type="hidden" name="achievements[]">

                                        <div class="form-group row">
                                            <div id="achievements">
                                                <div class="achievement">
                                                    <label for="achievements[0][en_achievement_name]">English Name:</label>
                                                    <input type="text" id="requirement[0][en_name]"
                                                        name="achievements[0][en_achievement_name]"
                                                        class="form-control  "><br>

                                                    <label for="achievements[0][nl_achievement_name]">Dutch Name:</label>
                                                    <input type="text" id="achievements[0][nl_achievement_name]"
                                                        name="achievements[0][nl_achievement_name]"
                                                        class="form-control  "><br>

                                                    <br>

                                                    <button type="button" class="delete-achievement">Delete
                                                        Achievement </button>
                                                </div>
                                                <br>
                                            </div>


                                        </div>

                                        <button type="button" id="add-more-achievements">Add More Achievements</button>


                                </div>

                                <div id="step-3">
                                    <h2 class="StepTitle">Challenges</h2>
                                    <form class="form-horizontal form-label-left" id="form3">
                                        @csrf
                                        <input type="hidden" name="challenges[]">
                                        <div class="form-group row">

                                            <div id="challenges">
                                                <div class="challenge">
                                                    <label for="challenges[0][en_challenge_name]">English Name:</label>
                                                    <input type="text" id="challenges[0][en_challenge_name]"
                                                        name="challenges[0][en_challenge_name]"
                                                        class="form-control  "><br>

                                                    <label for="challenges[0][nl_challenge_name]">Dutch Name:</label>
                                                    <input type="text" id="challenges[0][nl_challenge_name]"
                                                        name="challenges[0][nl_challenge_name]"
                                                        class="form-control  "><br>
                                                    <br>
                                                    <label for="challenges[0][en_challenge_description]">English
                                                        Description:</label>
                                                    <textarea id="challenges[0][en_challenge_description]" name="challenges[0][en_challenge_description]"
                                                        class="form-control  "></textarea><br>

                                                    <label for="service_benefits[0][nl_challenge_description]">Dutch
                                                        Description:</label>
                                                    <textarea id="challenges[0][nl_challenge_description]" name="challenges[0][nl_challenge_description]"
                                                        class="form-control  "></textarea><br>
                                                    <button type="button" class="delete-challenge">Delete
                                                        Challenge</button>

                                                </div>
                                                <br>
                                            </div>
                                        </div>
                                        <button type="button" id="add-more-challenges">Add More challenges</button>
                                    </form>
                                </div>
                                <div id="step-4">
                                    <h2 class="StepTitle">Project Live Links </h2>
                                    <form class="form-horizontal form-label-left" id="form4">
                                        @csrf
                                        <input type="hidden" name="project_live_links[]">
                                        <div class="form-group row">

                                            <div id="project_live_links">
                                                <div class="project_live_link">
                                                    <label for="project_live_links[0][link]">Link
                                                    </label>
                                                    <input type="text" id="project_live_links[0][link]"
                                                        name="project_live_links[0][link]" class="form-control "><br>


                                                    <button type="button" class="delete-link">Delete
                                                        Link</button>

                                                </div>
                                                <br>
                                            </div>
                                        </div>
                                        <button type="button" id="add-more-links">Add More Links</button>
                                    </form>
                                    <br>

                                </div>

                                <div id="step-5">
                                    <h2 class="StepTitle">Project Technology</h2>
                                    <form class="form-horizontal form-label-left" id="form5">
                                        @csrf
                                        <!--  <input type="hidden" name="project_technologies[]">-->
                                        <div class="form-group row">

                                            <div id="project_technologies">
                                                <div class="project_technology">
                                                    <label for="project_technologies[0][tools]">Link
                                                    </label>
                                                    <input type="text" id="project_technologies[0][tools]"
                                                        name="project_technologies[0][tools]" class="form-control "><br>


                                                    <button type="button" class="delete-tool">Delete
                                                        Tool</button>

                                                </div>
                                                <br>
                                            </div>
                                        </div>
                                        <button type="button" id="add-more-tools">Add More Tools</button>
                                    </form>
                                    <br>


                                </div>
                                <div id="step-6">
                                    <h2 class="StepTitle">Project Live Links And Tools</h2>
                                    <form class="form-horizontal form-label-left" enctype="multipart/form-data"
                                        method="post" action="{{ route('img.store') }}" id="form6">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="image">Project Image</label>
                                            <input type="file" name="image_path[]" accept="image/*" multiple required
                                                id="vvv">
                                        </div>
                                        <button type="submit">Upload</button>
                                    </form>
                                    <br>

                                </div>


                            </div>
                            <button id="submitAllForms" type="button" class="btn btn-primary">Submit </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.getElementById('submitAllForms').addEventListener('click', function() {

            let combinedForm = document.createElement('form');
            combinedForm.method = 'POST';
            combinedForm.action = '{{ route('project.store') }}';

            let csrfToken = document.querySelector('input[name="_token"]').value;
            let csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = csrfToken;
            combinedForm.appendChild(csrfInput);
            //////
            let form6 = document.getElementById('form6');
            //   let form6Data = new FormData(form6);

            // Append each file individually to combinedFormData
            /*   form6Data.getAll('image_path[]').forEach((file, index) => {
                   if (file instanceof File) {
                       console.log("AAAAAAAAAA");
                       combinedForm.appendChild('image_path[]', file);
                   } else {
                       console.log("BBBBBBBBBBBB");
                   }
               });
               //////////************
               let form5 = document.getElementById('form6');
               let fileInput = document.getElementById('vvv');

               if (fileInput.files.length > 0) {
                   // Append each selected file to FormData
                   for (let i = 0; i < fileInput.files.length; i++) {
                       combinedForm.appendChild('image_path[]', fileInput.files[i]);
                   }
               }*/


            ///////////***************

            let forms = [document.getElementById('form1'), document.getElementById('form2'), document
                .getElementById('form3'), document.getElementById('form4'), document.getElementById('form5'),
                //   document.getElementById('form6')
            ];
            forms.forEach(function(form) {
                let elements = form.elements;
                for (let i = 0; i < elements.length; i++) {
                    if (elements[i].name && elements[i].value) {
                        let input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = elements[i].name;
                        input.value = elements[i].value;
                        combinedForm.appendChild(input);
                    }
                }
            });


            document.body.appendChild(combinedForm);
            combinedForm.submit();
        });



        document.getElementById('add-more-achievements').addEventListener('click', function() {
            var achievementsDiv = document.getElementById('achievements');
            var index = achievementsDiv.children.length - 1;

            var newachievement = document.createElement('div');
            newachievement.className = 'achievement';

            newachievement.innerHTML = `
            <h6>Achievement ${index+1} </h6>
                <label for="achievements[${index}][en_achievement_name]">English Name:</label>
                <input type="text" id="achievements[${index}][en_achievement_name]" name="achievements[${index}][en_achievement_name]"  class="form-control  "><br>

                <label for="achievements[${index}][nl_achievement_name]">Dutch Name:</label>
                <input type="text" id="achievements[${index}][nl_achievement_name]" name="achievements[${index}][nl_achievement_name]"  class="form-control  "><br>

                <button type="button" class="delete-achievement">Delete achievement</button>
            `;

            achievementsDiv.appendChild(newachievement);
        });

        document.getElementById('add-more-challenges').addEventListener('click', function() {
            var challengesDiv = document.getElementById('challenges');
            var index = challengesDiv.children.length - 1;

            var newchallenge = document.createElement('div');
            newchallenge.className = 'challenge';

            newchallenge.innerHTML = `
            <h6>Challenges ${index+1} </h6>
                <label for="challenges[${index}][en_challenge_name]">English Name:</label>
                <input type="text" id="challenges[${index}][en_challenge_name]" name="challenges[${index}][en_challenge_name]"  class="form-control  "><br>

                <label for="challenges[${index}][nl_challenge_name]">Dutch Name:</label>
                <input type="text" id="challenges[${index}][nl_challenge_name]" name="challenges[${index}][nl_challenge_name]"  class="form-control  "><br>

                <label for="challenges[${index}][en_challenge_description]">English Description:</label>
                <textarea id="challenges[${index}][en_challenge_description]" name="challenges[${index}][en_challenge_description]"  class="form-control  "></textarea><br>

                <label for="challenges[${index}][nl_challenge_description]">Dutch Description:</label>
                <textarea id="challenges[${index}][nl_challenge_description]" name="challenges[${index}][nl_challenge_description]"  class="form-control  "></textarea><br>
                <button type="button" class="delete-challenge">Delete Challenges</button>
            `;

            challengesDiv.appendChild(newchallenge);
        });
        document.addEventListener('click', function(event) {
            if (event.target && event.target.classList.contains('delete-service_benefit')) {
                event.target.closest('.service_benefit').remove();
            }
        });




        document.getElementById('add-more-links').addEventListener('click', function() {
            var project_live_linksDiv = document.getElementById('project_live_links');
            var index = project_live_linksDiv.children.length - 1;

            var newproject_live_link = document.createElement('div');
            newproject_live_link.className = 'project_live_link';

            newproject_live_link.innerHTML = `
            <h6>Project Live Links ${index+1} </h6>
                <label for="project_live_links[${index}][link]">Link</label>
                <input type="text" id="project_live_links[${index}][link]" name="project_live_links[${index}][link]" class="form-control  "><br>
                <button type="button" class="delete-link">Delete Project Live Links</button>
            `;

            project_live_linksDiv.appendChild(newproject_live_link);
        });
        document.addEventListener('click', function(event) {
            if (event.target && event.target.classList.contains('delete-link')) {
                event.target.closest('.project_live_link').remove();
            }
        });
        /////////
        document.getElementById('add-more-tools').addEventListener('click', function() {
            var project_technologiesDiv = document.getElementById('project_technologies');
            var index = project_technologiesDiv.children.length - 1;

            var newproject_technology = document.createElement('div');
            newproject_technology.className = 'project_technology';

            newproject_technology.innerHTML = `
            <h6>Project Technologies ${index+1} </h6>
                <label for="project_technologies[${index}][tools]">Tool</label>
                <input type="text" id="project_technologies[${index}][tools]" name="project_technologies[${index}][tools]" class="form-control  "><br>
                <button type="button" class="delete-tool">Delete Project Technology</button>
            `;

            project_technologiesDiv.appendChild(newproject_technology);
        });
        document.addEventListener('click', function(event) {
            if (event.target && event.target.classList.contains('delete-tool')) {
                event.target.closest('.project_technology').remove();
            }
        });
        /////////////////////////

        document.addEventListener('click', function(event) {
            if (event.target && event.target.classList.contains('delete-achievement')) {
                event.target.closest('.achievement').remove();
            }
        });
        document.addEventListener('click', function(event) {
            if (event.target && event.target.classList.contains('delete-challenge')) {
                event.target.closest('.challenge').remove();
            }
        });


        ////////////////////
        document.addEventListener('DOMContentLoaded', function() {
            const clientSelect = document.getElementById('client');
            const newClientInput = document.getElementById('new_client_name');
            const newClientInput2 = document.getElementById('new_client_name2');
            const newClientInput3 = document.getElementById('new_client_name3');
            const newClientInput4 = document.getElementById('new_client_name4');

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
                } else {
                    newClientInput.disabled = false;
                    newClientInput2.disabled = false;
                    newClientInput3.disabled = false;
                    newClientInput4.disabled = false;
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
