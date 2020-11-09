<div class="row">
    <div class="col-12">
        {!! Form::label('title', __("label.title"), ['class' => 'required_asterik']) !!}

        {!! Form::text('title',$blog->title , ['placeholder' => __('label.title')  ,'id'=>'title', 'class' => 'form-control','required']) !!}
        {!! $errors->first('title', '<span class="badge badge-danger">:message</span>') !!}                    </div>
</div>

<div class="row mt-2" >
    <div class="col-lg-12">
        {!! Form::label('content', __("label.content"), ['class' => 'required_asterik']) !!}

        {!! Form::textarea('content', $blog->content, ['class' => 'form-control', 'rows' => '10', 'autocomplete' => 'off', 'id' => 'editor', 'aria-describedby' => 'contentHelp', 'required']) !!}
        {!! $errors->first('content', '<span class="badge badge-danger">:message</span>') !!}

    </div>

</div>
