@extends('cms.layouts.cms', ['title' => __('label.cms.client.create_client') , 'header' => __('label.cms.client.create_client')])

@include('includes.validate_assets')

@push('after-styles')
    <style>
    </style>
@endpush

@section('content')

    {{ Form::open(['route' => 'cms.client.store', 'autocomplete' => 'off','method' => 'post', 'name' => 'create', 'class' => 'needs-validation', 'novalidate' , 'enctype'=>"multipart/form-data",]) }}
    {{ Form::hidden('action_type', 1, []) }}
    {{ Form::hidden('today', getTodayDate(), []) }}
    <section class="card">
        <div class="card-body">
            <p>{{ getLanguageBlock('lang.auth.mandatory-field') }}
            </p>
            <div class="row">
                <div class="col-md-6">
                    <div class="row form-group ">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-xs-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('name', __('label.name'), ['class' =>'required_asterik']) }}
                                        {{ Form::text('name',null,['class'=>'form-control', 'id' => 'name','placeholder' => '', 'autocomplete' => 'off']) }}
                                        {!! $errors->first('name', '<span class="badge badge-danger">:message</span>')  !!}
                                    </div>
                                </div>
                                <div class="col-xs-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('phone', __('label.phone'), ['class' =>'required_asterik']) }}
                                        {{ Form::text('phone',null,['class'=>'form-control', 'required', 'id' => 'phone','placeholder' => '', 'autocomplete' => 'off']) }}
                                        {!! $errors->first('phone', '<span class="badge badge-danger">:message</span>')  !!}
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="row form-group ">
                        <div
                                class="col-sm-12">
                            <div
                                    class="row">
                                <div class="col-xs-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('iscompany', __('label.iscompany'), ['class' =>'required_asterik']) }}
                                        {{ Form::select('iscompany',['0' => 'No', '1' => 'Yes'],null,['class'=>'form-control select2 iscompany', 'required', 'id' => 'iscompany','placeholder' => '', 'autocomplete' => 'off','required']) }}
                                        {!!  $errors->first('iscompany', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>


                                <div
                                        class="col-xs-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('tin', __('label.tin'), ['class' =>'']) }}
                                        {{ Form::text('tin',null,['class'=>'form-control tin', 'id' => 'tin','placeholder' => '', 'autocomplete' => 'off']) }}
                                        {!! $errors->first('tin', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>

                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="row form-group ">
                        <div class="col-sm-12">
                            <div class="row" id="contact_person_div">
                                <div class="col-xs-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('contact_person', __('label.contact_person'), ['class' =>'']) }}
                                        {{ Form::text('contact_person',null,['class'=>'form-control', 'id' => 'contact_person','placeholder' => '', 'autocomplete' => 'off']) }}
                                        {!!  $errors->first('contact_person', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>
                                <div class="col-xs-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('contact_person_phone', __('label.contact_person_phone'), ['class' =>'']) }}
                                        {{ Form::text('contact_person_phone',null,['class'=>'form-control', 'id' => 'contact_person_phone','placeholder' => '', 'autocomplete' => 'off']) }}
                                        {!!  $errors->first('contact_person_phone', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div
                            class="row form-group ">
                        <div
                                class="col-sm-12">
                            <div class="row">
                                <div class="col-xs-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">

                                    <div class="form-group">
                                        {{ Form::label('address', __('label.address'), ['class' =>'']) }}
                                        {{ Form::text('address',null,['class'=>'form-control', 'id' => 'address','placeholder' => '', 'autocomplete' => 'off']) }}
                                        {!!  $errors->first('address', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>


                                <div class="col-xs-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">

                                    <div class="form-group">
                                        {{ Form::label('email', __('label.email'), ['class' =>'']) }}
                                        {{ Form::text('email',null,['class'=>'form-control', 'id' => 'email','placeholder' => '', 'autocomplete' => 'off']) }}
                                        {!!  $errors->first('email', '<span class="badge badge-danger">:message</span>')  !!}
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>
                    <div
                            class="row form-group ">
                        <div
                                class="col-sm-12">
                            <div
                                    class="row">
                                <div class="col-xs-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('region', __('label.region'), ['class' =>'']) }}
                                        {{ Form::select('region',code_value()->getRegionForSelect(),null,['class'=>'form-control select2', 'id' => 'region','placeholder' => '', 'autocomplete' => 'off']) }}
                                        {!! $errors->first('region', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>

                                </div>



                                <div class="col-xs-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('telephone', __('label.telephone'), ['class' =>'']) }}
                                        {{ Form::text('telephone',null,['class'=>'form-control', 'id' => 'telephone','placeholder' => '', 'autocomplete' => 'off']) }}
                                        {!! $errors->first('telephone', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div
                            class="row form-group ">
                        <div
                                class="col-sm-12">
                            <div
                                    class="row">
                                <div
                                        class="col-xs-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div
                                            class="form-group">
                                        {{ Form::label('box_no', __('label.po_box'), ['class' =>'']) }}
                                        {{ Form::text('box_no',null,['class'=>'form-control number', 'id' => 'box_no','placeholder' => '', 'autocomplete' => 'off']) }}
                                        {!! $errors->first('box_no', '<span class="badge badge-danger">:message</span>')  !!}
                                    </div>
                                </div>


                                <div class="col-xs-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('web', __('label.website'), ['class' =>'']) }}
                                        {{ Form::text('web',null,['class'=>'form-control', 'id' => 'web','placeholder' => '', 'autocomplete' => 'off']) }}
                                        {!! $errors->first('web', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>


                                </div>


                            </div>
                        </div>
                    </div>



                    <div class="row form-group ">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-xs-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div
                                            class="form-group">
                                        {{ Form::label('external_id', __('label.externa_id'), ['class' =>'']) }}
                                        {{ Form::text('external_id',null,['class'=>'form-control', 'id' => 'external_id','placeholder' => '', 'autocomplete' => 'off']) }}
                                        {!! $errors->first('external_id', '<span class="badge badge-danger">:message</span>') !!}
                                        <small style="color:grey;" >{{ __('label.cms.client.external_reference') }}</small>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        {{ Form::label('client_logo', __('label.logo'), ['class' =>'']) }}<br>
                                        {{ Form::file('client_logo',[]) }}
                                        {{--                                        <small>--}}
                                        {{--                                            Formats:--}}
                                        {{--                                            All,--}}
                                        {{--                                            JPEG,--}}
                                        {{--                                            PNG--}}
                                        {{--                                        </small>--}}
                                        <br>
                                        {!!  max_file_size_helper() !!}
                                        {!!  $errors->first('client_logo', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="row form-group ">
                        <div class="col-sm-12">
                            <div class="row">

                                <div class="col-xs-6 col-lg-6 col-md-12 col-sm-6 col-xs-12">
                                    <div
                                            class="form-group text_content">
                                        {{ Form::label('note', __('label.note'), ['class' =>'']) }}
                                        {{ Form::textarea('note',null,['class'=>'form-control', 'id' => 'note','placeholder' => '', 'autocomplete' => 'off']) }}
                                        {!! $errors->first('note', '<span class="badge badge-danger">:message</span>') !!}
                                    </div>
                                </div>

                                <div class="col-xs-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">

                                </div>
                            </div>
                        </div>
                    </div>
                    <br/>
                    <div
                            class="row">
                        <div class="col-md-6">
                            <div class="element-form">
                                <div class="form-group pull-right">
                                    {{ link_to_route('cms.client.index',trans('buttons.general.cancel'),[],['id'=> 'cancel', 'class' => 'btn btn-primary cancel_button', ]) }}
                                    {{ Form::button(trans('label.submit'), ['class' => 'btn btn-primary submit','id'=>'client', 'type'=>'submit', 'style' => 'border-radius: 5px;']) }}
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
    {{ Html::script(url('assets/nextbyte/plugins/maskmoney/js/maskmoney.min.js')) }}
    {{ Html::script(url('vendor/jquery-maskedinput/jquery.maskedinput.js')) }}
    <script>
        $(function () {
            $(".select2").select2();
            /*start:
            Masking
            tin*/
            $.mask.definitions['~']= "[+-]";
            $('.tin').mask("999-999-999");


            $('.money').maskMoney({
                precision : 2,
                allowZero : true,
                affixesStay : false
            });

            // hide_contact_person_div();

            // $("#iscompany").on('change',function (e) {
            //     var checkBox = document.getElementById("iscompany");
            //     if (checkBox.checked == true){
            //         activate_contact_person()
            //     } else {
            //         hide_contact_person_div()
            //     }
            //     // activate_contact_person()
            //
            // });

            $(document).ready(function() {

                $("select.iscompany").change(function () {
                    var selectedOption = $(this).children("option:selected").val();
                    if(selectedOption == 1)
                    {
                        activate_contact_person()
                    }else
                    {
                        hide_contact_person_div()

                    }

                });
            });

            //show contact person div
            function activate_contact_person()
            {
                $("#" + 'contact_person_div').show();
                $("#" + 'contact_person').prop("disabled", false);
                $("#" + 'contact_person_phone').prop("disabled", false);
            }

            //hide contact person div
            function hide_contact_person_div() {
                $("#" + 'contact_person_div').hide();
                $("#contact_person_phone").attr("disabled", this.checked);
                $("#contact_person").attr("disabled", this.checked);
            }

            //
            // //control hide and show inload
            // window.onload = function () {
            //     var divSelect = $( "#is_system_user option:selected" ).val();
            //
            //     if (divSelect ==1 ) {
            //         activate_system_user()
            //     } else {
            //         hide_system_user_div();
            //     }
            //     // var checkBox = document.getElementById("iscompany");
            //     //
            //     // if (checkBox.checked == true){
            //     //     activate_contact_person()
            //     // } else {
            //     //     hide_contact_person_div()
            //     // }
            // };

            companyOption();
            function companyOption()
            {
                var choice = element_id_value('iscompany');
                if(choice == '1'){
                    activate_contact_person
                }else{

                    hide_contact_person_div()
                }
            }


            $('body').on('submit', 'form[name=create]', function(e) {
                e.preventDefault();
                /*Codes Here*/
                pleaseWaitSubmitButton("client","label","{{ trans('label.please_wait') }}",1);

                this.submit();

            });
        });
    </script>
@endpush
