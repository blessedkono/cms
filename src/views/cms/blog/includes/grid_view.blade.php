@extends('cms.layouts.cms', ['title' => __("label.blog.blog"), 'header' => __("label.blog.blog")])

@include('includes.datatable_assets')
@push('after-styles')
    <style>
        .card{
            border-radius: 4px;
            background: whitesmoke;
            padding: 14px 80px 18px 36px;
            cursor: pointer;
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0,0,0,.12), 0 4px 8px rgba(0,0,0,.06);
        }

        .card:hover{
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0,0,0,.12), 0 4px 8px rgba(0,0,0,.06);
        }

        .card h3{
            font-weight: 600;
        }

        .card img{
            position: absolute;
            top: 20px;
            right: 15px;
            max-height: 120px;
        }

        .card-1{
            background-image: url(https://ionicframework.com/img/getting-started/ionic-native-card.png);
            background-repeat: no-repeat;
            background-position: right;
            background-size: 80px;
        }


        @media(max-width: 990px){
            .card{
                margin: 20px;
            }
        }

        [data-toggle="collapse"] .fa:before {
            content: "\f139";
        }

        [data-toggle="collapse"].collapsed .fa:before {
            content: "\f13a";
        }
    </style>
@endpush
@section("content")


    <div class="row">
        <div class="col-md-12">
            <div>
                <div class="row">
                    <div class="col-md-8">

                    </div>

                    <div class="col-md-4">
                        <a href="{{route('cms.blog.create')}}" type="button" class="mb-1 mt-1 mr-1 btn btn-xs btn-primary pull-right">New Post</a>
                    </div>
                </div>

                <div class="row">
                    @foreach($blogs  as $blog)

                        <div class="col-md-4 mt-4" id="blog{{$blog->id}}">
                            <div class="card bg- bg-{{($blog->status == 0)?'light' :'info'}} card-1">

                                <h4 id="blog_title">{{truncateString($blog->title,50)}}</h4>
                                {{--                            <p>{!! $blog->content !!}</p>--}}
                                <div class="row">
                                    <div class="col-md-4" id="blog{{$blog->id}}">

                                    </div>
                                    <div class="col-md-8">
                                        <div class="btn-group btn-group-toggle pull-right" data-toggle="buttons">
                                            <a class="mb-1 ml-1 pull-right delete_blog"  style="text-decoration: none;cursor: pointer" id="{{$blog->id}}" data-toggle="tooltip" data-html="true"
                                               data-original-title="Delete"><i class="fa fa-trash"></i></a>

                                            <a class="ml-1" data-toggle="tooltip" data-html="true"
                                               data-original-title="Publish"><i class="fa fa-paper-plane"></i>
                                            </a>
                                            <a class="mb-1 ml-1 pull-right" href="{{route('cms.blog.edit',$blog->uuid)}}" style="text-decoration: none;cursor: pointer;color: #000000" data-id="{{$blog->id}}" id="edit_blog" data-toggle="tooltip" data-html="true"
                                               data-original-title="Edit"><i class="fa fa-pencil-alt"></i></a>

                                            <a class="m-xs pull-right ml-1"  data-container="body" data-placement="top" title=""   aria-describedby="popover867311" style="cursor:pointer;" data-id="{{$blog->id}}" id="view_blog" data-toggle="tooltip" data-html="true"
                                               data-original-title="View"><i class="fa fa-eye"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>

    </div>

    @include('cms.blog.includes.add_modal')
    @include('cms.blog.show.includes.view_blog')
@endsection

@push('after-scripts')
    {!! Html::script(url('vendor/sweetalert/sweetalert.min.js')) !!}

    {!! Html::script(url('cms/vendor/ckeditor5/ckeditor.js')) !!}
    <script>
        $(function () {
            var theEditor;

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
            $(document).on('click','#update_blog_btn',function (e) {
                e.preventDefault();
                var title = $('#title').val();
                var description = theEditor.getData();
                var category  = $('#blog_category').val();
                var publish_date  = $('#publish_date').val();
                var publish_time  = $('#publish_time').val();
                var blog_id = $('#blog_id').val();

                var data = {
                    'title' : title,
                    'content' :description,
                    'category' : category,
                    'publish_date' : publish_date,
                    'publish_time' : publish_time,
                    'blog_id' : blog_id,

                };
                $.ajax({
                    type: 'post',
                    url: '{{route('cms.blog.update')}}',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data,
                    cache: false,
                    success: function (response) {
                        if (response) {
                            new PNotify({
                                title: 'Note is successfully updated  ' + response.title,
                                type: 'info',
                            });

                            $( '#blog'+blog_id).find('#content').empty();
                            $( '#blog'+blog_id).find('#blog_title').text((response.title).substring(0,30));
                            // $( '#blog'+blog_id).find('#new_description').html((response.description).substring(0,50));
                            $('#formModal').modal('hide');

                        }
                    },
                }).done(

                );
            });



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
