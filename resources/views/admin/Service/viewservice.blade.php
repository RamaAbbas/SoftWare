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
                                            <h2>{{ $data['name'] }}</h2>
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
                                                        <form action="{{route('service.delete',$data['id'])}}" method="POST" style="display:grid;"
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


                                                    <br>

                                                    <h3 style="color: rgb(11, 212, 188)">Requirments</h3>
                                                    <h4 style="color: black">{{ $data['title_of_requirments'] }}</h4>
                                                    <ul>
                                                        @foreach ($data['requirments'] as $requirment)
                                                            <li style="color: black">
                                                                <strong>{{ $requirment['name'] }}</strong>&emsp;{{ $requirment['description'] }}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                    <br>

                                                    <h3 style="color: rgb(11, 212, 188)">Service Benefits</h3>
                                                    <h4 style="color: black">{{ $data['title_of_service_benefit'] }}</h4>
                                                    <ul>
                                                        @foreach ($data['service_benefits'] as $service_benefit)
                                                            <li style="color: black">
                                                                <strong>{{ $service_benefit['name'] }}</strong>&emsp;{{ $service_benefit['description'] }}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                    <br>

                                                    <h3 style="color: rgb(11, 212, 188)">Client Testimonial</h3>
                                                    <ul>
                                                        @foreach ($data['client_testimonial'] as $client_testimoniall)
                                                            <li style="color: black">
                                                                <strong>{{ $client_testimoniall['client_name'] }}</strong><br>&emsp;{{ $client_testimoniall['client_testimonial'] }}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                    <br>


                                                    <h3 style="color: rgb(11, 212, 188)">Service Process</h3>
                                                    <h4 style="color: black">{{ $data['title_of_how_it_works'] }}</h4>
                                                    <ul>
                                                        @foreach ($data['service_processes'] as $service_process)
                                                            <li><strong>{{ $service_process['name'] }}</strong><br></li>
                                                            <ul>
                                                                @foreach ($service_process['process_procedures'] as $process_procedure)
                                                                    <li style="color: black">
                                                                        <strong>{{ $process_procedure['name'] }}</strong><br>&emsp;{{ $process_procedure['description'] }}
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endforeach
                                                    </ul>
                                                    <br>



                                                    <h4 style="color: rgb(11, 212, 188)">Title Of Call To Action</h4>
                                                    <p style="color: black">{{ $data['title_call_to_action'] }}</p>
                                                    <br>

                                                    <h4 style="color: rgb(11, 212, 188)">SubTitle Of Call To Action</h4>
                                                    <p style="color: black">{{ $data['sub_title_call_to_action'] }}</p>
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
