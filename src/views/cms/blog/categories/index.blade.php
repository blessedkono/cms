@extends('cms.layouts.cms', ['title' => __('label.blog.categories') , 'header' => __('label.blog.categories')])

@include('includes.datatable_assets')
@include('includes.sweetalert_assets')

@push('after-styles')
    <style>
    </style>
@endpush

@section('content')
    <section class="card mb-4">
        {{--Start: Datatable--}}
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-right">
                        <a href="{{ route('cms.category.create') }}" class="btn btn-xs btn-primary"><i class="fas fa-plus-circle"></i> {{ __('label.crud.add') }}</a>
                    </div>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-hover table-responsive-md" id="destignation-table">
                        <thead>
                        <tr>
                            <th>@lang('label.sn')</th>
                            <th>{{ __('label.name') }}</th>
                            <th>{{ __('label.short_name') }}</th>
                            <th>{{ __('label.status') }}</th>
                            <th>{{ __('label.actions') }}</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('after-scripts')
    <script type="text/javascript">
        var url = "{{ url("/") }}";
        $('#destignation-table').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url : '{{ route('cms.category.get_all_for_dt') }}',
                type : 'get'
            },
            columns: [
                { data: 'DT_Row_Index', name: 'DT_Row_Index', orderable: false, searchable: false},
                { data: 'name', name: 'name', orderable: false, searchable: true },
                { data: 'short_name', name: 'short_name', orderable: false, searchable: true },
                { data: 'status', name: 'status', orderable: false, searchable: false },
                { data: 'actions', name: 'actions', orderable: false, searchable: false },

            ],

        });
    </script>
@endpush
