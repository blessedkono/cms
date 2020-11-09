@extends('cms.layouts.cms', ['title' => __('label.crud.edit') , 'header' => __('label.crud.edit')])

@include('includes.validate_assets')

@push('after-styles')
    <style>
    </style>
@endpush

@section('content')
    {{ Form::model($module_functional_part,['route' => ['cms.user_manual.module_functional_part.update',$module_functional_part->id], 'method'=>'put','autocomplete' => 'off', 'id' => 'update', 'name' => 'edit', 'class' => 'form-horizontal needs-validation', 'novalidate','enctype'=>"multipart/form-data"]) }}
    {{ Form::hidden('action_type', 2, []) }}
    {{ Form::hidden('today', getTodayDate(), []) }}
    <section class="card">
        <div class="card-body">
            <p>{!! getLanguageBlock('lang.auth.mandatory-field') !!}</p>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group ">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('title', __('label.title'), ['class' =>'required_asterik']) }}
                                        {{ Form::text('title',null,['class'=>'form-control', 'required', 'id' => 'title','placeholder' => '', 'autocomplete' => 'off']) }}
                                        {!! $errors->first('title', '<span class="badge badge-danger">:message</span>') !!}
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
                                        {{ Form::label('navigation_link', __('label.cms.user_manual.navigation_link'), ['class' =>'required_asterik']) }}
                                        {{ Form::text('navigation_link',null,['class'=>'form-control', 'required', 'id' => 'navigation_link','placeholder' => '', 'autocomplete' => 'off']) }}
                                        {!! $errors->first('navigation_link', '<span class="badge badge-danger">:message</span>') !!}
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
                                        {{ Form::label('media_link', __('label.cms.user_manual.media_link'), ['class' =>'']) }}
                                        {{ Form::text('media_link',null,['class'=>'form-control', 'id' => 'media_link','placeholder' => '', 'autocomplete' => 'off']) }}
                                        {!! $errors->first('media_link', '<span class="badge badge-danger">:message</span>') !!}
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
                                        {{ Form::label('module', __('label.module'), ['class' =>'']) }}
                                        {{ Form::select('module',$modules,$module_functional_part->module_id,['class'=>'form-control select2', 'id' => 'isactive','placeholder' => '', 'autocomplete' => 'off']) }}
                                        {!! $errors->first('module', '<span class="badge badge-danger">:message</span>') !!}
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
                                        {{ Form::label('isactive', __('label.isactive'), ['class' =>'']) }}
                                        {{ Form::select('isactive',['0' => 'No', '1' => 'Yes'],null,['class'=>'form-control select2', 'id' => 'isactive','placeholder' => '', 'autocomplete' => 'off']) }}
                                        {!! $errors->first('isactive', '<span class="badge badge-danger">:message</span>') !!}
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
                                        {{ Form::label('description', __('label.description'), ['class' =>'']) }}
                                        {{ Form::textarea('description',null,['class'=>'form-control', 'id' => 'editor','placeholder' => '', 'autocomplete' => 'off']) }}
                                        {!! $errors->first('description', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

                <div class="col-md-6">
                    @include('cms.user_manual.module_functional_part.includes.edit_images')
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-md-3">
                    <div class="element-form">
                        <div class="form-group pull-right">
                            {{ link_to_route('cms.user_manual.module_functional_part.profile',trans('buttons.general.cancel'),[$module_functional_part->id],['id'=> 'cancel', 'class' => 'btn btn-primary cancel_button', ]) }}
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
    {!! Html::script(url('cms/vendor/ckeditor5/ckeditor.js')) !!}

    <script>
        $(function() {
            ClassicEditor.create( document.querySelector( '#editor' ) );

            $(".select2").select2();
        });
    </script>
@endpush
