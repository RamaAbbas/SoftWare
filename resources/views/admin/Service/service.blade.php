@extends('layouts.app')
@section('content')
    <div role="main">
        <div class="container body">

            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3> Services <small> software</small> </h3>
                    </div>

                    <div class="title_right">
                        <div class="col-md-5 col-sm-5   form-group pull-right top_search">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search for...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">Go!</button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Media Gallery <small> SofwWare </small></h2>
                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                            aria-expanded="false"><i class="fa fa-wrench"></i></a>
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

                                <div class="row">
                                    @foreach ($services as $service)
                                        <div class="col-md-55">
                                            <div class="thumbnail">
                                                <div class="image view view-first">
                                                    <img style="width: 100%; display: block;"
                                                        src="{{ asset('docs/images/welcome.png') }}" alt="image" />
                                                    <div class="mask">
                                                        <p></p>
                                                        <div class="tools tools-bottom">
                                                            <a href="{{ route('service.show', $service->id) }}" ><i
                                                                    class="fa fa-link"></i></a>
                                                            <a href="{{ route('service.edit', $service->id) }}"><i
                                                                    class="fa fa-pencil"></i></a>
                                                          <!--  <a href=""><i
                                                                    class="fa fa-times"></i></a>-->
                                                            <!--     -->
                                                            <form action="{{ route('service.delete', $service->id) }}"
                                                                method="POST" style="display:grid;"
                                                                onsubmit="return confirm('Are you sure you want to delete this Service?');">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="" style="display:content"><i
                                                                        class="fa fa-times"></i></button>
                                                            </form>

                                                            <!-- -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="caption">
                                                    <p>{{ $service->name }}</p>
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

    <style>
        .container body {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
        }

        .badge {
            margin-bottom: 5px;
            font-size: 12px;
        }

        .btn-group .btn {
            margin-right: 5px;
        }

        .page-title {
            display: flex;
            justify-content: center;
        }

        .title_left {
            text-align: center;
        }

        .projects .progress {
            height: 8px;
        }

        .projects {
            width: 100% !important;
        }

        .projects .progress-bar {
            line-height: 8px;
        }

        .pagination-container {
            margin-top: 20px;
        }

        /* Ensure the action column is visible */
        .table-responsive {
            overflow-x: auto;
        }

        table th,
        table td {
            white-space: nowrap;
        }

        table th,
        table td {
            padding: 5px 10px;
        }

        /* Adjust padding for smaller screens */
        @media (max-width: 768px) {

            .title_right,
            .title_left {
                width: 100%;
                text-align: center;
            }

            .top_search {
                margin-bottom: 20px;
            }
        }
    </style>






    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
@endsection
