@extends('layouts.main', ['title' => __('label.client.add_sub_client') , 'header' => __('label.client.add_sub_client')])

@include('includes.validate_assets')

@push('after-styles')
    <style>
    </style>
@endpush

@section('content')

    @include('operation.client.profile.includes.header_info')
    {{ Form::open(['route' => 'operation.sub_client.store', 'autocomplete' => 'off','method' => 'post', 'name' => 'create', 'class' => 'needs-validation', 'novalidate' , ]) }}
    {{ Form::hidden('client_id', $client->id, []) }}
    {{ Form::hidden('action_type', 1, []) }}
    {{ Form::hidden('today', getTodayDate(), []) }}
    <section class="card">
        <div class="card-body">
            <p>{!! getLanguageBlock('lang.auth.mandatory-field') !!}</p>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group ">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('name', __('label.name'), ['class' =>'required_asterik']) }}
                                        {{ Form::text('name',null,['class'=>'form-control', 'required', 'id' => 'name','placeholder' => '', 'autocomplete' => 'off']) }}
                                        {!! $errors->first('name', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::checkbox('return_page',1,null,['class'=>'', 'id' => 'return_page','placeholder' => '']) }}
                                        {{ Form::label('return_page', __('label.return_page'), ['class' =>'']) }}

                                        {!! $errors->first('return_page', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-md-3">
                    <div class="element-form">
                        <div class="form-group pull-right">
                            {{ link_to_route('operation.client.profile',trans('buttons.general.cancel'),[$client->uuid],['id'=> 'cancel', 'class' => 'btn btn-primary cancel_button', ]) }}
                            {{ Form::button(trans('buttons.general.submit'), ['class' => 'btn btn-primary', 'type'=>'submit', 'style' => 'border-radius: 5px;']) }}
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
        });
    </script>
@endpush
