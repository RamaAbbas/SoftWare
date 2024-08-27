@extends('layouts.app')

@section('content')
    <div role="main">
        <div class="container">
            <div class="row justify-content-center">
                <div class="container body">
                    <div class="">
                        <div class="page-title">
                            <div class="title_left">
                                <h3>Projects</h3>
                            </div class="title_left">

                            <div class="title_right">
                                <div class="col-md-2 col-sm-2 form-group pull-right top_search">
                                    <div>
                                        <a href="{{route('project.add')}}"><button
                                                class="btn-success">Add New Project
                                            </button></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="card">
                            <div class="card-body">
                                @foreach ($processedproject as $project)
                                    <div class="col-md-12 col-sm-6 ">
                                        <div class="x_panel">
                                            <div class="x_title">
                                                <h2>{{ $project['title'] }}</h2>
                                                <ul class="nav navbar-right panel_toolbox">
                                                    <li class="dropdown">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                                            role="button" aria-expanded="false" style="color: black;"><i
                                                                class="fa fa-cogs"></i></a>
                                                        <div></div>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item" href="">Edit</a>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="">
                                                            <form action="" method="POST" style="display:grid;"
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
                                                        <h3 style="color: rgb(11, 212, 188)">Description</h3>
                                                        <p style="color: black">{{ $project['description'] }}</p>

                                                    </div>
                                                </div>

                                            </div>
                                            <button class="">
                                                <a class="" href="{{route('project.view', $project['id'])}}">{{__('app.show_more_details')}}
                                                </a>
                                            </button>
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
