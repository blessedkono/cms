@extends('cms.layouts.cms', ['title' => __('label.profile') , 'header' => __('label.profile')])

@include('includes.sweetalert_assets')

@push('after-styles')

    <style>
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col">
            <div class="tabs tabs-dark">
                {{--Start: Tab Contents--}}
                <div class="tab-content">
                    <div id="general" class="tab-pane active">

                        <div class = "row">
                            <div class="col-md-12">
                                <div class="pull-right">
                                    <a href="{{ route('cms.user_manual.module_functional_part.edit',$module_functional_part->id) }}" class="btn btn-xs btn-primary"><i class="fas fa-edit"></i> {{ __('label.crud.edit') }}</a>
                                    {!! HTML::decode(link_to_route('cms.user_manual.module_functional_part.delete', trans('label.crud.delete'), [$module_functional_part->id], ['data-method' => 'delete', 'data-trans-button-cancel' => trans('buttons.general.cancel'), 'data-trans-button-confirm' => trans('buttons.general.confirm'), 'data-trans-title' => trans('label.warning'), 'data-trans-text' => trans('alert.general.alert.delete'), 'class' => 'btn btn-danger btn-xs'])) !!}
{{--                                    <a href="{{ route('cms.user_manual.index') }}" class="btn btn-xs btn-info"><i class="fas fa-closed-captioning"></i> {{ __('label.close') }}</a>--}}
                                </div>
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-striped table-bordered" id="">
                                            <tbody>
                                            <tr>
                                                <th width="170px"> {{trans('label.title')}} : </th>
                                                <td>{{$module_functional_part->title}}</td>
                                            </tr> <tr>
                                                <th width="170px"> {{trans('label.cms.user_manual.navigation_link')}} : </th>
                                                <td>{{$module_functional_part->navigation_link}}</td>
                                            </tr>
                                            <tr>
                                                <th width="170px"> {{trans('label.cms.user_manual.media_link')}} : </th>
                                                <td>{{$module_functional_part->media_link}}</td>
                                            </tr>
                                            <tr>
                                                <th width="170px"> {{trans('label.module')}} : </th>
                                                <td></td>
                                            </tr>

                                            <tr>
                                                <th width="170px"> {{trans('label.status')}} : </th>
                                                <td>{{($module_functional_part->isactive)?trans('label.active'):trans('label.inactive')}}</td>
                                            </tr>
                                            <tr>
                                                <th width="170px"> {{trans('label.description')}} : </th>
                                                <td id="description">{!! $module_functional_part->description !!}</td>
                                            </tr>
                                            </tbody>
                                        </table>

                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        @include('cms.user_manual.module_functional_part.includes.images')
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
    </div>
@endsection

@push('after-scripts')
    {!! Html::script(url('vendor/jquery-expander/jquery.expander.js')) !!}

    <script>
        $(document).on('click','#upload_images',function (e) {
            e.preventDefault();
            dropzone.processQueue();
        });
        $(function() {

            /*Read more*/
            $(document).ready(function() {
                $('#description').expander({
                    slicePoint: 200,
                    widow: 2,
                    expandEffect: 'show',
                    userCollapseText: '{{ __('label.read_less') }}',
                    expandText: '{{ __('label.read_more') }}',
                });
            });
        });
    </script>
@endpush
