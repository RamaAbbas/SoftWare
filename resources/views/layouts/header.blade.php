<div class="top_nav">
    <div class="nav_menu">
        <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>
        <nav class="nav navbar-nav">
            <ul class="navbar-right" style="display: flex; align-items: center;">
                <!-- User Profile Dropdown -->
                <li class="nav-item dropdown" style="margin-right: 15px;">
                    <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="images/img.jpg" alt="" style="width: 30px; height: 30px; border-radius: 50%;">

                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="javascript:;">{{__('app.profile')}}</a>
                        <a class="dropdown-item" href="javascript:;">
                            <span class="badge bg-red pull-right">50%</span>
                            <span>{{__('app.admin_setting')}}</span>
                        </a>
                        <a class="dropdown-item" href="javascript:;">{{__('app.help')}}</a>
                        <a class="dropdown-item" href=""
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out pull-right"></i> {{__('app.log_out')}}
                        </a>
                        <form id="logout-form" action="" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>

                <!-- Language Switcher Dropdown -->
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownLang" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{__('app.language')}}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownLang">
                        <a class="dropdown-item" href="{{url('api/setlocale/en')}}">{{__("app.english")}}</a>
                        <a class="dropdown-item" href="{{ url('api/setlocale/nl')}}">{{__('app.dutch')}}</a>
                        <a class="dropdown-item" href="{{ url('api/setlocale/ar')}}">{{__('app.arabic')}}</a>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</div>

<!-- Include jQuery and Bootstrap JS for dropdown functionality -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<!-- Additional CSS for styling -->
<style>
    .nav_menu {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #2A3F54 !important;
        border-bottom: 1px solid #D9DEE4;
        margin-bottom: 5px;
        width: 100%;
        height: 58px;
        position: relative;
    }

    .navbar-right .nav-item {
        margin-left: 15px;
    }

    .navbar-right .dropdown-menu {
        min-width: 150px;
    }

    .navbar-right .dropdown-toggle {
        display: flex;
        align-items: center;
        color: white;
        /* Set text color to white */
    }

    .navbar-right .dropdown-toggle img {
        margin-right: 10px;
    }

    .dropdown-item {
        color: #333;
        /* Default color for dropdown items */
    }

    .dropdown-item:hover {
        color: #fff;
        /* White color on hover */
        background-color: #1ABB9C;
        /* Background color on hover */
    }
</style>

<!-- Custom JavaScript for dropdown functionality -->
<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
        $('.dropdown-toggle').dropdown(); // Initialize dropdowns

        $('#menu_toggle').on('click', function() {
            $('.left_col').toggleClass('nav-md nav-sm');
            $('.right_col').toggleClass('nav-md nav-sm');
        });

        window.toggleFullScreen = function() {
            if (!document.fullscreenElement) {
                document.documentElement.requestFullscreen();
            } else {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                }
            }
        };

        window.lockScreen = function() {
            if (confirm('Do you want to lock the screen?')) {
                window.location.href = '/lock'; // Adjust the URL to your lock screen route
            }
        };
    });
</script>
