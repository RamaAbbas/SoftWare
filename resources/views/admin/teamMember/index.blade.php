@extends('layouts.app')
@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3> Members </h3>
            </div>

            <div class="title_right">
                <div class="col-md-2 col-sm-2 form-group pull-right top_search">
                    <div>
                        <a href="{{ route('member.add') }}"><button class="btn-success">Add New Member
                            </button></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Members</h2>
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
                            @foreach ($members as $member)
                                <div class="col-md-55">
                                    <div class="thumbnail">
                                        <div class="image view view-first">
                                            <img style="width: 100%; display: block;"
                                                src="{{ Storage::url($member->image_path) }}" alt="image" />
                                            <div class="mask">
                                                <div class="tools tools-bottom">
                                                    <div class="" style="height: 10px; width:10px">
                                                        <form action="{{ route('member.delete', $member->id) }}"
                                                            method="POST" style="display:grid;"
                                                            onsubmit="return confirm('Are you sure you want to delete this Member?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"><i class="fa fa-times"></i></button>
                                                        </form>
                                                    </div>

                                                    <a href="{{ route('member.edit', $member->id) }}"><i
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

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
