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
                                                <small>Requirment</small>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#step-3">
                                            <span class="step_no">3</span>
                                            <span class="step_descr">
                                                Step 3<br />
                                                <small>Service Benefits</small>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#step-4">
                                            <span class="step_no">4</span>
                                            <span class="step_descr">
                                                Step 4<br />
                                                <small>Service Processs</small>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#step-5">
                                            <span class="step_no">5</span>
                                            <span class="step_descr">
                                                Step 5<br />
                                                <small>Client Testimonial</small>
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                                <div id="step-1" class="col-md-12 col-sm-3 ">
                                    <form class="form-horizontal form-label-left" id="form1"
                                        enctype="multipart/form-data">
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
                                        <div class="form-group">
                                            <label for="image">Project Image</label>
                                            <input  type="file"  name="image_path[]" accept="image/*"
                                                multiple required>
                                        </div>
                                        <div class="form-group " id="date-of-birthday-id">
                                            <label for="birthday_date">Begin Date</label>
                                            <input type="date" name="end_date" id="birthday_date"
                                                class="form-control" value="">
                                        </div>
                                        <div class="form-group" id="date-of-birthday-id">
                                            <label for="birthday_date">End Date</label>
                                            <input type="date" name="begin_date" id="birthday_date"
                                                class="form-control" value="">
                                        </div>


                                    </form>

                                </div>
                                <div id="step-2">
                                    <h2 class="StepTitle">Requirment</h2>
                                    <form class="form-horizontal form-label-left" id="form2">
                                        @csrf
                                        <input type="hidden" name="requirment[]">

                                        <div class="form-group row">
                                            <div id="requirements">
                                                <div class="requirement">
                                                    <label for="requirment[0][en_name]">English Name:</label>
                                                    <input type="text" id="requirement[0][en_name]"
                                                        name="requirment[0][en_name]"
                                                        value="{{ old('requirements.0.en_name') }}"
                                                        class="form-control  "><br>

                                                    <label for="requirment[0][nl_name]">Dutch Name:</label>
                                                    <input type="text" id="requirements[0][nl_name]"
                                                        name="requirment[0][nl_name]"
                                                        value="{{ old('requirements.0.nl_name') }}"
                                                        class="form-control  "><br>

                                                    <br>
                                                    <label for="requirment[0][en_description]">English
                                                        Description:</label>
                                                    <textarea id="requirement[0][en_description]" name="requirment[0][en_description]" class="form-control  ">{{ old('requirements.0.en_description') }}</textarea><br>


                                                    <label for="requirement[0][nl_description]">Dutch Description:</label>
                                                    <textarea id="requirement[0][nl_description]" name="requirment[0][nl_description]" class="form-control  ">{{ old('requirements.0.nl_description') }}</textarea><br>
                                                    <button type="button" class="delete-requirement">Delete
                                                        Requirement</button>
                                                </div>
                                                <br>
                                            </div>


                                        </div>

                                        <button type="button" id="add-more">Add More Requirements</button>

                                    </form>

                                </div>

                                <div id="step-3">
                                    <h2 class="StepTitle">Service Benefits</h2>
                                    <form class="form-horizontal form-label-left" id="form3">
                                        @csrf
                                        <input type="hidden" name="service_benefits[]">
                                        <div class="form-group row">
                                            <div id="service_benefits">
                                                <div class="service_benefit">
                                                    <label for="service_benefits[0][en_name]">English Name:</label>
                                                    <input type="text" id="service_benefits[0][en_name]"
                                                        name="service_benefits[0][en_name]"
                                                        value="{{ old('service_benefits.0.en_name') }}"
                                                        class="form-control  "><br>

                                                    <label for="service_benefits[0][nl_name]">Dutch Name:</label>
                                                    <input type="text" id="service_benefits[0][nl_name]"
                                                        name="service_benefits[0][nl_name]"
                                                        value="{{ old('service_benefits.0.nl_name') }}"
                                                        class="form-control  "><br>
                                                    <br>
                                                    <label for="service_benefits[0][en_description]">English
                                                        Description:</label>
                                                    <textarea id="service_benefits[0][en_description]" name="service_benefits[0][en_description]" class="form-control  ">{{ old('requirements.0.en_description') }}</textarea><br>

                                                    <label for="service_benefits[0][nl_description]">Dutch
                                                        Description:</label>
                                                    <textarea id="service_benefits[0][nl_description]" name="service_benefits[0][nl_description]" class="form-control  ">{{ old('requirements.0.nl_description') }}</textarea><br>
                                                    <button type="button" class="delete-service_benefit">Delete
                                                        Benefit</button>

                                                </div>
                                                <br>
                                            </div>
                                        </div>
                                        <button type="button" id="add-more-benefit">Add More Benefits</button>
                                    </form>
                                </div>
                                <div id="step-4">
                                    <form class="form-horizontal form-label-left" id="form4">
                                        @csrf
                                        <input type="hidden" name="service_processs[]">
                                        <div id="service_processes">
                                            <h3>Service Processes</h3>
                                            <div class="service_process">
                                                <label for="service_processs[0][en_name]">English Name:</label>
                                                <input type="text" id="service_processes[0][en_name]"
                                                    name="service_processs[0][en_name]"
                                                    value="{{ old('service_processes.0.en_name') }}"
                                                    class="form-control  "><br>


                                                <label for="service_processs[0][nl_name]">Dutch Name:</label>
                                                <input type="text" id="service_processes[0][nl_name]"
                                                    name="service_processs[0][nl_name]"
                                                    value="{{ old('service_processes.0.nl_name') }}"
                                                    class="form-control  "><br>


                                                <label for="service_processs[0][step_no]">Step Number:</label>
                                                <input type="number" id="service_processes[0][step_no]"
                                                    name="service_processs[0][step_no]"
                                                    value="{{ old('service_processes.0.step_no') }}"
                                                    class="form-control  "><br>


                                                <div class="process_procedure">
                                                    <label
                                                        for="service_processs[0][process_procedures][0][en_name]">Procedure
                                                        English Name:</label>
                                                    <input type="text"
                                                        id="service_processes[0][process_procedures][0][en_name]"
                                                        name="service_processs[0][process_procedures][0][en_name]"
                                                        value="{{ old('service_processs.0.process_procedures.0.en_name') }}"
                                                        class="form-control  "><br>

                                                    <label
                                                        for="service_processs[0][process_procedures][0][nl_name]">Procedure
                                                        Dutch Name:</label>
                                                    <input type="text"
                                                        id="service_processes[0][process_procedures][0][nl_name]"
                                                        name="service_processs[0][process_procedures][0][nl_name]"
                                                        value="{{ old('service_processs.0.process_procedures.0.nl_name') }}"
                                                        class="form-control  "><br>


                                                    <label
                                                        for="service_processs[0][process_procedures][0][en_description]">Procedure
                                                        English Description:</label>
                                                    <textarea id="service_processes[0][process_procedures][0][en_description]"
                                                        name="service_processs[0][process_procedures][0][en_description]" class="form-control  ">{{ old('service_processes.0.process_procedures.0.en_description') }}</textarea><br>


                                                    <label
                                                        for="service_processs[0][process_procedures][0][nl_description]">Procedure
                                                        Dutch Description:</label>
                                                    <textarea id="service_processes[0][process_procedures][0][nl_description]"
                                                        name="service_processs[0][process_procedures][0][nl_description]" class="form-control  ">{{ old('service_processes.0.process_procedures.0.nl_description') }}</textarea><br>

                                                    <button type="button" class="add-more-procedure"
                                                        data-service-process-index="0">Add More Procedure</button>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="button" id="add-more-service-processes">Add More Service
                                            Processes</button>

                                    </form>
                                </div>

                                <div id="step-5">
                                    <h2 class="StepTitle">Client Testemonial</h2>
                                    <form class="form-horizontal form-label-left" id="form5">
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
                                                    <button type="button" class="delete-client_testimonial">Delete
                                                        Client Testimonial</button>


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
            combinedForm.action = '{{ route('project.store') }}';

            let csrfToken = document.querySelector('input[name="_token"]').value;
            let csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = csrfToken;
            combinedForm.appendChild(csrfInput);

            let forms = [document.getElementById('form1'), document.getElementById('form2'), document
                .getElementById('form3'), document.getElementById('form4'), document.getElementById('form5')
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



        document.getElementById('add-more').addEventListener('click', function() {
            var requirementsDiv = document.getElementById('requirements');
            var index = requirementsDiv.children.length - 1;

            var newRequirement = document.createElement('div');
            newRequirement.className = 'requirement';

            newRequirement.innerHTML = `
            <h6>Requirment ${index+1} </h6>
                <label for="requirement[${index}][en_name]">English Name:</label>
                <input type="text" id="requirement[${index}][en_name]" name="requirment[${index}][en_name]"  class="form-control  "><br>

                <label for="requirement[${index}][nl_name]">Dutch Name:</label>
                <input type="text" id="requirement[${index}][nl_name]" name="requirment[${index}][nl_name]"  class="form-control  "><br>

                <label for="requirement[${index}][en_description]">English Description:</label>
                <textarea id="requirement[${index}][en_description]" name="requirment[${index}][en_description]"  class="form-control  "></textarea><br>

                <label for="requirement[${index}][nl_description]">Dutch Description:</label>
                <textarea id="requirement[${index}][nl_description]" name="requirment[${index}][nl_description]"  class="form-control  "></textarea><br>
                <button type="button" class="delete-requirement">Delete Requirement</button>
            `;

            requirementsDiv.appendChild(newRequirement);
        });

        document.getElementById('add-more-benefit').addEventListener('click', function() {
            var service_benefitsDiv = document.getElementById('service_benefits');
            var index = service_benefitsDiv.children.length - 1;

            var newservice_benefit = document.createElement('div');
            newservice_benefit.className = 'service_benefit';

            newservice_benefit.innerHTML = `
            <h6>Service Benefit ${index+1} </h6>
                <label for="service_benefits[${index}][en_name]">English Name:</label>
                <input type="text" id="service_benefits[${index}][en_name]" name="service_benefits[${index}][en_name]"  class="form-control  "><br>

                <label for="service_benefits[${index}][nl_name]">Dutch Name:</label>
                <input type="text" id="service_benefits[${index}][nl_name]" name="service_benefits[${index}][nl_name]"  class="form-control  "><br>

                <label for="service_benefits[${index}][en_description]">English Description:</label>
                <textarea id="service_benefits[${index}][en_description]" name="service_benefits[${index}][en_description]"  class="form-control  "></textarea><br>

                <label for="service_benefits[${index}][nl_description]">Dutch Description:</label>
                <textarea id="service_benefits[${index}][nl_description]" name="service_benefits[${index}][nl_description]"  class="form-control  "></textarea><br>
                <button type="button" class="delete-service_benefit">Delete Benefit</button>
            `;

            service_benefitsDiv.appendChild(newservice_benefit);
        });
        document.addEventListener('click', function(event) {
            if (event.target && event.target.classList.contains('delete-service_benefit')) {
                event.target.closest('.service_benefit').remove();
            }
        });



        document.getElementById('add-more-service-processes').addEventListener('click', function() {
            var serviceProcessesDiv = document.getElementById('service_processes');
            var index = serviceProcessesDiv.children.length;

            var newServiceProcess = document.createElement('div');
            newServiceProcess.className = 'service_process';

            newServiceProcess.innerHTML = `
            <h6>Service Process ${index+1} </h6>
                <label for="service_processes[${index}][en_name]">English Name:</label>
                <input type="text" id="service_processes[${index}][en_name]" name="service_processs[${index}][en_name]"  class="form-control  "><br>

                <label for="service_processs[${index}][nl_name]">Dutch Name:</label>
                <input type="text" id="service_processes[${index}][nl_name]" name="service_processs[${index}][nl_name]"  class="form-control  "><br>

                <label for="service_processes[${index}][step_no]">Step Number:</label>
                <input type="number" id="service_processes[${index}][step_no]" name="service_processs[${index}][step_no]"  class="form-control  "><br>

                <div class="process_procedure">
                    <label for="service_processes[${index}][process_procedures][0][en_name]">Procedure English Name:</label>
                    <input type="text" id="service_processes[${index}][process_procedures][0][en_name]" name="service_processs[${index}][process_procedures][0][en_name]"  class="form-control  "><br>

                    <label for="service_processes[${index}][process_procedures][0][nl_name]">Procedure Dutch Name:</label>
                    <input type="text" id="service_processes[${index}][process_procedures][0][nl_name]" name="service_processs[${index}][process_procedures][0][nl_name]"  class="form-control  "><br>

                    <label for="service_processes[${index}][process_procedures][0][en_description]">Procedure English Description:</label>
                    <textarea id="service_processes[${index}][process_procedures][0][en_description]" name="service_processs[${index}][process_procedures][0][en_description]"  class="form-control  "></textarea><br>

                    <label for="service_processes[${index}][process_procedures][0][nl_description]">Procedure Dutch Description:</label>
                    <textarea id="service_processes[${index}][process_procedures][0][nl_description]" name="service_processs[${index}][process_procedures][0][nl_description]"  class="form-control  "></textarea><br>

                    <button type="button" class="add-more-procedure" data-service-process-index="${index}">Add More Procedure</button>
                </div>
            `;

            serviceProcessesDiv.appendChild(newServiceProcess);
        });

        document.addEventListener('click', function(event) {
            if (event.target && event.target.classList.contains('add-more-procedure')) {
                var serviceProcessIndex = event.target.getAttribute('data-service-process-index');
                var procedureDiv = event.target.parentNode;
                var procedureIndex = procedureDiv.querySelectorAll('textarea').length / 2;

                var newProcedure = document.createElement('div');
                newProcedure.innerHTML = `
                    <label for="service_processes[${serviceProcessIndex}][process_procedures][${procedureIndex}][en_name]">Procedure English Name:</label>
                    <input type="text" id="service_processes[${serviceProcessIndex}][process_procedures][${procedureIndex}][en_name]" name="service_processs[${serviceProcessIndex}][process_procedures][${procedureIndex}][en_name]"  class="form-control  "><br>

                    <label for="service_processes[${serviceProcessIndex}][process_procedures][${procedureIndex}][nl_name]">Procedure Dutch Name:</label>
                    <input type="text" id="service_processes[${serviceProcessIndex}][process_procedures][${procedureIndex}][nl_name]" name="service_processs[${serviceProcessIndex}][process_procedures][${procedureIndex}][nl_name]"  class="form-control  "><br>

                    <label for="service_processes[${serviceProcessIndex}][process_procedures][${procedureIndex}][en_description]">Procedure English Description:</label>
                    <textarea id="service_processes[${serviceProcessIndex}][process_procedures][${procedureIndex}][en_description]" name="service_processs[${serviceProcessIndex}][process_procedures][${procedureIndex}][en_description]"  class="form-control  "></textarea><br>

                    <label for="service_processes[${serviceProcessIndex}][process_procedures][${procedureIndex}][nl_description]">Procedure Dutch Description:</label>
                    <textarea id="service_processes[${serviceProcessIndex}][process_procedures][${procedureIndex}][nl_description]" name="service_processs[${serviceProcessIndex}][process_procedures][${procedureIndex}][nl_description]"  class="form-control  "></textarea><br>
                `;

                procedureDiv.appendChild(newProcedure);
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
                <input type="text" id="client_testimonial[${index}][client_name]" name="client_testimonial[${index}][client_name]" class="form-control  "><br>

                <label for="client_testimonial[${index}][en_client_testimonial]"> Client Testemonial in English</label>
                <textarea id="client_testimonial[${index}][en_client_testimonial]" name="client_testimonial[${index}][en_client_testimonial]" class="form-control  "></textarea><br>

                <label for="client_testimonial[${index}][nl_client_testimonial]">Client Testemonial in Dutch</label>
                <textarea id="client_testimonial[${index}][nl_client_testimonial]" name="client_testimonial[${index}][nl_client_testimonial]" class="form-control  "></textarea><br>
                <button type="button" class="delete-client_testimonial">Delete Client Testimonial</button>
            `;

            client_testimonialsDiv.appendChild(newclient_testimonial);
        });
        document.addEventListener('click', function(event) {
            if (event.target && event.target.classList.contains('delete-client_testimonial')) {
                event.target.closest('.client_testimonial').remove();
            }
        });

        document.addEventListener('click', function(event) {
            if (event.target && event.target.classList.contains('delete-requirement')) {
                event.target.closest('.requirement').remove();
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
