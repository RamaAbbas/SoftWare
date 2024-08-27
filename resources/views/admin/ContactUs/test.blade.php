@extends('layouts.app')

@section('content')
    <div role="main">
        <div class="container">
            <div class="row justify-content-center">
                <div class="container body">
                    <div class="">
                        <div class="page-title">
                            <div class="title_left">
                                <h3>Contact Us </h3>
                            </div class="title_left">

                            <div class="title_right">
                                <div class="col-md-2 col-sm-2 form-group pull-right top_search">

                                </div>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="card">
                            <div class="card-body">

                                <div class="col-md-10">
                                    <div class="x_panel">
                                        <div class="x_title">
                                            <h2> Active users <small></small></h2>
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
                                            <ul class="list-unstyled msg_list">
                                                @foreach ($contacts as $contact)
                                                    <li>

                                                        <a>

                                                            @foreach ($contact->contacts_messeges as $msg)
                                                                <span>

                                                                    <span class="time">{{ $msg->msg_send_at }}</span>

                                                                </span>

                                                                <span class="message" style="color">
                                                                    <strong>
                                                                        <h3 style="color:black;">{{ $msg->msg }}<h3>
                                                                    </strong>
                                                                </span>
                                                            @endforeach
                                                            <br>
                                                            <br>
                                                            <small class="name">
                                                                <span
                                                                    style="color: black;"><h6>{{ $contact->first_name }},{{ $contact->last_name }}</h6></span>

                                                            </small>

                                                            <small class="emali">
                                                                <span
                                                                    style="color: black;"><h6>{{ $contact->email }}</h6></span>

                                                            </small>

                                                            <small class="emali">
                                                                <span
                                                                    style="color: black;"><h6>{{ $contact->mobile_number }}</h6></span>

                                                            </small>


                                                        </a>
                                                    </li>
                                                    <br>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
@endsection
