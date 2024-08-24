@extends('layouts.app')
@if (session('success'))
    <div class=" alert">{{ session('success') }}</div>
    <h1> AAAAAAA</h1>
@endif

@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>AboutUs Form</h3>
                </div>

                <div class="title_right">

                </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">

                <div class="col-md-12 col-sm-10 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>About us <small></small></h2>
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


                            <p>Please fill this Form To add About Us
                            </p>
                            <div id="wizard" class="form_wizard wizard_horizontal">
                                <ul class="wizard_steps">
                                    <li>
                                        <a href="#step-1">
                                            <span class="step_no">1</span>
                                            <span class="step_descr">
                                                Step 1<br />
                                                <small>About us</small>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#step-2">
                                            <span class="step_no">2</span>
                                            <span class="step_descr">
                                                Step 2<br />
                                                <small>Steps Processs</small>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#step-3">
                                            <span class="step_no">3</span>
                                            <span class="step_descr">
                                                Step 3<br />
                                                <small>Service For Who</small>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#step-4">
                                            <span class="step_no">4</span>
                                            <span class="step_descr">
                                                Step 4<br />
                                                <small>Client Testimonial</small>
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                                <div id="step-1">
                                    <form class="form-horizontal form-label-left" id="form1">
                                        @csrf
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                for="en_company_name">Company Name in English <span
                                                    class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input type="text" id="en_company_name" required="required"
                                                    class="form-control  " name="en_company_name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                for="nl_company_name">Company Name in Dutch <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input type="text" id="nl_company_name" required="required"
                                                    class="form-control  " name="nl_company_name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                for="en_introduction">Introduction in English
                                                <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input type="text" id="en_introduction" required="required"
                                                    class="form-control " name="en_introduction">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                for="nl_introduction">Introduction in Dutch
                                                <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input type="text" id="nl_introduction" required="required"
                                                    class="form-control " name="nl_introduction">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                for="en_our_mission">Our Mission in English
                                                <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input type="text" id="en_our_mission" required="required"
                                                    class="form-control " name="en_our_mission">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                for="nl_our_mission">Our Mission in Dutch
                                                <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input type="text" id="nl_our_mission" required="required"
                                                    class="form-control " name="nl_our_mission">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                for="en_our_goals">Our Goals in English
                                                <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input type="text" id="en_our_goals" required="required"
                                                    class="form-control " name="en_our_goals">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                for="nl_our_goals">Our Goals in Dutch
                                                <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input type="text" id="nl_our_goals" required="required"
                                                    class="form-control " name="nl_our_goals">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                for="en_title_for_who">Title For Who in English
                                                <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input type="text" id="en_title_for_who" required="required"
                                                    class="form-control " name="en_title_for_who">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                for="nl_title_for_who">Title For Who in Dutch
                                                <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input type="text" id="nl_title_for_who" required="required"
                                                    class="form-control " name="nl_title_for_who">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="en_title_steps_process"
                                                class="col-form-label col-md-3 col-sm-3 label-align">Title Steps Process
                                                in English
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input id="en_title_steps_process" class="form-control col"
                                                    type="text" name="en_title_steps_process">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="nl_title_steps_process"
                                                class="col-form-label col-md-3 col-sm-3 label-align">Title Steps Process
                                                in Dutch
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input id="nl_title_steps_process" class="form-control col"
                                                    type="text" name="nl_title_steps_process">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="en_meet_our_team"
                                                class="col-form-label col-md-3 col-sm-3 label-align">Meet Our Team
                                                in English
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input id="en_meet_our_team" class="form-control col" type="text"
                                                    name="en_meet_our_team">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="nl_meet_our_team"
                                                class="col-form-label col-md-3 col-sm-3 label-align">Meet Our Team
                                                in Dutch
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input id="nl_meet_our_team" class="form-control col" type="text"
                                                    name="nl_meet_our_team">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="en_our_partners_associates"
                                                class="col-form-label col-md-3 col-sm-3 label-align">Our Partners
                                                Associates
                                                in English
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input id="en_our_partners_associates" class="form-control col"
                                                    type="text" name="en_our_partners_associates">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="nl_our_partners_associates"
                                                class="col-form-label col-md-3 col-sm-3 label-align">Our Partners
                                                Associates
                                                in Dutch
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input id="nl_our_partners_associates" class="form-control col"
                                                    type="text" name="nl_our_partners_associates">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="en_end" class="col-form-label col-md-3 col-sm-3 label-align">End
                                                in English
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input id="en_end" class="form-control col" type="text"
                                                    name="en_end">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="nl_end" class="col-form-label col-md-3 col-sm-3 label-align">End
                                                in Dutch
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input id="nl_end" class="form-control col" type="text"
                                                    name="nl_end">
                                            </div>
                                        </div>



                                        <!-- -->

                                    </form>

                                </div>
                                <div id="step-2">
                                    <h2 class="StepTitle">Steps Process</h2>
                                    <form class="form-horizontal form-label-left" id="form2">
                                        @csrf
                                        <input type="hidden" name="steps_processs[]">

                                        <div class="form-group row">
                                            <div id="steps_processs">
                                                <div class="steps_process">
                                                    <label for="steps_processs[0][en_name]">English Name:</label>
                                                    <input type="text" id="steps_processs[0][en_name]"
                                                        name="steps_processs[0][en_name]"
                                                        value="{{ old('steps_processs.0.en_name') }}"
                                                        class="form-control  "><br>


                                                    <label for="steps_processs[0][nl_name]">Dutch Name:</label>
                                                    <input type="text" id="steps_processs[0][nl_name]"
                                                        name="steps_processs[0][nl_name]"
                                                        value="{{ old('steps_processs.0.nl_name') }}"
                                                        class="form-control  "><br>

                                                    <br>
                                                    <label for="steps_processs[0][en_description]">English
                                                        Description:</label>
                                                    <textarea id="steps_processs[0][en_description]" name="steps_processs[0][en_description]" class="form-control  ">{{ old('steps_processs.0.en_description') }}</textarea><br>


                                                    <label for="steps_processs[0][nl_description]">Dutch
                                                        Description:</label>
                                                    <textarea id="steps_processs[0][nl_description]" name="steps_processs[0][nl_description]" class="form-control  ">{{ old('steps_processs.0.nl_description') }}</textarea><br>
                                                    <button type="button" class="delete-steps_process">Delete
                                                        Steps Processs </button>

                                                </div>
                                                <br>
                                            </div>


                                        </div>

                                        <button type="button" id="add-more-steps">Add More Steps Processs</button>

                                    </form>

                                </div>

                                <div id="step-3">
                                    <h2 class="StepTitle">For Who Service</h2>
                                    <form class="form-horizontal form-label-left" id="form3">
                                        @csrf
                                        <input type="hidden" name="for_who_services[]">

                                        <div class="form-group row">
                                            <div id="for_who_services">
                                                <div class="for_who_service">
                                                    <label for="for_who_services[0][en_name]">English Name:</label>
                                                    <input type="text" id="for_who_services[0][en_name]"
                                                        name="for_who_services[0][en_name]"
                                                        value="{{ old('steps_processs.0.en_name') }}"
                                                        class="form-control  "><br>


                                                    <label for="for_who_services[0][nl_name]">Dutch Name:</label>
                                                    <input type="text" id="for_who_services[0][nl_name]"
                                                        name="for_who_services[0][nl_name]"
                                                        value="{{ old('for_who_services.0.nl_name') }}"
                                                        class="form-control  "><br>

                                                    <br>
                                                    <label for="for_who_services[0][en_description]">English
                                                        Description:</label>
                                                    <textarea id="for_who_services[0][en_description]" name="for_who_services[0][en_description]" class="form-control  ">{{ old('steps_processs.0.en_description') }}</textarea><br>


                                                    <label for="for_who_services[0][nl_description]">Dutch
                                                        Description:</label>
                                                    <textarea id="for_who_services[0][nl_description]" name="for_who_services[0][nl_description]" class="form-control  ">{{ old('steps_processs.0.nl_description') }}</textarea><br>
                                                    <button type="button" class="delete-for_who_service">Delete
                                                        For Who Service </button>

                                                </div>
                                                <br>
                                            </div>


                                        </div>

                                        <button type="button" id="add-more-for_who_service">Add More For Who Service</button>

                                    </form>

                                </div>
                                <div id="step-4">
                                    <h2 class="StepTitle">Client Testemonial</h2>
                                    <form class="form-horizontal form-label-left" id="form4">
                                        @csrf
                                        <input type="hidden" name="client_testimonial[]">
                                        <div class="form-group row">
                                            <div id="client_testimonials">
                                                <div class="client_testimonial">
                                                    <label for="client_testimonial[0][client_name]">Client Name:</label>
                                                    <input type="text" id="client_testimonial[0][client_name]"
                                                        name="client_testimonial[0][client_name]"
                                                        value="{{ old('client_testimonial.0.client_name') }}"
                                                        class="form-control  "><br>

                                                    <br>
                                                    <label for="client_testimonial[0][en_client_testimonial]">Client
                                                        Testemonial
                                                        in English</label>
                                                    <textarea id="client_testimonial[0][en_client_testimonial]" name="client_testimonial[0][en_client_testimonial]"
                                                        class="form-control  ">{{ old('client_testimonial.0.en_client_testimonial') }}</textarea><br>

                                                    <label for="client_testimonial[0][nl_client_testimonial]">Client
                                                        Testemonial
                                                        in Dutch
                                                    </label>
                                                    <textarea id="client_testimonial[0][nl_client_testimonial]" name="client_testimonial[0][nl_client_testimonial]"
                                                        class="form-control  ">{{ old('client_testimonial.0.nl_client_testimonial') }}</textarea><br>

                                                </div>
                                                <br>
                                            </div>
                                        </div>
                                        <button type="button" id="add-more-testimonial">Add More Testimonial</button>
                                    </form>
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
            combinedForm.action = '{{ route('about-us.store') }}';

            let csrfToken = document.querySelector('input[name="_token"]').value;
            let csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = csrfToken;
            combinedForm.appendChild(csrfInput);

            let forms = [document.getElementById('form1'), document.getElementById('form2'), document
                .getElementById('form3'), document.getElementById('form4')
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



        document.getElementById('add-more-steps').addEventListener('click', function() {
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
                <button type="button" class="delete-steps_process">Delete Requirement</button>
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
            newclient_testimonial.className = 'client_testimonial';

            newclient_testimonial.innerHTML = `
            <h6>Client Testimonial ${index+1} </h6>
                <label for="client_testimonial[${index}][client_name]">Client Name:</label>
                <input type="text" id="client_testimonial[${index}][client_name]" name="client_testimonial[${index}][client_name]"><br>

                <label for="client_testimonial[${index}][en_client_testimonial]"> Client Testemonial in English</label>
                <textarea id="client_testimonial[${index}][en_client_testimonial]" name="client_testimonial[${index}][en_client_testimonial]"></textarea><br>

                <label for="client_testimonial[${index}][nl_client_testimonial]">Client Testemonial in Dutch</label>
                <textarea id="client_testimonial[${index}][nl_client_testimonial]" name="client_testimonial[${index}][nl_client_testimonial]"></textarea><br>
            `;

            client_testimonialsDiv.appendChild(newclient_testimonial);
        });
    </script>
@endsection
