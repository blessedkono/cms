@extends('cms.layouts.cms', ['title' => __("label.blog.blog"), 'header' => __("label.blog.blog")])

@include('includes.datatable_assets')
@push('after-styles')
    <style>

    </style>
@endpush
@section("content")

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div>
                        @include('cms.blog.includes.blogs_datatable')
                    </div>
                </div>

            </div>
        </div>
    </div>




@endsection

@push('after-scripts')
    {!! Html::script(url('vendor/sweetalert/sweetalert.min.js')) !!}

    {!! Html::script(url('cms/vendor/ckeditor5/ckeditor.js')) !!}
    <script>
        $(function () {
            var theEditor;

            ClassicEditor.create( document.querySelector( '#editor' ), {
                    toolbar: [ 'bold', 'italic', 'link', 'bulletedList', 'numberedList' ],
                })
                .then( editor => {
                    theEditor = editor;
                } )
                .catch( error => {
                    console.error( error );
                } );

            $(".select").select2({
                dropdownParent: $('#addNoteModal')
            });

            $('.select2').css('width', '100%');


            $(document).on('click','#view_blog',function () {
                var id = $(this).data('id');
                $.ajax({
                    url: '{{route('cms.blog.view_blog')}}',
                    data: {blog_id: id},
                    type: 'GET',
                }).done(function(resp) {
                    $('.modal-title').html(`<h5 class="text-uppercase"><b>${resp.data.title}</b></h5>`);
                    $('#viewBlogModal').modal('show');
                    $('#viewBlogModal .card-body').empty();

                    $('#viewBlogModal .card-body').append(resp.html);
                });
            });
            //edit blog
            //call edit modal
            $(document).on('click','#edit_blog',function () {
                var blog_id = $(this).data('id');
                $.ajax({
                    url: '{{route('cms.blog.get_blog_by_id_for_edit')}}',
                    data: {blog_id: blog_id},
                    type: 'GET',
                    dataType: 'JSON'
                }).done(function(resp) {
                    theEditor.setData(resp.content);
                    $('#title').val(resp.title);
                    $('#blog_category').val(resp.category_id);
                    $('#publish_date').val(resp.publish_date);
                    $('#publish_time').val(resp.publish_time);
                    $('#blog_id').val(resp.id);
                    $('.modal-title').text('Edit Blog');
                    $('.action_button').attr('id','update_blog_btn');
                    $('.modal-form').attr('id','update_blog');
                    $('#addModal').modal('show');
                });

                $('#formModal').modal('show');

            });


            //update blog
            {{--$(document).on('click','#update_blog_btn',function (e) {--}}
            {{--    e.preventDefault();--}}
            {{--    var title = $('#title').val();--}}
            {{--    var description = theEditor.getData();--}}
            {{--    var category  = $('#blog_category').val();--}}
            {{--    var publish_date  = $('#publish_date').val();--}}
            {{--    var publish_time  = $('#publish_time').val();--}}
            {{--    var blog_id = $('#blog_id').val();--}}

            {{--    var data = {--}}
            {{--        'title' : title,--}}
            {{--        'content' :description,--}}
            {{--        'category' : category,--}}
            {{--        'publish_date' : publish_date,--}}
            {{--        'publish_time' : publish_time,--}}
            {{--        'blog_id' : blog_id,--}}

            {{--    };--}}
            {{--    $.ajax({--}}
            {{--        type: 'post',--}}
            {{--        url: '{{route('cms.blog.update')}}',--}}
            {{--        headers: {--}}
            {{--            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
            {{--        },--}}
            {{--        data: data,--}}
            {{--        cache: false,--}}
            {{--        success: function (response) {--}}
            {{--            if (response) {--}}
            {{--                new PNotify({--}}
            {{--                    title: 'Note is successfully updated  ' + response.title,--}}
            {{--                    type: 'info',--}}
            {{--                });--}}

            {{--                $( '#blog'+blog_id).find('#content').empty();--}}
            {{--                $( '#blog'+blog_id).find('#blog_title').text((response.title).substring(0,30));--}}
            {{--                // $( '#blog'+blog_id).find('#new_description').html((response.description).substring(0,50));--}}
            {{--                $('#formModal').modal('hide');--}}

            {{--            }--}}
            {{--        },--}}
            {{--    }).done(--}}

            {{--    );--}}
            {{--});--}}



            //delete blog
            $(document).on('click','.delete_blog',function (e) {
                e.preventDefault();
                var blog_id = $(this).attr('id');
                swal({
                    title: "Are you sure you want to delete?",
//                text: "You $("#url").data("case") a contact from a group!",
                    icon: "warning",
                    buttons: [
                        'No, cancel!',
                        'Yes, I am sure!'
                    ],
                    dangerMode: true,
                }).then(function(isConfirm)  {
                    if (isConfirm) {
                        var url = '{{route('cms.blog.delete')}}';
                        var data = {'blog_id':blog_id};
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            url: url,
                            type: "post",
                            dataType: 'JSON',
                            data: data,
                            success: function (response) {
                                // new PNotify({
                                //     title: 'Blog is successfully deleted  ' + response.title,
                                //     type: 'info',
                                // });

                                if (response){
                                    $('#blog'+blog_id).remove();

                                }
                            }
                        }).done(

                        )

                    } else {
//                    swal("Cancelled", "You have cancel Action", "error");

                    }
                    $(".swal-overlay").remove();
                });
            })
        })

    </script>

@endpush
