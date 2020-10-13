<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="modal-title">{!! $assign_status['text'] !!}</h4>
</div>
<div class="modal-body" style="font-size: 14px !important;">
    @if ($wf_track->status == 0)
        {{--Check if user has workflow access at this level--}}
        @if ($user_has_access)
            {!! Form::open(['route' => ['workflow.update_workflow', $wf_track->id], 'name' => 'workflow_process_modal']) !!}
            {!! Form::hidden('assigned', $wf_track->assigned) !!}
            @if ($assign_status['status'])
                {!! Form::hidden('action', "approve_reject") !!}
                <div class="row">
                    <div class="col-md-12">
                        <div class="field-layout">
                            <div class="form-group">
                                <label class="required" for="status">@lang('labels.backend.workflow.action')</label>
                                {!! Form::select('status', $statuses, null, ['class' => 'search-select workflow_status_select', 'style' => 'width:100%;border-radius:3px;height:32px;']) !!}
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="field-layout reject_to_level">
                            <div class="form-group">
                                <label class="required" for="level">Reject to level</label>
                                {!! Form::select('level', $previous_levels, null, ['class' => 'reject_to_level_select','style'=>'width:100%;border-radius:3px;height:32px;']) !!}
                            </div>
                        </div>
                        <div class="field-layout">
                            <div class="form-group">
                                <label for="comments">@lang('labels.general.comments')</label>
                                {!! Form::textarea('comments', null, ['class' => 'form-control autosize',  'style' => 'overflow: hidden; word-wrap: break-word; resize: horizontal;border-radius: 3px;']) !!}
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang("buttons.general.close")</button>
                    <button type="submit" class="btn btn-primary btn-submit">@lang("buttons.general.crud.update")</button>
                </div>
            @else
                {{--Check if user has already participated in this workflow before--}}
                @if (!$has_participated)
                    {{--!$has_participated--}}
                                  @lang("strings.backend.workflow.assign?")
                    {!! Form::hidden('action', "assign") !!}
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang("buttons.general.close")</button>
                        <button type="submit" class="btn btn-primary btn-submit">@lang("buttons.general.confirm")</button>
                    </div>
                @else
                    @lang("strings.backend.workflow.participated")
                @endif
            @endif
        @else
            @lang("strings.backend.workflow.miss_level_access")
        @endif
    @else
        @lang("strings.backend.workflow.forwarded")
    @endif
    {!! Form::close() !!}
</div>
