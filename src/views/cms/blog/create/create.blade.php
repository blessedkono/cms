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

            <div class="row">
                <div class="col-md-6">

                </div>
                <div class="col-md-6">
                    <button type="button" class="mb-1 mt-1 mr-1 btn btn-primary btn-xs pull-right"><i class="fas fa-paper-plane"></i> {{trans('label.blog.publish')}}</button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    @include('cms.blog.create.includes.post_info')
                    @include('cms.blog.create.includes.attach_images')
                </div>

                <div class="col-md-3">
                    @include('cms.blog.create.includes.post_setting')
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

            //for the editor
            // ClassicEditor.create( document.querySelector( '#editor' ) );

            //for select 2
            $(".select2").select2();




            //save blog before publish
            $(document).on('click','#save_btn',function (e) {
                e.preventDefault();
                var title = $('#title').val();
                // var description = $('#editor').val();
                var description = theEditor.getData();
                var category  = $('#blog_category_id').val();
                var publish_date  = $('#publish_date').val();
                var publish_time  = $('#publish_time').val();
                var file  = $('#file').val();
                if ( title.length == 0 || description.length == 0) {
                    $('#title_errors').empty();
                    $('#content_errors').empty();
                    if (title.length == 0)
                    {
                        $('#title_errors').append(`<p id="client_errors" style="color: red">Title required</p>`);
                    }

                    if (description.length == 0)
                    {
                        $('#content_errors').append(`<p id="client_errors" style="color: red">Content required</p>`);
                    }

                    return false;
                }
                var data = {
                    'title' : title,
                    'content' :description,
                    'blog_categories' : category,
                    'publish_date' : publish_date,
                    'publish_time' : publish_time,
                    'file' : file,

                };
                var url = '{{route('cms.blog.store')}}';
                $.ajax({
                    type: 'post',
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data,
                    cache: false,

                    success: function (response) {
                        if (response) {
                            document.getElementById("store_blog").reset();
                            theEditor.setData('');

                            new PNotify({
                                title: 'Successfully !! New Blog Created ',
                                type: 'info',
                            });
                        }
                    },
                }).done(

                );
            })


    })
    </script>

@endpush
