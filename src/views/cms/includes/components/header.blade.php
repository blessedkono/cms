<header class="header">
    <div class="logo-container">
        <a href="{{route('cms.dashboard.index')}}" class="logo">
            <img src="{{asset('cms/img/download.jpeg')}}" width="75" height="35" alt="Porto Admin">
        </a>
        <div class="d-md-none toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
            <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>

    <!-- start: search & user box -->

    <div class="header-right">


        <span class="d-xl-inline-block">
<!-- @include("includes/partials/lang") -->

        </span>
        <!-- <span class="separator"></span> -->

        @guest
            <br>
            <span class="">
            @lang("label.account?")
                {{ link_to('/login', __("label.login"), ['class' => 'btn btn-sm btn-default']) }}
                {{--                {{ link_to('/register', __("label.registration"), ['class' => 'btn btn-sm btn-default']) }}--}}
                &nbsp;
        </span>
        @endguest




        @auth
{{--            <ul class="notifications" id="notification_alerts">--}}
{{--                @include('includes.components.notification_alerts')--}}
{{--            </ul>--}}
            <span class="separator"></span>

            <div id="userbox" class="userbox">
                <a href="#" data-toggle="dropdown">
                    <div class="profile-info" data-lock-name="{{ access()->user()->fullname }}" data-lock-email="{{ access()->user()->email }}">
                        <span class="name"></span>
                        @auth
                            <span class="name"> <span class="badge badge-pill badge-success">&nbsp;</span> {!!  access()->user()->firstname !!}</span>
                        @endauth
                    </div>
                    <i class="fa custom-caret"></i>
                </a>

                <div class="dropdown-menu">
                    <ul class="list-unstyled">
                        <li class="divider"></li>
                        <li>
                            <a role="menuitem" tabindex="-1" href="{!! route('cms.dashboard.index') !!}"><i class="fas fa-user"></i> @lang('label.my_profile')</a>
                        </li>
                        <li>
                            {!! Form::open(['route' => 'logout', 'id' => 'logout-form']) !!}
                            {!! Form::close() !!}
                            <a role="menuitem" tabindex="-1" href="{{ route("logout") }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-power-off"></i> @lang("label.logout") </a>
                        </li>
                    </ul>
                </div>
            </div>

        @endauth
    </div>    <!-- end: search & user box -->
</header>
