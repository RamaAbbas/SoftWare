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
                                action="{{ route('project.update',$project['id']) }}" enctype="multipart/form-data" method="post">
                                @csrf
                                <label for="">Client</label><br>
                                <div class="form-group row">

                                    <label for="new_client_name">First Name</label>
                                    <input type="text" class="form-control" id="new_client_name" name="first_name"
                                        value="{{ $client[0]['first_name'] }}" readonly>
                                    <label for="new_client_name2">Last Name</label>
                                    <input type="text" class="form-control" id="new_client_name2" name="last_name"
                                        value="{{ $client[0]['last_name'] }}" readonly >
                                    <label for="new_client_name3">Email</label>
                                    <input type="text" class="form-control" id="new_client_name3" name="email"
                                        value="{{ $client[0]['email'] }}" readonly >
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
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Project Title
                                        in Dutch <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="name" required="required" class="form-control  "
                                            name="nl_title" value="{{ $project['nl_title'] }}">
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
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="description">Result
                                        in English
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="description" required="required" class="form-control "
                                            name="en_result" value="{{ $project['en_result'] }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="description">Result
                                        in Dutch
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="description" required="required" class="form-control "
                                            name="nl_result" value="{{ $project['nl_result'] }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="image">Project Image</label>
                                    <input type="file" name="image_path[]" accept="image/*" multiple>
                                </div>
                                <div class="form-group " id="date-of-birthday-id">
                                    <label for="birthday_date">Begin Date</label>
                                    <input type="date" name="begin_date" id="birthday_date" class="form-control"
                                        value="{{ $project['begin_date'] }}">
                                </div>
                                <div class="form-group" id="date-of-birthday-id">
                                    <label for="birthday_date">End Date</label>
                                    <input type="date" name="end_date" id="birthday_date" class="form-control"
                                        value="{{ $project['end_date'] }}">
                                </div>
                                <br>
                                <h2>Select The Services </h2>
                                @foreach ($services as $service)
                                    <div>
                                        <label>
                                            <input type="checkbox" name="service_ids[]" value="{{ $service->id }}"
                                            {{ $project->service_categories->contains($service->id) ? 'checked' : '' }}
                                            @if(in_array($service->id, $project->service_categories->pluck('id')->toArray())) checked @endif
                                            {{ in_array($service->id, $selectedServiceCategories) ? 'checked' : '' }}>
                                            {{ $service->en_name }}
                                        </label>
                                    </div>
                                @endforeach
                                <br>
                                <h2 class="StepTitle">Achievements</h2>
                                <input type="hidden" name="achievements[]">

                                <div class="form-group row">
                                    <div id="achievements">
                                        @foreach ($project->achievements as $achievements)
                                            <div class="achievement">
                                                <label
                                                    for="achievements[{{ $achievements->id }}][en_achievement_name]">English
                                                    Name:</label>
                                                <input type="text" id="requirement[0][en_name]"
                                                    name="achievements[0][en_achievement_name]" class="form-control"
                                                    value="{{ $achievements->en_achievement_name }}"><br>

                                                <label for="achievements[0][nl_achievement_name]">Dutch Name:</label>
                                                <input type="text" id="achievements[0][nl_achievement_name]"
                                                    name="achievements[{{ $achievements->id }}][nl_achievement_name]"
                                                    class="form-control "
                                                    value="{{ $achievements->en_achievement_name }}"><br>

                                                <br>

                                                <button type="button" class="delete-achievement">Delete
                                                    Achievement </button>
                                            </div>
                                            <br>
                                        @endforeach
                                    </div>


                                </div>

                                <button type="button" id="add-more-achievements">Add More Achievements</button>

                                <br>
                                <h2 class="StepTitle">Challenges</h2>
                                <div class="form-group row">

                                    <div id="challenges">
                                        @foreach ($project->challenges as $challenges)
                                            <div class="challenge">
                                                <label for="challenges[0][en_challenge_name]">English Name:</label>
                                                <input type="text" id="challenges[0][en_challenge_name]"
                                                    name="challenges[0][en_challenge_name]" class="form-control"
                                                    value="{{ $challenges->en_challenge_name }}"><br>

                                                <label for="challenges[0][nl_challenge_name]">Dutch Name:</label>
                                                <input type="text" id="challenges[0][nl_challenge_name]"
                                                    name="challenges[0][nl_challenge_name]" class="form-control  "
                                                    value="{{ $challenges->nl_challenge_name }}"><br>
                                                <br>
                                                <label for="challenges[0][en_challenge_description]">English
                                                    Description:</label>
                                                <textarea id="challenges[0][en_challenge_description]" name="challenges[0][en_challenge_description]"
                                                    class="form-control  " value="{{ $challenges->en_challenge_description }}">{{ $challenges->en_challenge_description }}</textarea><br>

                                                <label for="service_benefits[0][nl_challenge_description]">Dutch
                                                    Description:</label>
                                                <textarea id="challenges[0][nl_challenge_description]" name="challenges[0][nl_challenge_description]"
                                                    class="form-control  " value="{{ $challenges->nl_challenge_description }}">{{ $challenges->nl_challenge_description }}</textarea><br>
                                                <button type="button" class="delete-challenge">Delete
                                                    Challenge</button>

                                            </div>
                                            <br>
                                        @endforeach
                                    </div>
                                </div>
                                <button type="button" id="add-more-challenges">Add More challenges</button>

                                <br>
                                <h2 class="StepTitle">Project Live Links </h2>
                                <div class="form-group row">

                                    <div id="project_live_links">
                                        @foreach ($project->project_live_links as $project_live_links)
                                            <div class="project_live_link">
                                                <label for="project_live_links[0][link]">Link
                                                </label>
                                                <input type="text" id="project_live_links[0][link]"
                                                    name="project_live_links[0][link]" class="form-control "
                                                    value="{{ $project_live_links->link }}"><br>


                                                <button type="button" class="delete-link">Delete
                                                    Link</button>

                                            </div>
                                            <br>
                                        @endforeach
                                    </div>
                                </div>
                                <button type="button" id="add-more-links">Add More Links</button>
                                <br>
                                <h2 class="StepTitle">Project Technology</h2>
                                <div class="form-group row">

                                    <div id="project_technologies">
                                        @foreach ($project->project_technologies as $project_technologies)
                                            <div class="project_technology">
                                                <label for="project_technologies[0][tools]">Link
                                                </label>
                                                <input type="text" id="project_technologies[0][tools]"
                                                    name="project_technologies[0][tools]" class="form-control " value="{{$project_technologies->tools}}"><br>


                                                <button type="button" class="delete-tool">Delete
                                                    Tool</button>

                                            </div>
                                            <br>
                                        @endforeach
                                    </div>
                                </div>
                                <button type="button" id="add-more-tools">Add More Tools</button>


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
                <button type="button" class="delete-tool">Delete Tool</button>
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
