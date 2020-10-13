<aside id="sidebar-left" class="sidebar-left">

    <div class="sidebar-header">
        <div class="sidebar-title">
            Navigation
        </div>
        <div class="sidebar-toggle d-none d-md-block" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
            <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>

    <div class="nano has-scrollbar">
        <div class="nano-content" tabindex="0" style="right: -15px;">
            <nav id="menu" class="nav-main" role="navigation">

                <ul class="nav nav-main">
                    <li>
                        <a class="nav-link" href="{!! route('user.profile', access()->user()) !!}">
                            <i class="fas fa-user" aria-hidden="true"></i>
                            <span class="side_link">{!! __('label.my_profile') !!}</span>
                        </a>
                    </li>


                    <li>
                        <a class="nav-link" href="{!! route('admin.index') !!}">
                            <i class="fas fa-columns" aria-hidden="true"></i>
                            <span class="side_link">{!! 'Admin ' .__('label.dashboard') !!} <br/>
                          </span>
                        </a>
                    </li>


                    <li>
                        <a class="nav-link" href="{!! route('admin.report.index') !!}">
                            <i class="fas fa-list" aria-hidden="true"></i>
                            <span class="side_link">{!! __('label.administrator.system.reports.reports') !!}  <br/>
                               </span>
                        </a>
                    </li>


                    <li>
                        <a class="nav-link" href="{!! route('admin.user_manage.index') !!}">
                            <i class="fas fa-users" aria-hidden="true"></i>
                            <span class="side_link">{!! __('label.administrator.users.manage_users') !!}  <br/>
                                </span>
                        </a>
                    </li>

                    <li>
                        <a class="nav-link" href="{!! route('admin.system_menu') !!}">
                            <i class="fas fa-cog" aria-hidden="true"></i>
                            <span class="side_link">{!! __('label.system') !!}  <br/>
                                </span>
                        </a>
                    </li>


                    <li>
                        <a class="nav-link" href="{!! route('workflow.index') !!}">
                            <i class="fas fa-signal" aria-hidden="true"></i>
                            <span class="side_link">{!! __('label.administrator.system.workflow.settings') !!}  <br/>
                                </span>
                        </a>
                    </li>

                    <li>
                        <a class="nav-link" href="{!! route('system.manage_jobs') !!}">
                            <i class="fas fa-tasks" aria-hidden="true"></i>
                            <span class="side_link">{!! __('label.administrator.system.jobs.manage_jobs')  !!}
                                </span>

                            @if((sysdef()->pendingJobsCount() > 0))
                                @if((sysdef()->pendingJobsCount() > sysdef()->data('THMJCA')))
                                    {{--Alert--}}
                                    &nbsp;<span class="badge badge-pill badge-danger" style="font-size:10px">{{ number_0_format(sysdef()->pendingJobsCount())  }} <br/></span>
                                @else
                                    {{--ok--}}
                                    &nbsp;<span class="badge badge-pill badge-success" style="font-size:10px">{{ number_0_format(sysdef()->pendingJobsCount())  }} <br/></span>
                                @endif
                            @endif
                        </a>
                    </li>



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
