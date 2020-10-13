@extends('cms.layouts.cms', ['title' => __("label.blog.create"), 'header' => __("label.blog.create")])

@include('includes.datetimepicker')
@push('after-styles')
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
                    @include('cms.blog.edit.includes.post_info')
                </div>

                <div class="col-md-3">
                    @include('cms.blog.edit.includes.post_setting')
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
                var category  = $('#blog_category').val();
                var publish_date  = $('#publish_date').val();
                var publish_time  = $('#publish_time').val();
                var data = {
                    'title' : title,
                    'content' :description,
                    'category' : category,
                    'publish_date' : publish_date,
                    'publish_time' : publish_time,

                };
                console.log(data)
                var formData = new FormData(document.getElementById( 'store_blog'));
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
                        console.log(response);
                        if (response) {
                            // new PNotify({
                            //     title: 'Document is successfully attached in',
                            //     type: 'info',
                            // });
                        }
                    },
                }).done(

                );
            })


        })
    </script>

@endpush
