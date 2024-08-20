@extends('layouts.app')

@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Service Form</h3>
                </div>

                <div class="title_right">

                </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">

                <div class="col-md-10 col-sm-10 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Service <small></small></h2>
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


                            <p>Please fill this Form To add Service
                            </p>
                            <div id="wizard" class="form_wizard wizard_horizontal">
                                <ul class="wizard_steps">
                                    <li>
                                        <a href="#step-1">
                                            <span class="step_no">1</span>
                                            <span class="step_descr">
                                                Step 1<br />
                                                <small>Services</small>
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
                                </ul>
                                <div id="step-1">
                                    <form class="form-horizontal form-label-left" id="form1">
                                        @csrf
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                for="name" >Service Name <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input type="text" id="name" required="required"
                                                    class="form-control  " name="name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align"
                                                for="description">Description
                                                <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input type="text" id="description"  required="required"
                                                    class="form-control " name="description">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="call_to_action"
                                                class="col-form-label col-md-3 col-sm-3 label-align">Call To Action
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input id="call_to_action" class="form-control col" type="text"
                                                    name="call_to_action">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align">Client Testimonial
                                                <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input id="client_testimonial" class="date-picker form-control" required="required"
                                                    type="text" name="client_testimonial">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align">Cost
                                                <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input id="cost" class="date-picker form-control" required="required"
                                                    type="text" name="cost">
                                            </div>
                                        </div>

                                        <!-- -->

                                    </form>

                                </div>
                                <div id="step-2">
                                    <h2 class="StepTitle">Requirment</h2>
                                    <form class="form-horizontal form-label-left" id="form2">
                                        @csrf
                                        <input type="hidden" name="requirment[]">
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align">Name
                                                <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input id="birthday" class="date-picker form-control" required="required"
                                                    type="text" name="requirment[0][name]">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align">Description
                                                <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input id="birthday" class="date-picker form-control"
                                                    required="required" type="text">
                                            </div>
                                        </div>
                                    </form>

                                </div>

                                <div id="step-3">
                                    <h2 class="StepTitle">Service Benefits</h2>
                                    <form class="form-horizontal form-label-left" id="form3">
                                        @csrf
                                        <input type="hidden" name="service_benefits[]">
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align">Name
                                                <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input id="birthday" class="date-picker form-control"
                                                    required="required" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align">Description
                                                <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input id="birthday" class="date-picker form-control"
                                                    required="required" type="text">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div id="step-4">
                                    <h2 class="StepTitle">Service Processs</h2>
                                    <form class="form-horizontal form-label-left" id="form4">
                                        @csrf
                                        <input type="hidden" name="service_processs[]">
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align">Step Number
                                                <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input id="birthday" class="date-picker form-control"
                                                    required="required" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align">Name
                                                <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input id="birthday" class="date-picker form-control"
                                                    required="required" type="text">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3 col-sm-3 label-align">Description
                                                <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 ">
                                                <input id="birthday" class="date-picker form-control"
                                                    required="required" type="text">
                                            </div>
                                        </div>
                                    </form>
                                </div>


                            </div>
                            <!--   -->
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
            combinedForm.action = '{{ route('service.store') }}';

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
    </script>
@endsection
