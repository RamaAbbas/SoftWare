@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Service</div>

                    <div class="card-body">


                        <form method="POST" action="{{ route('service.update', $service->id) }}">
                            @csrf

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name', $service->name) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" id="description" name="description"
                                    value="{{ old('description', $service->description) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="requirments">Requirments</label>
                                <input type="text" class="form-control" id="email" name="requirments"
                                    value="{{ old('requirments', $service->requirments) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="coast">coast</label>
                                <input type="text" class="form-control" id="coast" name="coast"
                                    value="{{ old('coast', $service->coast) }}">
                            </div>

                            <div class="form-group">
                                <label for="for_whom">for_whom</label>
                                <input type="text" class="form-control" id="for_whom" name="for_whom"
                                    value="{{ old('for_whom', $service->for_whom) }}">
                            </div>

                            <button type="submit" class="btn btn-primary">Update Service</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
