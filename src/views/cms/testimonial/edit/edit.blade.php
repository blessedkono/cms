@extends('cms.layouts.cms', ['title' => __('label.cms.testimonial.edit') , 'header' => __('label.cms.testimonial.edit')])

@include('includes.validate_assets')
@include('includes.datetimepicker')

@push('after-styles')
    <style>
    </style>
@endpush

@section('content')
    {{ Form::model($client_testimonial,['route' => ['cms.testimonial.update',$client_testimonial->uuid], 'method'=>'put','autocomplete' => 'off', 'id' => 'update','name'=>'edit','class' => 'form-horizontal needs-validation', 'novalidate','enctype'=>"multipart/form-data"]) }}
    {{ Form::hidden('action_type', 2, []) }}
    {{ Form::hidden('today', getTodayDate(), []) }}
    <section class="card">
        <div class="card-body">
            <p>{{ getLanguageBlock('lang.auth.mandatory-field') }}</p>
            <div class="row">
                <div class="col-md-3">
                    <div class="row form-group ">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('client_id', __('label.cms.client.client'), ['class' =>'required_asterik']) }}
                                        {{ Form::select('client_id',$clients,$client_testimonial->client_id,['class'=>'form-control select2 client_select', 'required', 'id' => 'client_id','placeholder' => '', 'autocomplete' => 'off']) }}
                                        {!!  $errors->first('client_id', '<span class="badge badge-danger">:message</span>')  !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row form-group ">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('designation_id', __('label.designation'), ['class' =>'required_asterik']) }}
                                        {{ Form::select('designation_id',$designations,null,['class'=>'form-control select2', 'required', 'id' => 'designation_id','placeholder' => '', 'autocomplete' => 'off']) }}
                                        {!!  $errors->first('designation_id', '<span class="badge badge-danger">:message</span>')  !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row form-group ">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('company_name', __('label.company'), ['class' =>'required_asterik']) }}
                                        {{ Form::text('company_name',null,['class'=>'form-control', 'id' => 'company_name','placeholder' => '','required', 'autocomplete' => 'off']) }}
                                        {!!  $errors->first('company_name', '<span class="badge badge-danger">:message</span>')!!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row form-group ">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group text_content">
                                        {{ Form::label('content', __('label.content'), ['class' =>'']) }}
                                        {{ Form::textarea('content',null,['class'=>'form-control', 'id' => 'note','placeholder' => '', 'autocomplete' => 'off']) }}
                                        {!! $errors->first('content', '<span class="badge badge-danger">:message</span>')  !!}
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
                            {{ link_to_route('cms.testimonial.index',trans('buttons.general.cancel'),[],['id'=> 'cancel', 'class' => 'btn btn-primary cancel_button', ]) }}
                            {{ Form::button(trans('label.submit'), ['class' => 'btn btn-primary submit','id' =>'client_testimonial', 'type'=>'submit', 'style' => 'border-radius: 5px;']) }}
                            <label id="label"></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{ Form::close() }}
@endsection

@push('after-scripts')
    {{ Html::script(url('assets/nextbyte/plugins/maskmoney/js/maskmoney.min.js')) }}
    <script>

        $(function() {
            $(".select2").select2();


            $('body').on('submit', 'form[name=edit]', function(e) {
                e.preventDefault();
                /*Codes Here*/
                pleaseWaitSubmitButton("client_discount","label","{{ trans('label.please_wait') }}",1);

                this.submit();

            });


            $(".client_select").select2({
                minimumInputLength: 3,
                multiple: false,
                ajax: {
                    url: "{{ route('cms.client.get_for_select') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            q: params.term || "",
                            page: params.page || 1
                        };
                    },
                    processResults: function (data, params) {
                        params.page = params.page || 1;
                        return {
                            results: $.map(data.items, function (item) {
                                return {
                                    text: item.name  ,
                                    id: item.id
                                };
                            }),
                            pagination: {
                                more: true
                            }
                        };
                    },
                    cache: true
                },
                escapeMarkup: function (markup) {
                    return markup;
                }
            });


            //for clone and append uploaded file input
            var documentNo = 2;

        });
    </script>
@endpush
