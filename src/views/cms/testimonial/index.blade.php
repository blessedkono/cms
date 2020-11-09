@extends('cms.layouts.cms', ['title' => __('label.cms.testimonial.list') , 'header' => __('label.cms.testimonial.list')])

@include('includes.datatable_assets')

@push('after-styles')
    <style>
    </style>
@endpush

    @include('cms.testimonial.includes.table_contents')

