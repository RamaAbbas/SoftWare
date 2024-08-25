@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Edit Service</div>

                    <div class="card-body">

                        <h1 style="display: none;">{{ $service->id }}</h1>

                        <form method="POST" action="{{ route('service.update', $service->id) }}">
                            @csrf
                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Service Name in
                                    English <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" id="name" required="required" class="form-control  "
                                        name="en_name" value="{{ old('en_name', $service->en_name) }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Service Name in
                                    Dutch <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" id="name" required="required" class="form-control  "
                                        name="nl_name" value={{ old('nl_name', $service->nl_name) }}>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="description">Description in
                                    English
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" id="description" required="required" class="form-control "
                                        name="en_description" value={{ old('en_description', $service->en_description) }}>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="description">Description in
                                    Dutch
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" id="description" required="required" class="form-control "
                                        name="nl_description" value={{ old('nl_description', $service->nl_description) }}>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="description">Title of
                                    Requirment in English
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" id="description" required="required" class="form-control "
                                        name="en_title_of_requirments">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="description">Title of
                                    Requirment in Dutch
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" id="description" required="required" class="form-control "
                                        name="nl_title_of_requirments">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="description">Title of How
                                    it Works in English
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" id="description" required="required" class="form-control "
                                        name="en_title_of_how_it_works">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="description">Title of How
                                    it Works in Dutch
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" id="description" required="required" class="form-control "
                                        name="nl_title_of_how_it_works">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="description">Title of
                                    Service Benefit in English
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" id="description" required="required" class="form-control "
                                        name="en_title_of_service_benefit">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="description">Title of
                                    Service Benefit in Dutch
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" id="description" required="required" class="form-control "
                                        name="nl_title_of_service_benefit">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="call_to_action" class="col-form-label col-md-3 col-sm-3 label-align">Title
                                    Call To Action
                                    in English
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input id="call_to_action" class="form-control col" type="text"
                                        name="en_title_call_to_action">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="call_to_action" class="col-form-label col-md-3 col-sm-3 label-align">Title
                                    Call To Action
                                    in Dutch
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input id="call_to_action" class="form-control col" type="text"
                                        name="nl_title_call_to_action">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="call_to_action" class="col-form-label col-md-3 col-sm-3 label-align">SubTitle
                                    Call To
                                    Action in English
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input id="call_to_action" class="form-control col" type="text"
                                        name="en_sub_title_call_to_action">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="call_to_action" class="col-form-label col-md-3 col-sm-3 label-align">SubTitle
                                    Call To
                                    Action in Dutch
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input id="call_to_action" class="form-control col" type="text"
                                        name="nl_sub_title_call_to_action">
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

                            <button type="submit" class="btn btn-primary">Update Service</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var a=l;
    </script>
@endsection
