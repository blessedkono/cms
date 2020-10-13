@extends('cms.layouts.cms', ['title' => __('buttons.general.crud.create') , 'header' => __('buttons.general.crud.create')])

@include('includes.validate_assets')

@push('after-styles')
    <style>
    </style>
@endpush

@section('content')
    {{ Form::open(['route' => 'cms.category.store', 'autocomplete' => 'off','method' => 'post', 'name' => 'create', 'class' => 'needs-validation', 'novalidate' , ]) }}
    {{ Form::hidden('action_type', 2, []) }}
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
                                        {!!  $errors->first('name', '<span class="badge badge-danger">:message</span>') !!}
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
                                        {{ Form::select('status',['0' => 'No', '1' => 'Yes'],1,['class'=>'form-control select2','required', 'id' => 'status','placeholder' => '', 'autocomplete' => 'off']) }}
                                        {!!  $errors->first('status', '<span class="badge badge-danger">:message</span>')  !!}
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

            $('body').on('submit', 'form[name=create]', function(e) {
                e.preventDefault();
                /*Codes Here*/
                pleaseWaitSubmitButton("allowance_type","label","{{ trans('label.please_wait') }}",1)

                this.submit();

            });
        });
    </script>
@endpush
