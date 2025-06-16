@php($currentRouteName = Route::currentRouteName())
<nav class="pcoded-navbar">
    <div class="nav-list">
        <div class="pcoded-inner-navbar main-menu">
            <ul class="pcoded-item pcoded-left-item">
                <li class="{{in_array($currentRouteName,[auth()->user()?->role.'.dashboard']) ? 'active':''}}">
                    <a href="{{route(auth()->user()?->role.'.dashboard')}}" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                        <span class="pcoded-mtext">Dashboard</span>
                    </a>
                </li>
                @if(auth()->user()?->role==='super-admin')
                <li class="{{in_array($currentRouteName,['super-admin.client.list']) ? 'active':''}}">
                    <a href="{{route('super-admin.client.list')}}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fa fa-users icon-menu"></i>
                        </span>
                        <span class="pcoded-mtext">Clients</span>
                    </a>
                </li>
                @endif
                @if(in_array(auth()->user()?->role,['super-admin','admin']))
                <li class="{{in_array($currentRouteName,[auth()->user()?->role.'.members.list','admin.member.create']) ? 'active':''}}">
                    <a href="{{route(auth()->user()?->role.'.members.list')}}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fa fa-users icon-menu"></i>
                        </span>
                        <span class="pcoded-mtext">Members</span>
                    </a>
                </li>
                @endif
                <li class="{{in_array($currentRouteName,[auth()->user()?->role.'.short-url.list',auth()->user()?->role.'.short-url.create']) ? 'active':''}}">
                    <a href="{{route(auth()->user()?->role.'.short-url.list')}}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fa fa-users icon-menu"></i>
                        </span>
                        <span class="pcoded-mtext">Generated URL</span>
                    </a>
                </li>
                <li class="">
                    <a href="{{route('logout')}}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-log-out"></i>
                        </span>
                        <span class="pcoded-mtext">Logout</span>
                    </a>
                </li>
            </ul>

        </div>
    </div>
</nav>