
<nav class="navbar header-navbar pcoded-header">
    <div class="navbar-wrapper">
        <div class="navbar-logo">
            <a href="{{route(auth()->user()?->role.'.dashboard')}}">
                <h5>URL Shortner</h5>
            </a>
            <a class="mobile-menu" id="mobile-collapse" href="#!">
                <i class="feather icon-menu icon-toggle-right"></i>
            </a>
            <a class="mobile-options waves-effect waves-light">
                <i class="feather icon-more-horizontal"></i>
            </a>
        </div>
        <div class="navbar-container container-fluid">
           
            <ul class="nav-right">
                <li class="user-profile header-notification">

                    <div class="dropdown-primary dropdown">
                        <div class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{asset('admin/images/avatar-4.jpg')}}" class="img-radius" alt="User-Profile-Image">
                            <span>{{auth()->user()?->name}}</span>
                            <i class="feather icon-chevron-down"></i>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
