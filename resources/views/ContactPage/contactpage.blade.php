@extends('layouts.app')

@section('content')
    <div role="main">
        <div class="container">
            <div class="row justify-content-center">
                <div class="container body">
                    <div class="">
                        <div class="page-title">
                            <div class="title_left">
                                <h3>Contact Page</h3>
                            </div class="title_left">

                            <div class="title_right">
                                <div class="col-md-2 col-sm-2 form-group pull-right top_search">


                                    @if ($processedcontactpage->count() == 0)
                                        <div id="aa" style="display: none;">
                                            <a href=""><button class="btn-success">Add
                                                Details For Contact Page</button></a>
                                        </div>
                                    @endif


                                </div>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                        <div class="card">
                            <div class="card-body" id="cc">
                                <div class="row">
                                    @foreach ($processedcontactpage as $item)
                                        <div class="col-md-12">
                                            <div class="x_panel">
                                                <div class="x_title">
                                                    <h2 id="bb">Contact Page</h2>
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
                                                            <h3 style="color: rgb(11, 212, 188)">Title</h3>
                                                            <p style="color: black;">
                                                                <strong>{{ $item['title'] }}<strong>
                                                            </p>
                                                        </blockquote>
                                                        <blockquote>
                                                            <h3 style="color: rgb(11, 212, 188)">Sub Title</h3>
                                                            <p style="color: black;">
                                                                <strong>{{ $item['sub_title'] }}<strong>
                                                            </p>
                                                        </blockquote>

                                                        <blockquote class="blockquote-reverse">
                                                            <h3 style="color: rgb(11, 212, 188)">Steps</h3>
                                                            <h4 style="color: black">
                                                            </h4>
                                                            <ul>
                                                                @foreach ($item['contacts_whats_next'] as $contacts_whats_next)
                                                                    <li style="color: black">
                                                                        <strong>{{ $contacts_whats_next['step'] }}</strong><br>&emsp;
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                            <br>
                                                            </footer>
                                                        </blockquote>


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
            var testElement = document.getElementById('cc');
            const v=document.getElementById('aa');
            //   var TextInsideLi = document.getElementById('b').textContent ?? "a";

            if (testElement.classList.contains('bb')) {
                v.style.display = "none";
                console.log("AAAAAAAAAA");
            } else {
                v.style.display = "block";
                console.log("BBBBBBBBBBBBB");
            }
            /*  if(document.getElementById('b').textContent==null){
              }
              const a = document.getElementById('a');
              if (TextInsideLi == ""|| TextInsideLi=="a") {
                  a.style.display = "block";

              }
              if (TextInsideLi != "") {
                  a.style.display = "none";
              }
              if($processedAboutus==0){
                  a.style.display = "block";
              }*/

        });
    </script>
@endsection
