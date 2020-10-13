@extends('cms.layouts.cms', ['title' => __('label.cms.client.client_profile') , 'header' => __('label.cms.client.client_profile')])

@include('includes.sweetalert_assets')
@include('includes.datatable_assets')

@push('after-styles')
    <style>
    </style>
@endpush

@section('content')


    <!-- start: page -->

    <div class="row">
        <div class="col-md-12">

            <div class="tabs tabs-dark">

                <div class="tab-content">
                    <div id="overview" class="tab-pane active">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="pull-right mb-2">
                                    <a href="{{ route('cms.client.edit',$client->uuid) }}"
                                       class="btn btn-xs btn-primary"><i
                                                class="fas fa-edit"></i> {{ __('label.crud.edit') }}</a>
{{--                                    {{ $client->change_status_button }}--}}
                                    <a href="{{ route('cms.client.index') }}" class="btn btn-xs btn-info"><i
                                                class="fas fa-closed-captioning"></i> {{ __('label.close') }}</a>

                                </div>

                            </div>


                            <div class="col-md-9">

                                @include('cms/client/profile/includes/general/overview')

                            </div>


                            <div style="background-color: #f5f5f5" class="col-md-3">
                                <br/>

                                @include('cms/client/profile/includes/general/sidebar_summary')
                            </div>


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
    <script>
        $(function () {

            $(document).ready(function() {
                $('#note').expander({
                    slicePoint: 300,
                    widow: 2,
                    expandEffect: 'show',
                    userCollapseText: 'Read Less',
                    expandText: 'Read More'
                });
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
