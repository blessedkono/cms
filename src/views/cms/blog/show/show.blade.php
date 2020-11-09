@extends('cms.layouts.cms', ['title' => __('label.profile') , 'header' => __('label.profile')])

@include('includes.sweetalert_assets')
@include('includes.datatable_assets')

@push('after-styles')
    {{ Html::style(url('vendor/dropzone/dropzone.css')) }}
    {{ Html::style(url('vendor/dropzone/basic.css')) }}
    <style>
    </style>
@endpush

@section('content')


    <!-- start: page -->

    <div class="row">
        <div class="col-md-12">

            <div class="tabs tabs-dark">

                <div class="tab-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="pull-right mb-2">
                                    <a href="{{ route('cms.blog.edit',$blog->uuid) }}" class="btn btn-xs btn-primary"><i class="fas fa-edit"></i> {{ __('label.crud.edit') }}</a>
                                    {{ $blog->change_status_button }}

                                    <a class="btn btn-warning btn-xs   delete_blog"  style="text-decoration: none;cursor: pointer" id="{{$blog->id}}">{{trans('label.crud.delete')}}</a>
                                    @if($blog->status == 1)

                                        @else
                                    <a href="{{ route('cms.blog.publish',$blog->uuid) }}" class="btn btn-xs btn-dark"><i class="fas fa-paper-plane"></i> {{ __('label.blog.publish') }}</a>
                                    @endif

                                    <a href="{{ route('cms.client.index') }}" class="btn btn-xs btn-info"><i class="fas fa-closed-captioning"></i> {{ __('label.close') }}</a>

                                </div>

                            </div>

                        </div>
                    <div class="row">
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-striped table-bordered" id="">
                                        <tbody>
                                        <tr>
                                            <th width="170px"> {{trans('label.title')}} : </th>
                                            <td>{{$blog->title}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>{!! trans('label.created_at') !!} :</b></td>
                                            <td>{!! isset($blog->created_at)? short_date_format($blog->created_at) : 'None' !!}</td>
                                        </tr>
                                        <tr>
                                            <td><b>{!! trans('label.status') !!} :</b></td>
                                            <td>{!! ($blog->status == 1)? trans('label.published') : trans('label.draft') !!}</td>
                                        </tr>
                                        <tr>
                                            <td><b>{!! trans('label.isactive') !!} :</b></td>
                                            <td>{!! ($blog->isactive)? trans('label.yes') : trans('label.no') !!}</td>
                                        </tr>
                                        <tr>
                                            <td><b>{!! trans('label.is_schedule') !!} :</b></td>
                                            <td>{!! ($blog->isscheduled)? trans('label.yes') : trans('label.no') !!}</td>
                                        </tr>
                                        <tr>
                                            <td><b>{!! trans('label.blog.publish_on') !!} :</b></td>
                                            <td>{!!  short_date_format($blog->publish_date)  !!} <span class="badge badge-dark">{!! $blog->publish_time !!}</span></td>
                                        </tr>


                                        {{--@if(isset($blog->))--}}
                                        @if($blog->categories->count() > 0)
                                            <tr>
                                                <td><b>{!! trans('label.category') !!} :</b></td>
                                                <td>
                                                    @foreach($blog->categories as $category)
                                                    <span class="badge badge-dark">{{$category->name}}</span>
                                                    @endforeach
                                                </td>
                                            </tr>
                                        @endif

                                        <tr>
                                            <th width="170px"> {{trans('label.description')}} : </th>
                                            <td id="description">{!! $blog->content !!}</td>
                                        </tr>
                                        </tbody>
                                    </table>

                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    @include('cms.blog.show.includes.blog_images')
                                </div>
                            </div>

                        </div>

                        <div class="col-md-3">
                            <legend style="background-color: lightgray; color: grey;"> {{ __('label.sidebar_summary') }}</legend>
                            <table class="table table-striped table-bordered" id="sidebar_summary">
                                <tbody>
                                <tr>
                                    <td width="130px">{{'' }}</td>
                                    <td>{{'' }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>






                </div>
            </div>
        </div>


    </div>
    <!-- end: page -->

@endsection

@push('after-scripts')
    {{ Html::script(url('vendor/jquery-expander/jquery.expander.js')) }}
    {!! Html::script(url('assets/nextbyte/plugins/dropzone/dropzone.js')) !!}

    <script>

        $(function () {
            $('#description').expander({
                slicePoint: 300,
                widow: 2,
                expandEffect: 'show',
                userCollapseText: 'Read Less',
                expandText: 'Read More'
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
                                if (response){
                                    $('#blog'+blog_id).remove();
                                    window.location.href = '{{route('cms.blog.index')}}'
                                    new PNotify({
                                        title: 'Blog is successfully deleted ',
                                        type: 'info',
                                    });
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


            $(document).ready(function() {

            });




            $(document).on('click', '.modal-confirm', function (e) {
                e.preventDefault();
                $.magnificPopup.close();

                new PNotify({
                    title: 'Success!',
                    text: 'Modal Confirm Message.',
                    type: 'success'
                });
            });
        });




    </script>
@endpush
