<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="" class="site_title"><i class="fa fa-heart"></i> <span>SoftWare</span></a><!--fron-home -->
        </div>
        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>{{ __('app.welcome_admin') }}</span>
                <h2></h2>
            </div>
        </div>

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <ul class="nav side-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('showhome')}}">
                            <i class="fa fa-home"></i>Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('showall.service') }}">
                            <i class="fa fa-tasks"></i> {{ __('app.service') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('showall.about-us') }}">
                            <i class="fa fa-list"></i> {{ __('app.about_us') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('showall.contact-us') }}">
                            <i class="fa fa-envelope"></i> {{ __('app.contact_us') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('showall.projects') }}">
                            <i class="fa fa-check"></i> Projects
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('showall.contact-page')}}">
                            <i class="fa fa-comment"></i>Contact Page
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('showall.members')}}">
                            <i class="fa fa-group"></i>Members
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('showall.herosection')}}">
                            <i class="fa fa-list"></i>Hero Section
                        </a>
                    </li>

                </ul>
            </div>
        </div>

        <!-- /sidebar menu -->
    </div>
</div>
