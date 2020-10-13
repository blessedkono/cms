@extends('cms.layouts.cms', ['title' => __('label.cms.faq.faq_profile'), 'header' => __('label.cms.faq.faq_profile')])

@include('includes.datatable_assets')

@push('after-styles')
{!! Html::style(url('cms/vendor/sweetalert/sweetalert.css')) !!}
<style>

</style>
@endpush

@section('content')
    {{--@php--}}
    {{--$country = new \App\Repositories\Sysdef\CountryRepository();--}}
    {{--$region = new \App\Repositories\Sysdef\RegionRepository();--}}
    <div>
        <div class="row">

            <div class="col-md-12">

                {{--Event details --}}

                        <section class="card card-primary mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12" >
                                        <div class="pull-right" >
                                            {{--<a href="{{ route('faq.index') }}"  ><i class="fas fa-arrow-left"></i>&nbsp;@lang('label.go_back')</a>&nbsp;&nbsp;--}}
{{--                                            {!! $faq->delete_faq !!}--}}
                                            <a class='btn btn-info btn-xs'  href="{{ route('cms.faq.edit', $faq->uuid) }}"  >&nbsp;{!! __('label.crud.edit') !!}</a>&nbsp;&nbsp;
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-9">
                                <table class="table table-striped table-bordered" id="sidebar_summary">
                                    <tbody>
                                    <tr>
                                        <th>{!! __('label.title')!!}:</th>
                                        <td>{!! $faq->title !!}</td>
                                    </tr>
                                    <tr>
                                        <th>{!! __('label.created_at')!!}:</th>
                                        <td>{!! short_date_format($faq->created_at) !!}</td>
                                    </tr>
                                    <tr>
                                        <th>{!! __('label.status')!!}:</th>
                                        <td>{!! ($faq->isactive)?trans('label.active'):trans('label.inactive') !!}</td>
                                    </tr>
                                    <tr>
                                        <th>{!! __('label.content')!!}:</th>
                                        <td> {!! $faq->content !!}</td>
                                    </tr>



                                    </tbody>
                                </table>

                                    </div>
                                </div>

                            </div>
                            <hr class="dotted short">
                            <br/>
                        </section>


            </div>
            {{--sidebar summary--}}

        </div>
    </div>



@endsection

@push('after-scripts')
{!! Html::script(url('cms/vendor/sweetalert/sweetalert.min.js')) !!}
{!! Html::script(url('cms/vendor/jquery-expander/jquery.expander.js')) !!}


<script  type="text/javascript">

    $(document).ready(function() {
        $('.events').expander({
            slicePoint: 300,
            widow: 2,
            expandEffect: 'show',
            userCollapseText: 'Read Less',
            expandText: 'Read More'
        });
    });


    $(function () {
        if (location.hash !== '') {
            $('a[href="' + location.hash + '"]').tab('show');
            $('a[href="' + location.hash + '"]').trigger('click');
        }
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            var tab = $(e.target).attr('href').substr(1);
            if (history.pushState) {
                history.pushState(null, null, '#' + tab);
                //var id = this.id;
                //alert(id);
            } else {
                location.hash = '#' + tab;
            }
        });

        function openTab(tab) {
            $("#foo").foundation("selectTab", tab);
        }


    });

</script>;

@endpush

