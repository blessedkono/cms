

{{--Completed wf tracks--}}
@include('includes.workflow.workflow_track_tool')
<br/>
{{--Only access this when worklow is not completed--}}
@if($wf_done == 0)
    {{--Pending wf tracks--}}
    @include('includes/workflow/pending_wf_tracks')

    {{--action button--}}
    @if($wf_track->checkIfHasRightCurrentWfTrackAction())
        <a href='#exampleModalCenter' class='btn btn-success' data-toggle='modal' id='approve_modal'>Action</a>
    @elseif (env('TEST_MODE', 1))
        <a href='#exampleModalCenter' class='btn btn-success' data-toggle='modal' id='approve_modal'>Action</a>
    @else
    @endif


    {{--Workflow modals--}}
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" id="modal-content">
                @include('admin/system/workflow/modal/approval_model')
            </div>
        </div>
    </div>

@endif