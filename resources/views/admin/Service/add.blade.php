@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add Service</div>

                    <div class="card-body">


                        <form method="POST" action="{{ route('service.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value=""
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control" id="description" name="description"
                                    value="" required>
                            </div>

                            <div class="form-group">
                                <label for="requirments">Requirments</label>
                                <input type="text" class="form-control" id="email" name="requirments" value=""
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="coast">coast</label>
                                <input type="text" class="form-control" id="coast" name="coast" value="">
                            </div>

                            <div class="form-group">
                                <label for="for_whom">for_whom</label>
                                <input type="text" class="form-control" id="for_whom" name="for_whom" value="">
                            </div>

                            <button type="submit" class="btn btn-primary">Add Service</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let loca = "{{ Session::get('local') }}";
        let aa = localStorage.getItem('local');
        console.log(loca);
        console.log("FFFFFF");
        console.log(aa);
    </script>
@endsection
