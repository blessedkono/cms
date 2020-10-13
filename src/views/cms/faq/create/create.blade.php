@extends('cms.layouts.cms', ['title' => trans('label.cms.faq.crud.create'), 'header' => trans('label.cms.faq.crud.create')])

@include('includes.validate_assets')
@include('includes.datetimepicker')

@push('after-styles')
{{ Html::style(url('vendor/select2/css/select2.min.css')) }}
@endpush

@section('content')

    <div class="row">
        <div class="col-md-12">
            <section class="card card-featured card-featured-primary mb-4">
                <div class="card-body">
                    <div class="card-body">
                        {!! Form::open(['route' => 'cms.faq.store', 'autocomplete' => 'off', 'id' => 'store', 'class' => 'needs-validation', 'novalidate']) !!}
                        <p>{!! getLanguageBlock('lang.auth.mandatory-field') !!}</p>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    {!! Form::label('title', trans('label.title'), ['class' => 'required_asterik']) !!}
                                    {!! Form::text('title', null, ['class' => 'form-control', 'autocomplete' => 'off', 'id' => 'name', 'aria-describedby' => 'titleHelp', 'required']) !!}
                                    <small id="titleHelp" class="form-text text-muted"></small>
                                    {!! $errors->first('title', '<span class="badge badge-danger">:message</span>') !!}
                                </div>

                            </div>
                        </div>
                        <div class="row form-group ">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-xs-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            {{ Form::label('status', __('label.isactive'), ['class' =>'required_asterik']) }}
                                            {{ Form::select('status',['0' => 'No', '1' => 'Yes'],1,['class'=>'form-control select2','required', 'id' => 'status','placeholder' => '', 'autocomplete' => 'off']) }}
                                            {!!  $errors->first('status', '<span class="badge badge-danger">:message</span>')  !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('content', trans('label.content'),['class'=>'required_asterik']) !!}
                            {!! Form::textarea('content', null, ['class' => 'form-control', 'rows' => '4', 'autocomplete' => 'off', 'id' => 'editor', 'aria-describedby' => 'contentHelp', 'required']) !!}
                            {!! $errors->first('content', '<span class="badge badge-danger">:message</span>') !!}
                        </div>

                        <div class="form-group text-center">
                            {!! link_to_route('cms.faq.index',trans('buttons.general.cancel'),[],['id'=> 'cancel', 'class' => 'btn btn-primary cancel_button', ]) !!}
                            {!! Form::button(trans('buttons.general.submit'), ['class' => 'btn btn-primary','id' => 'submit_btn', 'type'=>'submit']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </section>
        </div>
    </div>

@endsection

@push('after-scripts')
    {!! Html::script(url('cms/vendor/ckeditor5/ckeditor.js')) !!}

    <script>
        $(function () {

            ClassicEditor
                .create( document.querySelector( '#editor' ), {
                    toolbar: [ 'bold', 'italic', 'link', 'bulletedList', 'numberedList' ],
                })
                .then( editor => {
                    theEditor = editor;
                } )
                .catch( error => {
                    console.error( error );
                } );


         $(".select2").select2();

        var today_date = new Date;
        var dd = today_date.getDate();
        var mm = today_date.getMonth() + 1; //January is 0!
        var yyyy = today_date.getFullYear();

        today_date = yyyy + '/' + mm + '/' + dd;

        jQuery('.datepicker').datetimepicker({
            timepicker:false,
            format:'d-M-Y',
            weeks: false,
            dayOfWeekStart: 1,
            lazyInit: true,
            scrollInput: false,
            minDate: today_date,
        });
    });
</script>
@endpush
