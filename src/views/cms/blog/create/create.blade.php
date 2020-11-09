@extends('cms.layouts.cms', ['title' => __("label.blog.create"), 'header' => __("label.blog.create")])

@include('includes.datetimepicker')
@push('after-styles')
    {{ Html::style(url('vendor/dropzone/dropzone.css')) }}
    {{ Html::style(url('vendor/dropzone/basic.css')) }}


    <style>
        [data-toggle="collapse"] .fa:before {
            content: "\f139";
        }

        [data-toggle="collapse"].collapsed .fa:before {
            content: "\f13a";
        }

    </style>
 @endpush
@section("content")
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => ['cms.blog.store'],'method'=>'post', 'autocomplete' => 'off',  'id' =>'store_blog', 'class' => 'form-horizontal needs-validation', 'novalidate','enctype'=>"multipart/form-data"]) !!}
            {!! Form::hidden('action_type', 1, []) !!}

            <div class="row">
                <div class="col-md-6">

                </div>
                <div class="col-md-6">
{{--                    <button type="button" class="mb-1 mt-1 mr-1 btn btn-primary btn-xs pull-right"><i class="fas fa-paper-plane"></i> {{trans('label.blog.publish')}}</button>--}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    @include('cms.blog.create.includes.post_info')
                    @include('cms.blog.create.includes.post_setting')

                </div>

                <div class="col-md-6">
                    @include('cms.includes.attach_images')
                </div>
            </div>

            <hr>
            <div class="row">
                <div class="col-md-12 text-center">
                    {!! link_to_route('cms.blog.index',trans('buttons.general.cancel'),[],['id'=> 'cancel', 'class' => 'btn btn-primary btn-xs cancel_button', ]) !!}
                    {!! Form::button(trans('label.save'), ['class' => 'btn btn-primary btn-xs','id' => 'save_btn', 'type'=>'submit']) !!}
                </div>

            </div>

            {{ Form::close() }}

        </div>
    </div>

@endsection


@push('after-scripts')
    {!! Html::script(url('cms/vendor/ckeditor5/ckeditor.js')) !!}
    {!! Html::script(url('assets/nextbyte/plugins/dropzone/dropzone.js')) !!}


    <script>

        $(function () {

            ClassicEditor.create( document.querySelector( '#editor' ) );

            //for the editor
            // ClassicEditor.create( document.querySelector( '#editor' ) );

            //for select 2
            $(".select2").select2();



            //save blog before publish
            // $(document).on('click','#save_btn',function (e) {
            //     e.preventDefault();
            //     var task_title = $('#title').val();
            //     // var description = $('#editor').val();
            //     var content = theEditor.getData();
            //     var category  = $('#blog_category_id').val();
            //     var publish_date  = $('#publish_date').val();
            //     var publish_time  = $('#publish_time').val();
            //     var file  = $('#file').val();
            //     if ( task_title.length == 0 || content.length == 0) {
            //         $('#title_errors').empty();
            //         $('#content_errors').empty();
            //         if (task_title.length == 0)
            //         {
            //             $('#title_errors').append(`<p id="client_errors" style="color: red">Title required</p>`);
            //         }
            //
            //         if (content.length == 0)
            //         {
            //             $('#content_errors').append(`<p id="client_errors" style="color: red">Content required</p>`);
            //         }
            //
            //         return false;
            //     }
            //     $('#store_blog').submit();
            //
            //
            // })
            $(document).ready(function() {
                $("select.isschedule").change(function () {
                    var selectedOption = $(this).children("option:selected").val();
                    if(selectedOption == 1)
                    {

                        activate_schedule_div()
                    }else
                    {
                        hide_schedule_div()

                    }

                });
            });

            //show contact person div
            function activate_schedule_div()
            {
                $("#" + 'schedule_div').show();

            }

            //hide contact person div
            function hide_schedule_div() {
                $("#" + 'schedule_div').hide();

            }

    })
    </script>

@endpush
