<aside id="sidebar-left" class="sidebar-left">

    <div class="sidebar-header">
        <div class="sidebar-title">
            {{ __('label.navigation')  }}
        </div>
        <div class="sidebar-toggle d-none d-md-block" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
            <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>

    <div class="nano has-scrollbar">
        <div class="nano-content" tabindex="0" style="right: -15px;">
            <nav id="menu" class="nav-main" role="navigation">

                <ul class="nav nav-main">
                    {{--<li>--}}
                        {{--<a class="nav-link" href="{!! route('user.profile', access()->user()) !!}">--}}
                            {{--<i class="fas fa-user" aria-hidden="true"></i>--}}
                            {{--<span class="side_link">{!! __('label.my_profile') !!}</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}

                    {{--Pending workflow--}}
                    <li {!! setSideBarActiveUrlMultiple(['workflow/pending', 'workflow/pending_station'])  !!}>

                            @permission('hq_menu')
                        <a class="nav-link" href="{!! route('workflow.pending') !!}">
                            <i class="fas fa-bell" aria-hidden="true"></i>
                            <span class="side_link">{!! __('label.administrator.system.workflow.pendings') !!}
                                </span>
                            @if(access()->getWorkflowPendingCount() > 0)
                                &nbsp;<span class="badge badge-pill badge-warning pull-right" style="font-size:10px">{{ number_0_format(access()->getWorkflowPendingCount())  }} <br/></span>
                            @endif
                        </a>
                            @endauth

                            @permission('station_menu')
                        <a class="nav-link" href="{!! route('workflow.pending_station') !!}">
                            <i class="fas fa-bell" aria-hidden="true"></i>
                            <span class="side_link">{!! __('label.administrator.system.workflow.pendings') !!}
                                </span>
                            @if(access()->getWorkflowPendingForStationStaffCount() > 0)
                                &nbsp;<span class="badge badge-pill badge-warning pull-right" style="font-size:10px">{{ number_0_format(access()->getWorkflowPendingForStationStaffCount())  }} <br/></span>
                            @endif
                        </a>
                            @endauth

                    </li>

                    <li {!! setSideBarActiveUrl('alert_monitor/index') !!}>
                        @permission('view_alert_monitor')
                        <a class="nav-link" href="{!! route('alert_monitor.index') !!}">
                            <i class="fas fa-desktop" aria-hidden="true"></i>
                            <span class="side_link">{!! __('menu.sidebar.alert_monitor') !!}</span>
                            @if(access()->getAllAlertMonitorCount() > 0)

                            &nbsp;<span class="badge badge-pill badge-info pull-right" style="font-size:10px">{{ number_0_format(access()->getAllAlertMonitorCount())  }} <br/></span>
                            @endif

                        </a>
                        @endauth
                    </li>

                    {{--Open menus  (Station and hq )--}}
                    @include('includes/components/left_sidebars/includes/open_menu')

                    {{--hq onLY mENUS--}}
                    {{--@permission('hq_menu')--}}
                    @include('includes/components/left_sidebars/includes/hq_only_menu')
                    {{--@endauth--}}

                </ul>
            </nav>

            <hr class="separator">



        </div>

        <script>
            // Maintain Scroll Position
            if (typeof localStorage !== 'undefined') {
                if (localStorage.getItem('sidebar-left-position') !== null) {
                    var initialPosition = localStorage.getItem('sidebar-left-position'),
                        sidebarLeft = document.querySelector('#sidebar-left .nano-content');

                    sidebarLeft.scrollTop = initialPosition;
                }
            }
        </script>


        <div class="nano-pane" style="opacity: 1; visibility: visible;"><div class="nano-slider" style="height: 428px; transform: translate(0px, 0px);"></div></div></div>

</aside>
