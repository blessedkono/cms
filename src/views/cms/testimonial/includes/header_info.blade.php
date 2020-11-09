<div class="navbar navbar-light bg_form_header" >


    <span class="h6"  > {{ trans('label.name'),' - ' }} <a style="color: black; font-weight: bold" href="{{ route('operation.client.profile',$client_discount->client->uuid) }}"> {{ $client_discount->client->name . ' - ' }}</a> {{ isset($client_discount->shift)? trans('label.sales.shift.shift').' - ' : ''}} {{ isset($client_discount->shift)?($client_discount->shift->resource_name).' - ':'' }} &nbsp;{{ trans('label.sales.discount.type') .' - ' }} <span style="color: black; font-weight: bold">{{  code_value()->find($client_discount->discount_type_cv_id)->name  }}</span><small
                class="underline"> </small>

    </span>

</div>
<legend></legend>
