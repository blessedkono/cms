<div class="card" >
    <div style="color:grey;" class="accordion accordion-quaternary" id="accordion2Primary">
        <div class="card card-default">
            <div class="card-header">
                <h5 class="card-title m-0">
                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2Primary" href="#collapse2PrimaryOne" aria-expanded="true">
                        <label>@lang('label.wf_track') - {!! $wf_track->wfDefinition->wfModule->name !!} <i class="fas fa-list"></i></label>
                    </a>
                </h5>
            </div>
            <div id="collapse2PrimaryOne" class="collapse hide" style="">
                <div class="card-body">
                    @foreach($completed_tracks as $track)
                        <div class="row">
                            <div class="col-sm-2">{!! __('label.level') !!}</div>
                            <div class="col-sm-9">{{ number_format($track->wfDefinition->level, 1) }}</div>
                            <div class="col-sm-2">{!! __('label.description') !!}</div>
                            <div class="col-sm-9">{{ $track->wfDefinition->designation->name }}</div>
                            <div class="col-sm-2">{!! __('label.name') !!}</div>
                            <div class="col-sm-9">{{ $track->users->fullname }} </div>
                            <div class="col-sm-12">{!! __('label.comments') !!}</div>
                            <div class="col-sm-12"><p class="alert alert-info" style="display: inline-block; margin-top:5px; margin-bottom: 5px">{{ $track->comments }}</p></div>
                            <div class="col-sm-12">{!! __('label.received_date') !!}: {{ $track->receive_date_formatted }}</div>
                            <div class="col-sm-12">{!! __('label.forward_date') !!}: {{ $track->forward_date_formatted }}</div>
                            <div class="col-sm-2">{!! __('label.status') !!}</div>
                            <div class="col-sm-9">{!! $track->status_narration_badge !!}</div>
                        </div>
                        <div class="col-sm-12" style="background-color: grey; height: 3px; margin-top: 10px; margin-bottom: 10px"></div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>







@push('after-scripts')

    <script>
        $(function() {
            $("#toggle_section").slideDown();
            $( "#toggle_section_header" ).click(function(event) {
                alert(1);
                              $("#toggle_section").slideToggle();
            });
        });
    </script>
@endpush

