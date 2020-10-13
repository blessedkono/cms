
    <div class="toggle toggle-secondary" data-plugin-toggle="">
        <section class="toggle">
            <label><i class="fas fa-plus"></i><i class="fas fa-minus"></i>{{ $old_tracks->last()->wfDefinition->wfModule->name }} @lang('label.wf_track') <i class="fas fa-list"></i></label></label>
            <div class="toggle-content" style="display: none">
                @foreach($old_tracks as $track)
                    <div class="row">
                        <div class="col-sm-2">Level</div>
                        <div class="col-sm-9">{{ number_format($track->wfDefinition->level, 1) }}</div>
                                <div class="col-sm-2">Designation</div>
                                <div class="col-sm-9">{{ isset($track->users) ? $track->users->resource_designation : ' ' }}</div>
                                <div class="col-sm-2">Name</div>
                                <div class="col-sm-9">{{ isset($track->users) ? $track->users->resource_name : '' }}</div>

                            <div class="col-sm-12">comment</div>
                            <div class="col-sm-12"><p class="alert alert-info" style="display: inline-block; margin-top:5px; margin-bottom: 5px">{{ $track->comments }}</p></div>

                                <div class="col-sm-12">Received Date : {{ $track->receive_date_formatted }}</div>
                                <div class="col-sm-12">Forwarded Date : {{ $track->forward_date_formatted }}</div>

                            <div class="col-sm-2">Status</div>
                            <div class="col-sm-9">{!! $track->status_narration_badge !!}</div>
                        </div>
                        <div class="col-sm-12" style="background-color: grey; height: 3px; margin-top: 10px; margin-bottom: 10px"></div>
                    @endforeach
            </div>
        </section>
    </div>

