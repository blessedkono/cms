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
                            <span>{!! __('label.my_profile') !!}</span>
                        </a>
                    </li>

                    {{--Pending workflow--}}
                    <li>
                        <a class="nav-link" href="{!! route('workflow.pending') !!}">
                            <i class="fas fa-bell" aria-hidden="true"></i>
                            <span>{!! __('label.administrator.system.workflow.pendings') !!}
                                </span>

                            @if(access()->getWorkflowPendingCount() > 0)
                                &nbsp;<span class="badge badge-pill badge-warning pull-right" style="font-size:10px">{{ number_0_format(access()->getWorkflowPendingCount())  }} <br/></span>
                            @endif
                        </a>
                    </li>

                    <li>
                        <a class="nav-link" href="{!! route('operation.sales.menu') !!}">
                            <i class="fas fa-money-bill-alt" aria-hidden="true"></i>
                            <span>{!! __('menu.sales.index') !!}  <br/>
                               </span>
                        </a>
                    </li>

                    <li>
                        <a class="nav-link" href="{!! route('operation.sales.discount.menu') !!}">
                            <i class="fas fa-money-check" aria-hidden="true"></i>
                            <span>{!! __('menu.sidebar.discount_management') !!}  <br/>
                               </span>
                        </a>
                    </li>


                    <li>
                        <a class="nav-link" href="{!! route('operation.expense.menu') !!}">
                            <i class="fas fa-dollar-sign" aria-hidden="true"></i>
                            <span>{!! __('menu.expense.index') !!}  <br/>
                               </span>
                        </a>
                    </li>


                    <li>
                        <a class="nav-link" href="{!! route('operation.station.menu') !!}">
                            <i class="fas fa-boxes" aria-hidden="true"></i>
                            <span>{!! __('menu.sidebar.station_management') !!}  <br/>
                               </span>
                        </a>
                    </li>


                    <li>
                        <a class="nav-link" href="{!! route('operation.stock.product.menu') !!}">
                            <i class="fas fa-store" aria-hidden="true"></i>
                            <span>{!! __('menu.sidebar.stock_management') !!}  <br/>
                               </span>
                        </a>
                    </li>


                    <li>
                        <a class="nav-link" href="{!! route('operation.purchase.menu') !!}">
                            <i class="fas fa-money-check" aria-hidden="true"></i>
                            <span>{!! __('menu.purchase.index') !!}  <br/>
                               </span>
                        </a>
                    </li>


                    <li>
                        <a class="nav-link" href="{!! route('hr.employee.menu') !!}">
                            <i class="fas fa-users" aria-hidden="true"></i>
                            <span>{!! __('menu.sidebar.employee_management') !!}  <br/>
                               </span>
                        </a>
                    </li>


                    <li>
                        <a class="nav-link" href="{!! route('hr.payroll.menu') !!}">
                            <i class="fas fa-money-check-alt" aria-hidden="true"></i>
                            <span>{!! __('menu.sidebar.payroll_management') !!}  <br/>
                               </span>
                        </a>
                    </li>

                    <li>
                        <a class="nav-link" href="{!! route('operation.client.menu') !!}">
                            <i class="fas fa-handshake" aria-hidden="true"></i>
                            <span>{!! __('menu.sidebar.client_management') !!}  <br/>
                               </span>
                        </a>
                    </li>

                    <li>
                        <a class="nav-link" href="{!! route('operation.supplier.menu') !!}">
                            <i class="fas fa-building" aria-hidden="true"></i>
                            <span>{!! __('menu.sidebar.supplier_management') !!}  <br/>
                               </span>
                        </a>
                    </li>

                    <li>
                        <a class="nav-link" href="{!! route('operation.vehicle.menu') !!}">
                            <i class="fas fa-truck-moving" aria-hidden="true"></i>
                            <span>{!! __('menu.sidebar.vehicle_management') !!}  <br/>
                               </span>
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
