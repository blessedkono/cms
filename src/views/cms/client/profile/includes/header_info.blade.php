<div class="navbar navbar-light bg_form_header" >


    <span class="h6"> {!! $client->client_type_label . '  ' !!}
        <a style="color: black; font-weight: bold"  href="{{ route('operation.client.profile', $client->uuid) }}">{{  $client->name }}</a>
        {{ isset($client->region)?  (', ' . $client->region->name) : '' }}&nbsp;&nbsp;{{ ' - '. trans('label.status') .' - ' }} <b>{{  ($client->isactive)?trans('label.active'):trans('label.inactive') }}
        </b> &nbsp;<small
                class="underline"> </small>

    </span>

</div>
<legend></legend>
