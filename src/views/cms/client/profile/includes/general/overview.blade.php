<div class="row">
    <div class="col-md-12">
        <table class="table table-striped table-bordered" id="">
            <tbody>
            <tr>
                <th width="170px"> @lang('label.name') : </th>
                <td>{{ $client->name }}</td>
            </tr> <tr>
                <th width="170px"> @lang('label.tin') : </th>
                <td>{{ $client->tin }}</td>
            </tr>
            <tr>
                <th width="170px"> @lang('label.phone') : </th>
                <td>{{ $client->phone }}</td>
            </tr>
            <tr>
                <th width="170px"> @lang('label.telephone') : </th>
                <td>{{ $client->telephone }}</td>
            </tr>

            <tr>
                <th width="170px"> @lang('label.email') : </th>
                <td>{{ $client->email }}</td>
            </tr>
            <tr>
                <th width="170px"> @lang('label.website') : </th>
                <td>{{ $client->web }}</td>
            </tr>
            <tr>
                <th width="170px"> @lang('label.box_no') : </th>
                <td>{{ $client->box_no }}</td>
            </tr>
            <tr>
                <th width="130px"> @lang('label.region') : </th>
                <td>{{ isset($client->region_id)? $client->region->name :''}}</td>
            </tr>
            <tr>
                <th width="170px"> @lang('label.address') : </th>
                <td>{{ $client->address }}</td>
            </tr>
            @if($client->iscompany ==1)
                <tr>
                    <th> @lang('label.contact_person') : </th>
                    <td>{{ $client->contact_person }}</td>
                </tr>
                <tr>
                    <th> @lang('label.contact_person_phone') : </th>
                    <td>{{ $client->contact_person_phone }}</td>
                </tr>
            @endif




            </tbody>
        </table>

    </div>

</div>

<div class="row">
    <div class="col-md-12">
        <h5 class="mb-2 mt-3"><b>@lang('label.note') :</b></h5>

        <p style="display: inline-block; overflow-x: auto;">
    <span style="overflow-x: auto;">
{{ $client->note }}
        </span>
        </p>
    </div>
</div>
