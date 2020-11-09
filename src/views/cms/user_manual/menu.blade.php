@extends('cms.layouts.cms', ['title' => __("label.user_manual"), 'header' => __("label.user_manual")])

@push('after-styles')


@endpush

@section('content')
    <div class="row">
        <div class="col-md-8">

        </div>

        <div class="col-md-4">
            <a href="{{route('cms.user_manual.module_groups.creat')}}" type="button" class="mb-1 mt-1 mr-1 btn btn-xs btn-primary pull-right">{{trans('label.cms.user_manual.new_module_group')}}</a>
        </div>
    </div>
    <div class="row">
        @foreach($module_groups as $module_group)
{{--            @if($module_group->check_if_user_permitted)--}}
                <div class="col-md-4">
                    <div class="list-group">
                        <ul class="list-unstyled">
                            <li>
                                <a href="{{ route('cms.user_manual.modules_by_group', $module_group->id) }}" class="list-group-item list-group-item-action">
                                    <h5 class="list-group-item-heading"><i class="fas fa-clipboard"></i> {{ $module_group->name }}</h5>
                                    {{--<p class="list-group-item-text">@lang('label.business.tender_label')</p>--}}
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
{{--            @endif--}}
        @endforeach

    </div>

@endsection
