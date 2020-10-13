

{{--oPEN MENUS - station - hq--}}

@permission('view_executive_dashboard')
<li class="nav-parent {!! setSideBarDashboardActiveUrl() !!}"  >
    <a style="" class="nav-link" href="#">
        <i class="fas fa-chart-bar" aria-hidden="true"></i>
        <span class="side_link">{!! __('label.dashboard_report.dashboard_analytics') !!}</span>
    </a>
    <ul class="nav nav-children" style="">
        <li {!! setSideBarActiveUrl('dashboard/executive/analytics') !!}>
            <a class="nav-link" href="{!! route('dashboard.executive.analytics') !!}">
                <i class="fas fa-chart-line" aria-hidden="true"></i>
                <span class="">{!! __('label.dashboard_report.executive_analytics') !!}</span>
            </a>
        </li>

        <li {!! setSideBarActiveUrl('dashboard/station/analytics') !!}>
            <a class="nav-link" href="{!! route('dashboard.station.analytics') !!}">
                <i class="fas fa-chart-area" aria-hidden="true"></i>
                <span class="">{!! __('label.dashboard_report.station_analytics') !!}</span>
            </a>
        </li>

        <li {!! setSideBarActiveUrl('dashboard/station/daily_analytics') !!}>
            <a class="nav-link" href="{!! route('dashboard.station.daily_analytics') !!}">
                <i class="fas fa-chart-pie" aria-hidden="true"></i>
                <span class="">{!! __('label.dashboard_report.daily_station_analytics') !!}</span>
            </a>
        </li>

    </ul>
</li>
@endauth


@permission('sales_menu')
<li {!! setSideBarActiveUrl('operation/sales/menu') !!}>
    <a class="nav-link" href="{!! route('operation.sales.menu') !!}">
        <i class="fas fa-money-bill-alt" aria-hidden="true"></i>
        <span class="side_link">{!! __('menu.sales.index') !!}  <br/>
                               </span>
    </a>
</li>
@endauth

@permission('discount_menu')
@if(sysdef()->data('FADISCOUNT') == 'true')
    <li {!! setSideBarActiveUrl('operation/sales/discount/menu') !!}>
        <a class="nav-link" href="{!! route('operation.sales.discount.menu') !!}">
            <i class="fas fa-money-check" aria-hidden="true"></i>
            <span class="side_link">{!! __('menu.sidebar.discount_management') !!}  <br/>
                               </span>
        </a>
    </li>
@endif
@endauth
@permission('expense_menu')
<li {!! setSideBarActiveUrl('operation/expense/menu') !!}>
    <a class="nav-link" href="{!! route('operation.expense.menu') !!}">
        <i class="fas fa-dollar-sign" aria-hidden="true"></i>
        <span class="side_link">{!! __('menu.expense.index') !!}  <br/>
                               </span>
    </a>
</li>
@endauth
{{--Hq - station menu--}}
@permission('station_hq_menu')
<li {!! setSideBarActiveUrl('operation/station/menu') !!}>
    <a class="nav-link" href="{!! route('operation.station.menu') !!}">
        <i class="fas fa-boxes" aria-hidden="true"></i>
        <span class="side_link">{!! __('menu.sidebar.station_management') !!}  <br/>
                               </span>
    </a>
</li>
@endauth

{{--Station menu - Branch manager--}}
@permission('station_menu')
<li {!! setSideBarActiveUrl('operation/station/menu') !!}>
    <a class="nav-link" href="{!! route('operation.station.menu') !!}">
        <i class="fas fa-boxes" aria-hidden="true"></i>
        <span class="side_link">{!! __('menu.sidebar.station_management') !!}  <br/>
                               </span>
    </a>
</li>
@endauth

