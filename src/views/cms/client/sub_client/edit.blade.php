@extends('layouts.main', ['title' => __('label.client.edit_sub_client') , 'header' => __('label.client.edit_sub_client')])

@include('includes.validate_assets')

@push('after-styles')
    <style>
    </style>
@endpush

@section('content')

    @include('operation.client.profile.includes.header_info', ['client' => $sub_client->client])
    {{ Form::model($sub_client,['route' => ['operation.sub_client.update',$sub_client->uuid], 'method'=>'put','autocomplete' => 'off', 'id' => 'update', 'name' => 'edit', 'class' => 'form-horizontal needs-validation', 'novalidate',]) }}

          {{ Form::hidden('sub_client_id', $sub_client->id, []) }}
          {{ Form::hidden('action_type', 2, []) }}
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
                                        {{ Form::label('isactive', __('label.isactive'), ['class' =>'required_asterik']) }}
                                        {{ Form::select('isactive',['0' => 'No', '1' => 'Yes'],null,['class'=>'form-control select2', 'required', 'id' => 'return_page', 'autocomplete' => 'off']) }}
                                        {!! $errors->first('isactive', '<open_span class="badge badge-danger">:message<close_span>') !!}
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
                            {{ link_to_route('operation.client.profile',trans('buttons.general.cancel'),[$sub_client->client->uuid],['id'=> 'cancel', 'class' => 'btn btn-primary cancel_button', ]) }}
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
            $(".select2").select2();
        });
    </script>
@endpush
