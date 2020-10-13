@extends('cms.layouts.cms', ['title' => trans('label.faqs'), 'header' => trans('label.faqs')])

@include('includes.datatable_assets')
@push('after-styles')
{!! Html::style(url('cms/vendor/sweetalert/sweetalert.css')) !!}
<style>

</style>
@endpush

@section('content')

    <div class="row">
        <div class="col-md-12">
            <section class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="pull-right">
                                <a href="{{ route('cms.faq.create') }}" class="btn btn-primary btn-xs">
                                    <i class="fas fa-plus"></i>
                                    {{trans('label.add')}}
                                </a>
                            </div>
                        </div>
                    </div>


                    @include('cms.faq.includes.faq_datatable')
                </div>
            </section>
        </div>
    </div>

@endsection
@push('after-scripts')
{!! Html::script(url('cms/vendor/sweetalert/sweetalert.min.js')) !!}

@endpush
