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
                                action="{{ route('aboutus.update', $aboutus->id) }}" enctype="multipart/form-data"
                                method="post">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align"
                                        for="en_company_name">Company Name in English <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="en_company_name" required="required"
                                            class="form-control  " name="en_company_name"
                                            value="{{ $aboutus->en_company_name }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align"
                                        for="nl_company_name">Company Name in Dutch <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="nl_company_name" required="required"
                                            class="form-control  " name="nl_company_name"
                                            value="{{ $aboutus->nl_company_name }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align"
                                        for="en_introduction">Introduction in English
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="en_introduction" required="required" class="form-control "
                                            name="en_introduction" value="{{ $aboutus->en_introduction }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align"
                                        for="nl_introduction">Introduction in Dutch
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="nl_introduction" required="required" class="form-control "
                                            name="nl_introduction" value="{{ $aboutus->nl_introduction }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="en_our_mission">Our
                                        Mission in English
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="en_our_mission" required="required" class="form-control "
                                            name="en_our_mission" value="{{ $aboutus->en_our_mission }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="nl_our_mission">Our
                                        Mission in Dutch
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="nl_our_mission" required="required" class="form-control "
                                            name="nl_our_mission" value="{{ $aboutus->nl_our_mission }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="en_our_goals">Our
                                        Goals
                                        in English
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="en_our_goals" required="required"
                                            class="form-control " name="en_our_goals"
                                            value="{{ $aboutus->en_our_goals }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="nl_our_goals">Our
                                        Goals in Dutch
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="nl_our_goals" required="required"
                                            class="form-control " name="nl_our_goals"
                                            value="{{ $aboutus->nl_our_goals }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align"
                                        for="en_title_for_who">Title For Who in English
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="en_title_for_who" required="required"
                                            class="form-control " name="en_title_for_who"
                                            value="{{ $aboutus->en_title_for_who }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-3 col-sm-3 label-align"
                                        for="nl_title_for_who">Title For Who in Dutch
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="text" id="nl_title_for_who" required="required"
                                            class="form-control " name="nl_title_for_who"
                                            value="{{ $aboutus->nl_title_for_who }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="en_title_steps_process"
                                        class="col-form-label col-md-3 col-sm-3 label-align">Title Steps Process
                                        in English
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input id="en_title_steps_process" class="form-control col" type="text"
                                            name="en_title_steps_process" value="{{ $aboutus->en_title_steps_process }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nl_title_steps_process"
                                        class="col-form-label col-md-3 col-sm-3 label-align">Title Steps Process
                                        in Dutch
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input id="nl_title_steps_process" class="form-control col" type="text"
                                            name="nl_title_steps_process" value="{{ $aboutus->nl_title_steps_process }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="en_meet_our_team"
                                        class="col-form-label col-md-3 col-sm-3 label-align">Meet Our Team
                                        in English
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input id="en_meet_our_team" class="form-control col" type="text"
                                            name="en_meet_our_team" value="{{ $aboutus->en_meet_our_team }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nl_meet_our_team"
                                        class="col-form-label col-md-3 col-sm-3 label-align">Meet Our Team
                                        in Dutch
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input id="nl_meet_our_team" class="form-control col" type="text"
                                            name="nl_meet_our_team" value="{{ $aboutus->nl_meet_our_team }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="en_our_partners_associates"
                                        class="col-form-label col-md-3 col-sm-3 label-align">Our Partners
                                        Associates
                                        in English
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input id="en_our_partners_associates" class="form-control col" type="text"
                                            name="en_our_partners_associates"
                                            value="{{ $aboutus->en_our_partners_associates }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nl_our_partners_associates"
                                        class="col-form-label col-md-3 col-sm-3 label-align">Our Partners
                                        Associates
                                        in Dutch
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input id="nl_our_partners_associates" class="form-control col" type="text"
                                            name="nl_our_partners_associates"
                                            value="{{ $aboutus->nl_our_partners_associates }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="en_end" class="col-form-label col-md-3 col-sm-3 label-align">End
                                        in English
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input id="en_end" class="form-control col" type="text" name="en_end"
                                            value="{{ $aboutus->en_end }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nl_end" class="col-form-label col-md-3 col-sm-3 label-align">End
                                        in Dutch
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input id="nl_end" class="form-control col" type="text" name="nl_end"
                                            value="{{ $aboutus->nl_end }}">
                                    </div>
                                </div>

                                <h2>Steps Processs</h2>
                                <div class="form-group row">
                                    <div id="steps_processs">
                                        @foreach ($aboutus->steps_process as $steps_processs)
                                            <div class="steps_process">
                                                <label for="steps_processs[0][en_name]">English Name:</label>
                                                <input type="text" id="steps_processs[0][en_name]"
                                                    name="steps_processs[0][en_name]"
                                                    value="{{ $steps_processs->en_name }}" class="form-control  "><br>


                                                <label for="steps_processs[0][nl_name]">Dutch Name:</label>
                                                <input type="text" id="steps_processs[0][nl_name]"
                                                    name="steps_processs[0][nl_name]"
                                                    value="{{ $steps_processs->nl_name }}" class="form-control  "><br>

                                                <br>
                                                <label for="steps_processs[0][en_description]">English
                                                    Description:</label>
                                                <textarea id="steps_processs[0][en_description]" name="steps_processs[0][en_description]" class="form-control  ">{{ $steps_processs->en_description }}</textarea><br>


                                                <label for="steps_processs[0][nl_description]">Dutch
                                                    Description:</label>
                                                <textarea id="steps_processs[0][nl_description]" name="steps_processs[0][nl_description]" class="form-control  ">{{ $steps_processs->nl_description }}</textarea><br>
                                                <button type="button" class="delete-steps_process">Delete
                                                    Steps Processs </button>

                                            </div>
                                            <br>
                                        @endforeach
                                    </div>


                                </div>

                                <button type="button" id="add-more-steps">Add More Steps Processs</button>
                                <br>
                                <h2>For Who Services</h2>
                                <div class="form-group row">
                                    <div id="for_who_services">
                                        @foreach ($aboutus->for_who_services as $for_who_services)
                                            <div class="for_who_service">
                                                <label for="for_who_services[0][en_name]">English Name:</label>
                                                <input type="text" id="for_who_services[0][en_name]"
                                                    name="for_who_services[0][en_name]"
                                                    value="{{ $for_who_services->en_name }}" class="form-control  "><br>


                                                <label for="for_who_services[0][nl_name]">Dutch Name:</label>
                                                <input type="text" id="for_who_services[0][nl_name]"
                                                    name="for_who_services[0][nl_name]"
                                                    value="{{ $for_who_services->nl_name }}" class="form-control  "><br>

                                                <br>
                                                <label for="for_who_services[0][en_description]">English
                                                    Description:</label>
                                                <textarea id="for_who_services[0][en_description]" name="for_who_services[0][en_description]" class="form-control  ">{{ $for_who_services->en_description }}</textarea><br>


                                                <label for="for_who_services[0][nl_description]">Dutch
                                                    Description:</label>
                                                <textarea id="for_who_services[0][nl_description]" name="for_who_services[0][nl_description]" class="form-control  ">{{ $for_who_services->nl_description }}</textarea><br>
                                                <button type="button" class="delete-for_who_service">Delete
                                                    For Who Service </button>

                                            </div>
                                            <br>
                                        @endforeach
                                    </div>
                                </div>

                                <button type="button" id="add-more-for_who_service">Add More For Who
                                    Service</button>




                                <h2>Client Testemonial</h2>
                                <div class="form-group row">
                                    <div id="client_testimonials">
                                        @foreach ($aboutus->client_testimonial as $client_testimonial)
                                            <div class="client_testimoniall">
                                                <label for="client_testimonial[0][client_name]">Client Name:</label>
                                                <input type="text" id="client_testimonial[0][client_name]"
                                                    name="client_testimonial[0][client_name]"
                                                    value="{{ $client_testimonial->client_name }}"
                                                    class="form-control  "><br>

                                                <br>
                                                <label for="client_testimonial[0][en_client_testimonial]">Client
                                                    Testemonial
                                                    in English</label>
                                                <textarea id="client_testimonial[0][en_client_testimonial]" name="client_testimonial[0][en_client_testimonial]"
                                                    class="form-control  ">{{ $client_testimonial->en_client_testimonial }}</textarea><br>

                                                <label for="client_testimonial[0][nl_client_testimonial]">Client
                                                    Testemonial
                                                    in Dutch
                                                </label>
                                                <textarea id="client_testimonial[0][nl_client_testimonial]" name="client_testimonial[0][nl_client_testimonial]"
                                                    class="form-control  ">{{ $client_testimonial->nl_client_testimonial }}</textarea><br>
                                                <button type="button" class="delete-client_testimoniall">Delete
                                                    Client Testimoniall </button>

                                            </div>
                                            <br>
                                        @endforeach
                                    </div>
                                </div>
                                <button type="button" id="add-more-testimonial">Add More Testimonial</button>
                        </div>

                        <button type="button" id="add-more-for_who_service">Add More For Who
                            Service</button>

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
        document.getElementById('add-more-steps').addEventListener('click', function() {
            // console.log("@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@");
            var steps_processsDiv = document.getElementById('steps_processs');
            var index = steps_processsDiv.children.length - 1;

            var newsteps_process = document.createElement('div');
            newsteps_process.className = 'steps_process';

            newsteps_process.innerHTML = `
<h6>Steps Process ${index+1} </h6>
    <label for="steps_processs[${index}][en_name]">English Name:</label>
    <input type="text" id="steps_processs[${index}][en_name]" name="steps_processs[${index}][en_name]"  class="form-control  "><br>

    <label for="steps_processs[${index}][nl_name]">Dutch Name:</label>
    <input type="text" id="steps_processs[${index}][nl_name]" name="steps_processs[${index}][nl_name]"  class="form-control  "><br>

    <label for="steps_processs[${index}][en_description]">English Description:</label>
    <textarea id="steps_processs[${index}][en_description]" name="steps_processs[${index}][en_description]"  class="form-control  "></textarea><br>

    <label for="steps_processs[${index}][nl_description]">Dutch Description:</label>
    <textarea id="steps_processs[${index}][nl_description]" name="steps_processs[${index}][nl_description]"  class="form-control  "></textarea><br>
    <button type="button" class="delete-steps_process">Delete Steps Process</button>
`;

            steps_processsDiv.appendChild(newsteps_process);

        });
        document.addEventListener('click', function(event) {
            if (event.target && event.target.classList.contains('delete-steps_process')) {
                event.target.closest('.steps_process').remove();
            }
        });

        document.getElementById('add-more-for_who_service').addEventListener('click', function() {
            var for_who_servicesDiv = document.getElementById('for_who_services');
            var index = for_who_servicesDiv.children.length - 1;

            var for_who_service = document.createElement('div');
            for_who_service.className = 'for_who_service';

            for_who_service.innerHTML = `
<h6>For Who Service ${index+1} </h6>
    <label for="for_who_services[${index}][en_name]">English Name:</label>
    <input type="text" id="for_who_services[${index}][en_name]" name="for_who_services[${index}][en_name]" class="form-control  "><br>

    <label for="for_who_services[${index}][nl_name]">Dutch Name:</label>
    <input type="text" id="for_who_services[${index}][nl_name]" name="for_who_services[${index}][nl_name]" class="form-control  "><br>

    <label for="for_who_services[${index}][en_description]">English Description:</label>
    <textarea id="for_who_services[${index}][en_description]" name="for_who_services[${index}][en_description]" class="form-control  "></textarea><br>

    <label for="for_who_services[${index}][nl_description]">Dutch Description:</label>
    <textarea id="for_who_services[${index}][nl_description]" name="for_who_services[${index}][nl_description]" class="form-control  "></textarea><br>
    <button type="button" class="delete-for_who_service">Delete For Who Service</button>
`;

            for_who_servicesDiv.appendChild(for_who_service);
        });
        document.addEventListener('click', function(event) {
            if (event.target && event.target.classList.contains('delete-for_who_service')) {
                event.target.closest('.for_who_service').remove();
            }
        });



        document.getElementById('add-more-testimonial').addEventListener('click', function() {
            var client_testimonialsDiv = document.getElementById('client_testimonials');
            var index = client_testimonialsDiv.children.length - 1;

            var newclient_testimonial = document.createElement('div');
            newclient_testimonial.className = 'client_testimoniall';

            newclient_testimonial.innerHTML = `
<h6>Client Testimonial ${index+1} </h6>
    <label for="client_testimonial[${index}][client_name]">Client Name:</label>
    <input type="text" id="client_testimonial[${index}][client_name]" name="client_testimonial[${index}][client_name]"><br>

    <label for="client_testimonial[${index}][en_client_testimonial]"> Client Testemonial in English</label>
    <textarea id="client_testimonial[${index}][en_client_testimonial]" name="client_testimonial[${index}][en_client_testimonial]"></textarea><br>

    <label for="client_testimonial[${index}][nl_client_testimonial]">Client Testemonial in Dutch</label>
    <textarea id="client_testimonial[${index}][nl_client_testimonial]" name="client_testimonial[${index}][nl_client_testimonial]"></textarea><br>
    <button type="button" class="delete-client_testimoniall">Delete Client Testimonial</button>
`;

            client_testimonialsDiv.appendChild(newclient_testimonial);
        });
        document.addEventListener('click', function(event) {
            if (event.target && event.target.classList.contains('delete-client_testimoniall')) {
                event.target.closest('.client_testimoniall').remove();
            }
        });
    </script>
@endsection
