<table class="table table-hover table-responsive-lg table-lg mt-2" id="faqs-table">
    <thead>
    <tr>
        <th>@lang('label.sn')</th>
        <th>@lang('label.title')</th>
        <th>@lang('label.status')</th>
        <th>@lang('label.actions')</th>
    </tr>
    </thead>
</table>

@push('after-scripts')

<script  type="text/javascript">

    $(function() {
        var url = "{!! url("/") !!}";
        $('#faqs-table').DataTable({
            processing: true,
            serverSide: true,
            stateSave: true,
            searching: true,
            paging: true,
            info:true,
            stateSaveCallback: function (settings, data) {
                localStorage.setItem('DataTables_' + settings.sInstance, JSON.stringify(data));
            },
            stateLoadCallback: function (settings) {
                return JSON.parse(localStorage.getItem('DataTables_' + settings.sInstance));
            },
            ajax: '{!! route('cms.faq.get.admin_data') !!}',
            columns: [
                { data: 'DT_Row_Index', name: 'DT_Row_Index', orderable: false, searchable: false},
                { data: 'title', name: 'title', orderable: true, searchable: true},
                { data: 'status', name: 'status', orderable: true, searchable: true},
                { data: 'actions', name: 'actions', orderable: false, searchable: false},
            ],

        });
    });

</script>

@endpush
