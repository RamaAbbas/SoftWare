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
                                                    <div class="center-horizontal">
                                                        <img src="{{ Storage::url($data['main_image']) }}"
                                                            data-bs-image="{{ Storage::url($data['main_image']) }}"
                                                            style="height: 100%; width:500px;" alt="Project Image"
                                                            class="img-fluid project-image" data-bs-toggle="modal"
                                                            data-bs-target="#imageModal">

                                                        <h3 style="color:black">More Project Images</h3>
                                                        <h4 style="color: black"></h4>
                                                        <ul class="navbar-right"
                                                            style="display: flex; align-items: center;">
                                                            @foreach ($data['images'] as $img)
                                                                <img src="{{ Storage::url($img['image_path']) }}"
                                                                    data-bs-image="{{ Storage::url($img['image_path']) }}"
                                                                    style="height: 150px; width:150px;" alt="Project Image"
                                                                    class="img-fluid project-image" data-bs-toggle="modal"
                                                                    data-bs-target="#imageModal">
                                                            @endforeach
                                                        </ul>
                                                        <br>
                                                    </div>

                                                    <div class="center-horizontal">
                                                        <h1 style="color: black">{{ $data['title'] }}</h1>

                                                        <h3 style="color: black">{{ $data['sub_title'] }}</h3>

                                                        <h4 style="color: black">{{ $data['description'] }}</h4>

                                                        <ul>
                                                            @foreach ($data['details'] as $item)
                                                                <li style="color: black">
                                                                    <strong>{{ $item['step'] }}</strong>&emsp;
                                                                </li>
                                                            @endforeach

                                                        </ul>

                                                    </div>


                                                    <div class="center-horizontal">

                                                        <h3 style="color: rgb(11, 212, 188)">Project Achievements</h3>
                                                        <h1>{{ $data['achievements']['title'] }}</h1>
                                                        <h3>{{ $data['achievements']['sub_title'] }}</h3>
                                                        <ul>
                                                            @foreach ($data['achievements']['more_details'] as $item)
                                                                <li style="color: black">
                                                                    <strong>{{ $item['step'] }}</strong>&emsp;
                                                                </li>
                                                            @endforeach

                                                        </ul>
                                                        <br>
                                                        <h3 style="color: rgb(11, 212, 188)">Challenges</h3>
                                                        <h1>{{ $data['challenges']['title'] }}</h1>
                                                        <h3>{{ $data['challenges']['sub_title'] }}</h3>
                                                        <ul>
                                                            @foreach ($data['achievements']['more_details'] as $item)
                                                                <li style="color: black">
                                                                    <strong>{{ $item['step'] }}</strong>&emsp;
                                                                </li>
                                                            @endforeach

                                                        </ul>
                                                        <br>

                                                        <h3 style="color: rgb(11, 212, 188)">Results</h3>
                                                        <h1>{{ $data['results']['title'] }}</h1>
                                                        <h3>{{ $data['results']['sub_title'] }}</h3>
                                                        <ul>
                                                            @foreach ($data['results']['more_details'] as $item)
                                                                <li style="color: black">
                                                                    <strong>{{ $item['step'] }}</strong>&emsp;
                                                                </li>
                                                            @endforeach

                                                        </ul>
                                                        <br>
                                                    </div>
                                                    <div class="center-horizontal">
                                                        <h3 style="color: rgb(11, 212, 188)">Client Review</h3>
                                                        <ul>

                                                            <h2>{{ $data['client_review']['title'] }}</h4>

                                                                <h3>{{ $data['client_review']['sub_title'] }}</h3>

                                                                <h4>{{ $data['client_review']['review'] }}</h4>
                                                                <h4 style="color: black"> Client Image</h4>

                                                                <img src="{{ Storage::url($data['client_review']['client_image']) }}"
                                                                    data-bs-image="{{ Storage::url($data['client_review']['client_image']) }}"
                                                                    style="height: 350px; width:350px;" alt="Project Image"
                                                                    class="img-fluid project-image" data-bs-toggle="modal"
                                                                    data-bs-target="#imageModal">



                                                        </ul>
                                                    </div>
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
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="" alt="Focused Image" id="modalImage">
                </div>
            </div>
        </div>
    </div>
    <style>
        .center-horizontal {
            width: 70%;
            /* or any width */
            margin: 0 auto;
            /* Automatically adjust left and right margins */
            text-align: center;
            /* Optional: Center text inside the div */
        }

        .project-image {
            cursor: pointer;
            transition: transform 0.2s ease-in-out;
        }

        .project-image:hover {
            transform: scale(1.05);
        }

        /* Optional: Adjust the size of the modal image */
        .modal-dialog img {
            width: 100%;
            height: auto;
        }
    </style>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var imageModal = document.getElementById('imageModal');
            var modalImage = document.getElementById('modalImage');

            imageModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var imageSrc = button.getAttribute(
                    'data-bs-image');
                modalImage.src = imageSrc;
            });
        });
    </script>
@endsection
