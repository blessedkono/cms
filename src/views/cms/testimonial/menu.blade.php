
@extends('layouts.main', ['title' => trans('label.sales.discount.management'), 'header' => trans('label.sales.discount.management')])

@section('content')

    @permission('hq_menu')
    @include('operation/sales/discount/menu/discount_hq_menu')
    @endauth

    @permission('station_menu')
    @include('operation/sales/discount/menu/discount_station_menu')
    @endauth



@stop

@push('after-scripts')
    <script type="text/javascript">
        $(document).ready(function() {



        });
    </script>;

@endpush
