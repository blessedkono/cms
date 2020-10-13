<h4>{{trans('label.blog.post_setting')}}</h4>
<p>
    <a  type="button" data-toggle="collapse" data-target="#category" aria-expanded="false" aria-controls="collapseExample" style="cursor: pointer">
        <i class="fa" aria-hidden="true"></i>
        {{trans('label.blog.categories')}}
    </a>
</p>
<div class="collapse" id="category">
    <div class="card card-body">
{{--        {!! Form::select('category',$categories,null, ['class' => 'form-control select2','placeholder' => '', 'autocomplete' => 'off', 'id' => 'blog_category', 'aria-describedby' => '', 'required']) !!}--}}
        {!! Form::select('blog_categories[]', $categories, [], ['class' => 'form-control select2 task_users','placeholder' => ' ', 'autocomplete' => 'off', 'id' => 'blog_category_id', 'aria-describedby' => '', 'required', 'multiple']) !!}

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

                {!! Form::text('publish_date',null , ['placeholder' => __('label.publish_date')  ,'id'=>'publish_date', 'class' => 'form-control datepicker2','required']) !!}
            </div>

            <div class="col-md-6">
                {!! Form::text('publish_time',null , ['placeholder' => __('label.publish_time')  ,'id'=>'publish_time', 'class' => 'form-control datepicker3','required']) !!}
            </div>
        </div>
    </div>
</div>
<hr class="dotted">
