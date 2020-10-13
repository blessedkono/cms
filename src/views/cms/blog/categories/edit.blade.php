@extends('cms.layouts.cms', ['title' => __('label.crud.edit') , 'header' => __('label.crud.edit')])

@include('includes.validate_assets')

@push('after-styles')
    <style>
    </style>
@endpush

@section('content')
    {{ Form::model($blog_category,['route' => ['cms.category.update',$blog_category->id], 'method'=>'put','autocomplete' => 'off', 'id' => 'update','class' => 'form-horizontal needs-validation', 'novalidate','name'=>'edit']) }}
    {{ Form::hidden('action_type', 2, []) }}
    {{ Form::hidden('blog_category_id', $blog_category->id, []) }}
    {{ Form::hidden('today', getTodayDate(), []) }}
    <section class="card">
        <div class="card-body">
            <p>{{ getLanguageBlock('lang.auth.mandatory-field') }}</p>
            <div class="row">
                <div class="col-md-6">
                    <div class="row form-group ">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-xs-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('name', __('label.name'), ['class' =>'required_asterik']) }}
                                        {{ Form::text('name',null,['class'=>'form-control', 'required', 'id' => 'name','placeholder' => '', 'autocomplete' => 'off']) }}
                                        {!! $errors->first('name', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row form-group ">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-xs-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('short_name', __('label.short_name'), ['class' =>'required_asterik']) }}
                                        {{ Form::text('short_name',null,['class'=>'form-control', 'required', 'id' => 'short_name','placeholder' => '', 'autocomplete' => 'off']) }}
                                        {!!  $errors->first('short_name', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row form-group ">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-xs-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('status', __('label.isactive'), ['class' =>'required_asterik']) }}
                                        {{ Form::select('status',['0' => 'No', '1' => 'Yes'],$blog_category->isactive,['class'=>'form-control select2','required', 'id' => 'status','placeholder' => '', 'autocomplete' => 'off']) }}
                                        {!! $errors->first('status', '<span class="badge badge-danger">:message</span>')  !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br/>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="element-form">
                                <div class="form-group pull-right">
                                    {{ link_to_route('cms.category.index',trans('buttons.general.cancel'),[],['id'=> 'cancel', 'class' => 'btn btn-primary cancel_button', ]) }}
                                    {{ Form::button(trans('label.submit'), ['class' => 'btn btn-primary submit','id'=>'allowance_type', 'type'=>'submit', 'style' => 'border-radius: 5px;']) }}
                                    <label id="label"></label>
                                    <input class="btn btn-warning" type="button" id="resetButton" value="{{ trans('label.reset_button') }}" onclick="resetForm(this.form);" hidden>                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{ Form::close() }}
@endsection

@push('after-scripts')
    <script>
        $(function() {
            $('select').select2({});
            $('body').on('submit', 'form[name=edit]', function(e) {
                e.preventDefault();
                /*Codes Here*/
                pleaseWaitSubmitButton("allowance_type","label","{{ trans('label.please_wait') }}",2)

                this.submit();

            });
        });
    </script>
@endpush
