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
                                @foreach ($contacts as $contact)
                                    <div class="col-md-4 col-sm-6 ">
                                        <div class="x_panel">
                                            <div class="x_title">
                                                <h2 style="color: rgb(11, 212, 188)">Person
                                                    <strong>{{ $contact->id }}</strong></h2>
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
                                                        <h4 style="color: rgb(11, 212, 188)">Name</h4>
                                                        <p style="color: black">
                                                            {{ $contact->first_name }},{{ $contact->first_name }}</p>
                                                        <h4 style="color: rgb(11, 212, 188)">Email</h4>
                                                        <p style="color: black">{{ $contact->email }}</p>
                                                        <h4 style="color: rgb(11, 212, 188)">Mobile Number</h4>
                                                        <h6 style="color: black">{{ $contact->mobile_number }}</h6>
                                                        @foreach ($contact->contacts_messeges as $msg)
                                                            <h4 style="color: rgb(11, 212, 188)">Message</h4>
                                                            <h6 style="color: black">{{ $msg->msg }}</h6>
                                                        @endforeach

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
