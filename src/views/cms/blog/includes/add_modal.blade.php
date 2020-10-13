<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" >
    <div class="modal-dialog">
        <div class="modal-content">
            {!! Form::open(['route' => ['cms.blog.index'],'method'=>'post', 'autocomplete' => 'off',  'id' =>'store_note', 'class' => 'form-horizontal  needs-validation modal-form', 'novalidate','enctype'=>"multipart/form-data"]) !!}

            <div class="modal-header">
                <h4 class="modal-title pull-left">Add New Record</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

            </div>
            <div class="card-body">
                {{ csrf_field() }}

                <div class="row">
                    <div class="col-12">
                        {!! Form::label('title', __("label.title"), ['class' => 'required_asterik']) !!}

                        {!! Form::text('task_title',null , ['placeholder' => __('label.title')  ,'id'=>'title', 'class' => 'form-control','required']) !!}
                        {!! $errors->first('task_title', '<span class="badge badge-danger">:message</span>') !!}                    </div>
                </div>

                <div class="row mt-2" >
                    <div class="col-lg-12">
                        {!! Form::label('content', __("label.content"), ['class' => 'required_asterik']) !!}

                        {!! Form::textarea('content', null, ['class' => 'form-control', 'rows' => '10', 'autocomplete' => 'off', 'id' => 'editor', 'aria-describedby' => 'contentHelp', 'required']) !!}
                        {!! $errors->first('content', '<span class="badge badge-danger">:message</span>') !!}

                    </div>
                </div>

                <h4>{{trans('label.blog.post_setting')}}</h4>
                <p>
                    <a  type="button" data-toggle="collapse" data-target="#category" aria-expanded="false" aria-controls="collapseExample" style="cursor: pointer">
                        <i class="fa" aria-hidden="true"></i>
                        {{trans('label.blog.categories')}}
                    </a>
                </p>
                <div class="collapse" id="category">
                    <div class="card card-body">
                        {!! Form::select('category', ['2','2'],null, ['class' => 'form-control select2','placeholder' => '', 'autocomplete' => 'off', 'id' => 'blog_category', 'aria-describedby' => '', 'required']) !!}
                    </div>
                </div>

                <hr class="dotted">
                <p>
                    <a  type="button" data-toggle="collapse" data-target="#schedule" aria-expanded="false" aria-controls="collapseExample" style="cursor: pointer">
                        <i class="fa" aria-hidden="true"></i>
                        {{trans('label.blog.publish_on')}}
                    </a>
                <p>{{\Carbon\Carbon::now()->format('m-d-Y')}}</p>
                </p>
                <div class="collapse" id="schedule">
                    <div class="card card-body">
                        <div class="row">
                            <div class="col-md-6">

                                {!! Form::text('publish_date',null , ['placeholder' => __('label.posted_date')  ,'id'=>'publish_date', 'class' => 'form-control datepicker2','required']) !!}
                            </div>

                            <div class="col-md-6">
                                {!! Form::text('publish_time',null , ['placeholder' => __('label.posted_time')  ,'id'=>'publish_time', 'class' => 'form-control datepicker3','required']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="dotted">

            </div>

            <input name="blog_id" id="blog_id"  hidden>

            <div class="modal-footer">
                <button type="button" class="btn btn-xs btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-xs btn-primary action_button" id="store_note_btn">{{trans('label.submit')}}</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
