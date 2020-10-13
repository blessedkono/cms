{{--HQ only--}}

@permission('stock_menu')
<li {!! setSideBarActiveUrl('operation/stock/product/menu') !!}>
    <a class="nav-link" href="{!! route('operation.stock.product.menu') !!}">
        <i class="fas fa-store" aria-hidden="true"></i>
        <span class="side_link">{!! __('menu.sidebar.stock_management') !!}  <br/>
                               </span>
    </a>
</li>
@endauth

@permission('purchase_menu')
<li {!! setSideBarActiveUrl('operation/purchase/menu') !!}>
    <a class="nav-link" href="{!! route('operation.purchase.menu') !!}">
        <i class="fas fa-money-check" aria-hidden="true"></i>
        <span class="side_link">{!! __('menu.purchase.index') !!}  <br/>
                               </span>
    </a>
</li>
@endauth

@permission('employee_menu')
<li {!! setSideBarActiveUrl('hr/employee/menu') !!}>
    <a class="nav-link" href="{!! route('hr.employee.menu') !!}">
        <i class="fas fa-users" aria-hidden="true"></i>
        <span class="side_link">{!! __('menu.sidebar.employee_management') !!}  <br/>
                               </span>
    </a>
</li>
@endauth

@permission('payroll_menu')
<li {!! setSideBarActiveUrl('hr/payroll/menu') !!}>
    <a class="nav-link" href="{!! route('hr.payroll.menu') !!}">
        <i class="fas fa-money-check-alt" aria-hidden="true"></i>
        <span class="side_link">{!! __('menu.sidebar.payroll_management') !!}  <br/>
                               </span>
    </a>
</li>
@endauth

@permission('client_menu')
<li {!! setSideBarActiveUrl('operation/client/menu') !!}>
    <a class="nav-link" href="{!! route('operation.client.menu') !!}">
        <i class="fas fa-handshake" aria-hidden="true"></i>
        <span class="side_link">{!! __('menu.sidebar.client_management') !!}  <br/>
                               </span>
    </a>
</li>
@endauth
@permission('supplier_menu')
<li {!! setSideBarActiveUrl('operation/supplier/menu') !!}>
    <a class="nav-link" href="{!! route('operation.supplier.menu') !!}">
        <i class="fas fa-building" aria-hidden="true"></i>
        <span class="side_link">{!! __('menu.sidebar.supplier_management') !!}  <br/>
                               </span>
    </a>
</li>
@endauth

@permission('vehicle_menu')
<li {!! setSideBarActiveUrl('operation/vehicle/menu') !!}>
    <a class="nav-link" href="{!! route('operation.vehicle.menu') !!}">
        <i class="fas fa-truck-moving" aria-hidden="true"></i>
        <span class="side_link">{!! __('menu.sidebar.vehicle_management') !!}  <br/>
                               </span>
    </a>
</li>
@endauth


@permission('view_reports_menu')
<li {!! setSideBarActiveUrl('admin/reports') !!}>
    <a class="nav-link" href="{!! route('admin.report.index') !!}">
        <i class="fas fa-file" aria-hidden="true"></i>
        <span class="side_link">{!! __('label.administrator.system.reports.reports') !!}  <br/>
                               </span>
    </a>
</li>
@endauth


@permission('setting_menu')
<li {!! setSideBarActiveUrl('setting/organization/menu') !!}>
    <a class="nav-link" href="{!! route('setting.organization.menu') !!}">
        <i class="fas fa-cogs" aria-hidden="true"></i>
        <span class="side_link">{!! __('menu.sidebar.setting_management') !!}  <br/>
                               </span>
    </a>
</li>
@endauth
