@extends('layouts.app')

@section('content')
    <div role="main">
        <div class="container">
            <div class="row justify-content-center">
                <div class="container body">
                    <div class="">
                        <div class="page-title">
                            <div class="title_left">
                                <h3>Services</h3>
                            </div class="title_left">

                            <div class="title_right">
                                <div class="col-md-2 col-sm-2 form-group pull-right top_search">
                                    <div>
                                        <a href="{{ route('service.add') }}"><button class="btn-success">Add
                                                Service</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="card">
                            <div class="card-body">
                                @foreach ($services as $service)
                                    <div class="col-md-4 col-sm-6 ">
                                        <div class="x_panel">
                                            <div class="x_title">
                                                <h2>{{ $service->name }}</h2>
                                                <ul class="nav navbar-right panel_toolbox">
                                                    <li class="dropdown">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                                            role="button" aria-expanded="false" style="color: black;"><i
                                                                class="fa fa-cogs"></i></a>
                                                        <div></div>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item"
                                                                href="{{ route('service.edit', $service->id) }}">Edit</a>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="">
                                                            <form action="{{ route('service.delete', $service->id) }}"
                                                                method="POST" style="display:grid;"
                                                                onsubmit="return confirm('Are you sure you want to delete this Service?');">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"><i class="fa fa-times"></i></button>
                                                            </form>
                                                        </div>
                                                    </li>

                                                </ul>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="x_content">

                                                <div class="bs-example" data-example-id="simple-jumbotron">
                                                    <div class="jumbotron">
                                                        <h4>Description</h4>
                                                        <p>{{ $service->description }}</p>
                                                        <h4>Requirments</h4>
                                                        <p>{{ $service->requirments }}</p>
                                                        <h4>Coast</h4>
                                                        <h6>{{ $service->coast }}</h6>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
