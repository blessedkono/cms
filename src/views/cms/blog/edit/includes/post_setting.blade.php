<h4>{{trans('label.blog.post_setting')}}</h4>
<p>
    <a  type="button" data-toggle="collapse" data-target="#category" aria-expanded="false" aria-controls="collapseExample" style="cursor: pointer">
        <i class="fa" aria-hidden="true"></i>
        {{trans('label.blog.categories')}}
    </a>
</p>
<div class="collapse" id="category">
    <div class="card card-body">
        {!! Form::select('blog_categories[]', $categories, $category_ids, ['class' => 'form-control select2','placeholder' => ' ', 'autocomplete' => 'off', 'id' => 'blog_category_id', 'aria-describedby' => '', 'required', 'multiple']) !!}    </div>
</div>

<hr class="dotted">
<div class="row">
    <div class="col-md-12">
        <div class="row form-group mt-2">
            <div class="col-lg-6">
                {!! Form::label('isactive', trans('label.isactive') ,['class' => 'required_asterik']) !!}
                {!! Form::select('isactive',['0' => 'No', '1' => 'Yes'],$blog->isactive,['class'=>'form-control select2 isactive', 'id' => 'isactive','required','placeholder' => '', 'autocomplete' => 'off']) !!}
                {!! $errors->first('isactive', '<span class="badge badge-danger">:message</span>') !!}

            </div>

            <div class="col-lg-6">
                {{--                {!! Form::label('repeat_type_cv_id', __("label.tasks.recurring_task.repeat_type"), ['class' => 'required_asterik']) !!}--}}

                {{--                {!! Form::select('repeat_type_cv_id',code_value()->getCodeValuesNotInRefsWithReference(9, ['SCTNON']), [], ['class' => 'form-control select2','placeholder' => '', 'autocomplete' => 'off', 'id' => 'task_status', 'aria-describedby' => '', 'required']) !!}--}}
                {{--                {!! $errors->first('repeat_type_cv_id', '<span class="badge badge-danger">:message</span>') !!}--}}

            </div>

        </div>

        <div class="row form-group mt-2">
            <div class="col-lg-6">
                {!! Form::label('isscheduled', trans('label.is_schedule') ,['class' => 'required_asterik']) !!}
                {!! Form::select('isscheduled',['0' => 'No', '1' => 'Yes'],$blog->isscheduled,['class'=>'form-control select2 isschedule', 'id' => 'isschedule','required','placeholder' => '', 'autocomplete' => 'off']) !!}
                {!! $errors->first('isscheduled', '<span class="badge badge-danger">:message</span>') !!}
                <small id="isperformanceHelp" class="form-text text-muted">@lang('label.is_schedule_help')</small>

            </div>

            <div class="col-lg-6">
                {{--                {!! Form::label('repeat_type_cv_id', __("label.tasks.recurring_task.repeat_type"), ['class' => 'required_asterik']) !!}--}}

                {{--                {!! Form::select('repeat_type_cv_id',code_value()->getCodeValuesNotInRefsWithReference(9, ['SCTNON']), [], ['class' => 'form-control select2','placeholder' => '', 'autocomplete' => 'off', 'id' => 'task_status', 'aria-describedby' => '', 'required']) !!}--}}
                {{--                {!! $errors->first('repeat_type_cv_id', '<span class="badge badge-danger">:message</span>') !!}--}}

            </div>

        </div>


        <div class="row form-group" id="schedule_div" style="display: none">
            <div class="col-lg-6">
                {!! Form::label('publish_date', __("label.publish_date"), ['class' => 'required_asterik']) !!}

                <div class="input-group">
														<span class="input-group-prepend">
															<span class="input-group-text">
																<i class="fas fa-calendar-alt"></i>
															</span>
														</span>
                    {!! Form::text('publish_date',short_date_format($blog->publish_date) , ['placeholder' => __('label.publish_date')  ,'id'=>'publish_date', 'class' => 'form-control datepicker2','required','style' => 'background-color: white;']) !!}
                    {!! $errors->first('publish_date', '<span class="badge badge-danger">:message</span>') !!}

                </div>
            </div>
            <div class="col-lg-6">
                {!! Form::label('publish_time', __("label.publish_time"), ['class' => 'required_asterik']) !!}

                <div class="input-group">
														<span class="input-group-prepend">
															<span class="input-group-text">
																<i class="fas fa-calendar-alt"></i>
															</span>
														</span>
                    {!! Form::text('publish_time',($blog->publish_time) , ['placeholder' => __('label.publish_time')  ,'id'=>'publish_time', 'class' => 'form-control datepicker3','required','style' => 'background-color: white;']) !!}
                    {!! $errors->first('publish_time', '<span class="badge badge-danger">:message</span>') !!}

                </div>
            </div>
        </div>




    </div>
    <div class="col-md-4">

    </div>
</div>

<hr class="dotted">
