@extends('layouts.app')

@section('content')
    <div role="main">
        <div class="container">
            <div class="row justify-content-center">
                <div class="container body">
                    <div class="">
                        <div class="page-title">
                            <div class="title_left">
                                <h3>About Us</h3>
                            </div class="title_left">

                            <div class="title_right">
                                <div class="col-md-2 col-sm-2 form-group pull-right top_search">
                                    <div id="a" style="display: none;">
                                        <a href="{{ route('about-us.add') }}"><button class="btn-success">Add
                                                AboutUs</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($processedAboutus as $aboutus)
                                        <div class="col-md-12">
                                            <div class="x_panel">
                                                <div class="x_title">
                                                    <h2 id="b">{{ $aboutus['company_name'] }}</h2>
                                                    <ul class="nav navbar-right panel_toolbox">
                                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                        </li>
                                                        <li class="dropdown">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                                                role="button" aria-expanded="false"><i
                                                                    class="fa fa-wrench"></i></a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                <a class="dropdown-item" href="#">Settings 1</a>
                                                                <a class="dropdown-item" href="#">Settings 2</a>
                                                            </div>
                                                        </li>
                                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                                        </li>
                                                    </ul>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="x_content">

                                                    <div class="col-md-8 col-lg-8 col-sm-7">
                                                        <!-- blockquote -->
                                                        <blockquote>
                                                            <h3 style="color: rgb(11, 212, 188)">Introduction</h3>
                                                            <p style="color: black;">
                                                                <strong>{{ $aboutus['introduction'] }}<strong>
                                                            </p>
                                                        </blockquote>

                                                        <blockquote class="blockquote-reverse">
                                                            <h3 style="color: rgb(11, 212, 188)">For Who</h3>
                                                            <h4 style="color: black">{{ $aboutus['title_for_who'] }}
                                                            </h4>
                                                            <ul>
                                                                @foreach ($aboutus['for_who_services'] as $for_who_service)
                                                                    <li style="color: black">
                                                                        <strong>{{ $for_who_service['name_of_service_for_who'] }}</strong><br>&emsp;{{ $for_who_service['description_of_service_for_who'] }}
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                            <br>
                                                            </footer>
                                                        </blockquote>
                                                        <blockquote class="blockquote-reverse">
                                                            <h3 style="color: rgb(11, 212, 188)">Steps Process</h3>
                                                            <h4 style="color: black">{{ $aboutus['title_steps_process'] }}
                                                            </h4>
                                                            <ul>
                                                                @foreach ($aboutus['steps_process'] as $steps_process)
                                                                    <li style="color: black">
                                                                        <strong>{{ $steps_process['process_name'] }}</strong><br>&emsp;{{ $steps_process['process_description'] }}
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                            <br>
                                                            </footer>
                                                        </blockquote>
                                                        <blockquote class="blockquote-reverse">
                                                            <h3 style="color: rgb(11, 212, 188)">Client Testimoial</h3>
                                                            </h4>
                                                            <ul>
                                                                @foreach ($aboutus['client_testimonial'] as $client_testimonial)
                                                                    <li style="color: black">
                                                                        <strong>{{ $client_testimonial['client_name'] }}</strong><br>&emsp;{{ $client_testimonial['client_testimonial'] }}
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                            <br>
                                                            </footer>
                                                        </blockquote>
                                                    </div>
                                                    <div class="col-md-4 col-lg-4 col-sm-5">
                                                        <h2 style="color: rgb(11, 212, 188)">Our Mission</h2>
                                                        <P style="color: black">
                                                            <strong>{{ $aboutus['our_mission'] }}</strong>
                                                        </P>
                                                        <h2 style="color: rgb(11, 212, 188)">Our Goals</h2>
                                                        <P style="color: black">
                                                            <strong>{{ $aboutus['our_goals'] }}</strong>
                                                        </P>
                                                        <h2 style="color: rgb(11, 212, 188)">Our Partners Associates</h2>
                                                        <P style="color: black">
                                                            <strong>{{ $aboutus['our_partners_associates'] }}</strong>
                                                        </P>
                                                    </div>

                                                    <div class="clearfix"></div>
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
    </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            //  var TextInsideLi = document.getElementsByTagName('h2')[0].innerHTML;
            var TextInsideLi = document.getElementById('b').textContent;
            const a = document.getElementById('a');
            if (TextInsideLi == "") {
                a.style.display = "block";

            }
            if (TextInsideLi != "") {
                a.style.display = "none";
            }

        });
    </script>
@endsection
