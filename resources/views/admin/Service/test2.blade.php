@extends('layouts.app')


@section('content')
    <div class="card">
        <div class="container body">
            <div class="main_container">

                <div class="table-responsive">
                    @foreach ($services as $service)
                        <div class="col-md-4 col-sm-6 ">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>{{ $service->name }} <small></small></h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                                aria-expanded="false" style="color: black;"><i class="fa fa-cogs"></i></a>
                                            <div></div>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item"
                                                    href="{{ route('service.edit', $service->id) }}">Edit</a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="">
                                                <form action="{{ route('service.delete', $service->id) }}" method="POST"
                                                    style="display:grid;"
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
@endsection
