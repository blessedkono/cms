
@extends('layouts.main', ['title' => trans('menu.client.index'), 'header' => trans('menu.client.index')])

@section('content')




<div class="row">
    {{--left div--}}
    <div class="col-sm-6 col-md-6">
        <div class="list-group">
            {{--register notification--}}
            <ul class="list-unstyled">
                <a  class=""  style="text-decoration: none;"   href="{{ route('operation.client.index')  }}">
                    <li  class="list-group-item   menu-link" >  <h4  class="menu-header"><i class="icon fa fa-users"></i><large>&nbsp;&nbsp;{{ __('menu.client.view_clients') }}</large></h4>

                        <p id = "bottom_border_custom"  style="color:grey;" class="bottom_border_custom">{{ __('menu.client.view_clients_helper')  }} </p> </li>
                </a>

            </ul>
            <br/>




        </div>
    </div>

    {{--right div--}}

    <div class="col-sm-6 col-md-6">
        <div class="list-group">
            {{--register notification--}}
            <ul class="list-unstyled">
                <a  class=""  style="text-decoration: none;"   href="{{ route('operation.client.create') }}">
                    <li  class="list-group-item   menu-link" >  <h4   class="menu-header"><i class="icon fa fa-user-plus"></i><large>&nbsp;&nbsp;{{ __('menu.client.add_client') }}</large></h4>

                        <p id = "bottom_border_custom"  style="color:grey;" class="bottom_border_custom">{{ __('menu.client.add_client_helper')  }} </p> </li>
                </a>

            </ul>
            <br/>



        </div>
    </div>



</div>

@stop

@push('after-scripts')
    <script type="text/javascript">
        $(document).ready(function() {



        });
    </script>;

@endpush
