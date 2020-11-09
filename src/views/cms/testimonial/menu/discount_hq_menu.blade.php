



<div class="row">
    {{--left div--}}
    <div class="col-sm-6 col-md-6">
        <div class="list-group">
            {{--register notification--}}
            <ul class="list-unstyled">
                <a  class=""  style="text-decoration: none;"   href="{{ route('operation.sales.discount.index') }}">
                    <li  class="list-group-item   menu-link" >  <h4  class="menu-header"><i class="icon fa fa-money-check"></i><large>&nbsp;&nbsp;{{ __('menu.sales.discount.view') }}</large></h4>

                        <p id = "bottom_border_custom"  style="color:grey;" class="bottom_border_custom">{{ __('menu.sales.discount.view_helper')  }} </p> </li>
                </a>
            </ul>
            <br/>
            <br/>
        </div>
    </div>

    {{--right div--}}
    <div class="col-sm-6 col-md-6">
        <div class="list-group">
            {{--register notification--}}
            {{--<ul class="list-unstyled">--}}
                {{--<a  class=""  style="text-decoration: none;"   href="{{ route('operation.sales.discount.create') }}">--}}
                    {{--<li  class="list-group-item   menu-link" >  <h4   class="menu-header"><i class="icon fa fa-plus"></i><large>&nbsp;&nbsp;{{ __('menu.sales.discount.add') }}</large></h4>--}}

                        {{--<p id = "bottom_border_custom"  style="color:grey;" class="bottom_border_custom">{{ __('menu.sales.discount.add_helper')  }} </p> </li>--}}
                {{--</a>--}}
            {{--</ul>--}}
            {{--<br/>--}}
            {{--Manage deduction--}}
            <br/>
        </div>
    </div>

</div>


