<div class="row">

<div class="col-md-12">
    <table class="table table-light table-striped table-bordered">
        <tbody>

        {{--wf_track header--}}
        <tr>
            <td >{!! __('label.username') !!}</td>
            {{--<th>Status</th>--}}
            <td >{!! __('label.level') !!}</td>
            <th>{!! __('label.description') !!}</th>
            <td >{!! __('label.comments') !!}</td>
            <th>{!! __('label.aging') !!}</th>

        </tr>
        {{--{{ dd($pending_tracks) }}--}}
        @foreach($pending_tracks as $pending_track)

            <tr>
                <td >{!! $pending_track->username_formatted !!}</td>
                {{--<th>{!! $pending_track->status_narration !!}</th>--}}
                <td >{!! $pending_track->wfDefinition->level  !!}</td>
                <th>{!! $pending_track->wfDefinition->description  !!}</th>
                <td >{!! $pending_track->comment  !!}</td>
                <th>{!! $pending_track->getAgingDays() !!}</th>

            </tr>

        @endforeach


        </tbody>
    </table>

</div>


</div>
