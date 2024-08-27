@extends('layouts.app')

@section('content')
    <div role="main">
        <div class="container">
            <div class="row justify-content-center">
                <div class="container body">
                    <div class="">
                        <div class="clearfix"></div>
                        <div class="card">
                            <div class="card-body">
                                <div class="col-md-12 col-sm-10 ">
                                    <div class="x_panel">
                                        <div class="x_title">
                                            <h2>{{ $data['title'] }}</h2>
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
                                                    <h4 style="color: black">{{ $data['description'] }}</h4>




                                                    <h3 style="color: rgb(11, 212, 188)">Achievements</h3>
                                                    <ul>
                                                        @foreach ($data['achievements'] as $achievements)
                                                            <li style="color: black">
                                                                <strong>{{ $achievements['achievement_name'] }}</strong>&emsp;
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                    <br>
                                                    <h3 style="color: rgb(11, 212, 188)">Challenges</h3>
                                                    <ul>
                                                        @foreach ($data['challenges'] as $challenges)
                                                            <li style="color: black">
                                                                <strong>{{ $challenges['challenge_name'] }}</strong>&emsp;{{ $challenges['challenge_description'] }}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                    <br>
                                                    <h3 style="color: rgb(11, 212, 188)">Project Technologies</h3>
                                                    <ul>
                                                        @foreach ($data['project_technologies'] as $project_technologies)
                                                            <li style="color: black">
                                                                <strong>{{ $project_technologies['tools'] }}</strong>&emsp;
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                    <br>
                                                    <h3 style="color: rgb(11, 212, 188)">Project Images</h3>
                                                    <h4 style="color: black"></h4>
                                                    <ul class="navbar-right" style="display: flex; align-items: center;">
                                                        @foreach ($data['project_images'] as $img)
                                                            <li style="color: black" class="nav-item">
                                                                <img src="{{ Storage::url($img['image_path']) }}"
                                                                    alt="" style="height: 150px; width:150px;">
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                    <br>
                                                    <h3 style="color: rgb(11, 212, 188)">Project Live Links</h3>
                                                    <ul>
                                                        @foreach ($data['project_live_links'] as $project_live_links)
                                                            <li style="color: black">
                                                                <strong>{{ $project_live_links['link'] }}</strong>&emsp;
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                    <br>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
