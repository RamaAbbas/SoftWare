@extends('layouts.app')

@section('content')
    <div role="main">
        <div class="container">
            <div class="row justify-content-center">
                <div class="container body">
                    <div class="">
                        <div class="page-title">
                            <div class="title_left">
                                <h3>Home Page</h3>
                            </div class="title_left">

                            <div class="title_right">
                                <div class="col-md-2 col-sm-2 form-group pull-right top_search">
                                </div>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="card">
                            <div class="card-body" id="c">
                                <div class="row">
                                    @foreach ($processedAboutus as $aboutus)
                                        <div class="col-md-12">
                                            <div class="x_panel">
                                                <div class="x_title">
                                                    <h2 id="b">{{ $aboutus['company_name'] }} </h2>
                                                    <ul class="nav navbar-right panel_toolbox">
                                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                                        </li>
                                                        <li class="dropdown">
                                                            <a href="" class="dropdown-toggle" data-toggle="dropdown"
                                                                role="button" aria-expanded="false"><i
                                                                    class="fa fa-wrench"></i></a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                <a class="dropdown-item" href="">Edit</a>
                                                            </div>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                <a class="dropdown-item" href="#">Settings 1</a>
                                                                <a class="dropdown-item" href="#">Settings 2</a>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="">
                                                                <form action="" method="POST" style="display:grid;"
                                                                    onsubmit="return confirm('Are you sure you want to About us?');">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"><i
                                                                            class="fa fa-times"></i></button>
                                                                </form>
                                                            </div>
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
                                                <h3>Hero Section</h3>

                                                <div class="row">
                                                    @foreach ($processed as $process)
                                                        <div class="col-md-55">
                                                            <div class="thumbnail">
                                                                <div class="image view view-first">
                                                                    <img style="width: 100%; display: block;"
                                                                        src="{{ Storage::url($process['image_path']) }}"
                                                                        alt="image" />
                                                                    <div class="mask">

                                                                        <div class="tools tools-bottom">
                                                                            <div class=""
                                                                                style="height: 10px; width:10px">
                                                                                <form
                                                                                    action="{{ route('section.delete', $process['id']) }}"
                                                                                    method="POST" style="display:grid;"
                                                                                    onsubmit="return confirm('Are you sure you want to delete this Member?');">
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <button type="submit"><i
                                                                                            class="fa fa-times"></i></button>
                                                                                </form>
                                                                            </div>

                                                                            <a
                                                                                href="{{ route('section.edit', $process['id']) }}"><i
                                                                                    class="fa fa-pencil"></i></a>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="caption">
                                                                    <span><strong>{{ $process['title'] }}</strong></span><br>
                                                                    <strong>{{ $process['sub_title'] }}</strong>


                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                    @endforeach

                                                </div>


                                                <div class="clearfix"></div>
                                                <h3>Team Members</h3>
                                                <div class="row">
                                                    @foreach ($members as $member)
                                                        <div class="col-md-55">
                                                            <div class="thumbnail">
                                                                <div class="image view view-first">
                                                                    <img style="width: 100%; display: block;"
                                                                        src="{{ Storage::url($member->image_path) }}"
                                                                        alt="image" />
                                                                    <div class="mask">
                                                                        <div class="tools tools-bottom">
                                                                            <div class=""
                                                                                style="height: 10px; width:10px">
                                                                                <form
                                                                                    action="{{ route('member.delete', $member->id) }}"
                                                                                    method="POST" style="display:grid;"
                                                                                    onsubmit="return confirm('Are you sure you want to delete this Member?');">
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <button type="submit"><i
                                                                                            class="fa fa-times"></i></button>
                                                                                </form>
                                                                            </div>

                                                                            <a
                                                                                href="{{ route('member.edit', $member->id) }}"><i
                                                                                    class="fa fa-pencil"></i></a>



                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="caption">
                                                                    <span><strong>{{ $member->name }}</strong></span><br>
                                                                    <strong>{{ $member->position }}</strong>
                                                                    <p>{{ $member->description }}</p>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                    @endforeach

                                                    <div class="clearfix"></div>
                                                    <h3>Services</h3>
                                                    @foreach ($processedServices as $service)
                                                        <div class="col-md-12 col-sm-6 ">
                                                            <div class="x_panel">
                                                                <div class="x_title">
                                                                    <h2>{{ $service['name'] }}</h2>
                                                                    <ul class="nav navbar-right panel_toolbox">
                                                                        <li class="dropdown">
                                                                            <a href="#" class="dropdown-toggle"
                                                                                data-toggle="dropdown" role="button"
                                                                                aria-expanded="false"
                                                                                style="color: black;"><i
                                                                                    class="fa fa-cogs"></i></a>
                                                                            <div></div>
                                                                            <div class="dropdown-menu"
                                                                                aria-labelledby="dropdownMenuButton">
                                                                                <a class="dropdown-item"
                                                                                    href="{{ route('service.edit', $service['id']) }}">Edit</a>
                                                                            </div>
                                                                        </li>
                                                                        <li>
                                                                            <div class="">
                                                                                <form
                                                                                    action="{{ route('service.delete', $service['id']) }}"
                                                                                    method="POST" style="display:grid;"
                                                                                    onsubmit="return confirm('Are you sure you want to delete this Service?');">
                                                                                    @csrf
                                                                                    @method('DELETE')
                                                                                    <button type="submit"><i
                                                                                            class="fa fa-times"></i></button>
                                                                                </form>
                                                                            </div>
                                                                        </li>

                                                                    </ul>
                                                                    <div class="clearfix"></div>
                                                                </div>
                                                                <div class="x_content">

                                                                    <div class="bs-example"
                                                                        data-example-id="simple-jumbotron">
                                                                        <div class="jumbotron">
                                                                            <h3 style="color: rgb(11, 212, 188)">
                                                                                Description</h3>
                                                                            <p style="color: black">
                                                                                {{ $service['description'] }}</p>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <button class="">
                                                                    <a class=""
                                                                        href="{{ route('service.view', $service['id']) }}">{{ __('app.show_more_details') }}
                                                                    </a>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    @endforeach

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
    <script></script>
@endsection
