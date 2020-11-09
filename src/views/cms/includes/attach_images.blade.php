<div class="row">
    <div class="col-md-12">
        <div class="collapse show" id="attachments" style="margin-bottom: 20px" >
            <div class="row" id="">
                <div class="col-md-12">
                    <div class="card card-body" id="" style="background-color: whitesmoke">
                        <div class="row">
                            <div class="col-md-6">
                                <p><b>{{trans('label.attachment')}}</b></p>
                            </div>
                        </div>
                        <hr style="border: 0.025px solid black;margin-top: 0px;
">
                        <div class="wrapper" style="margin-bottom: 20px">
                            <div class="row">
                                <div class="col-md-6">

                                    <div class="form-group">
                                        {!! Form::label('document_title', trans("label.title"), ['class' => '']) !!}
                                        <input type="text" class="form-control document_title" name='document_title1' id="1" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    {!! Form::label('document_file', trans("label.choose_file").  ' (' . __('label.max') . __('label.size') .  ': ' .'MB'.  ')', ['class' => '']) !!}
                                    <input type="file" class="document_file" name='document_file1' id="rm1" value="{{old('document_file')}}"
                                    >
                                </div>

                            </div>
                        </div>
                        <a  value="Add Attachments" class="add_fields no_submit pull-right" id="attachements"style="margin-left: 0px;margin-top: 10px;cursor: pointer"><i class="fa fa-plus"></i>{{trans('label.add')}}</a>
                    </div>

                </div>


            </div>
        </div>

    </div>
</div>

@push('after-scripts')
    <script>
        //script for  more options of adding task documents
        $(document).ready(function() {
            var max_fields = 10; //Maximum allowed input fields
            var wrapper    = $(".wrapper"); //Input fields wrapper
            var add_button = $(".add_fields"); //Add button class or ID
            var x = 1; //Initial input field is set to 1

            //When user click on add input button
            $(add_button).click(function(e){
                e.preventDefault();
                //Check maximum allowed input fields
                if(x < max_fields || docCookies.getItem("wasloaded")){
                    x++; //input field increment
                    //add input field
                    $(wrapper).append('<div class="row">'+
                        '<div class="col-md-6">' +
                        '<div class="form-group">'+
                        '<label class="">@lang("label.title")'+ x + ' : </label>' +
                        '<input type="text" class="form-control document_title" name="document_title2' + x +
                        '" id="' + x + '" value="" >' +
                        '</div>'+
                        '</div>'+
                        '<div class="col-md-6"> '+
                        '{!! Form::label('document_file', trans("label.choose_file") .' (' . __('label.max') . __('label.size') .  ': ' . 'MB'.  ')', ['class' => '']) !!}'+
                        '<input type="file" class="document_file2" name="document_file2' + x +
                        '" id="rm' + x + '" value="" >' +
                        '</div>'+
                        '<a href="javascript:void(0);" class="remove_field" style="margin-left: 20px;margin-top: 10px;cursor: pointer:color:black;decoration:none"><i class="fa fa-minus-circle"></i> Remove</a>' +

                        '</div>' +
                        '</div>');

                }
            });

            //when user click on remove button
            $(wrapper).on("click",".remove_field", function(e){
                e.preventDefault();
                $(this).parent('div').remove(); //remove inout field
                x--; //inout field decrement
            });


            $("#document_file"+x).rules("add", "required");

        });

        // file upload
        $(document).on('change', '.file-upload', function(){
            var i = $(this).prev('label').clone();
            var file = this.files[0].name;
            $(this).prev('label').text(file);
        });
    </script>
@endpush
