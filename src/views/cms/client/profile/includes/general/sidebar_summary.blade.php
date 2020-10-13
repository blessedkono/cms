{{--<legend>Sidebar Summary</legend>--}}
<div class="thumb-info mb-3 text-center">
    {{--                            <a class="img-thumbnail lightbox" href="{{ url((new \App\Repositories\System\DocumentResourceRepository())->getDocFullPathUrl(1))}}" data-plugin-options="{ &quot;type&quot;:&quot;image&quot; }">--}}
    @if($client_logo)
    <img style="height: 220px"  class="img-fluid profile-img" src="{!! $client_logo !!} ">
    @else
        <img class="img-fluid profile-img" src="{!! url('cms/img/client.png') !!}">

    @endif

        <div class="thumb-info-title">
        <span class="thumb-info">{{ $client->name }}</span>
            <span class="thumb-info-type">{!! $client->client_type_label !!}</span>
    </div>
</div>

<div class="widget-toggle-expand mb-3">
    <table class="table table-bordered table-striped" id="myTable">

        <tbody>
        <tr>
            <th> @lang('label.status') : </th>
            <td>{{ ($client->isactive)? trans('label.active'):trans('label.inactive') }}</td>
        </tr>




        <tr>
            <th> @lang('label.externa_id') : </th>
            <td>{{ $client->external_id }}</td>
        </tr>

        </tbody>
    </table>


</div>





