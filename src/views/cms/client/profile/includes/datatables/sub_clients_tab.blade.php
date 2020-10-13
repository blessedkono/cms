
<section class="card mb-4">
    {{--Start: Datatable--}}
    <div class="card-body">

        <div class="row">
            <div class="col-md-12">
                <div class="pull-right">
                      <a href="{{ route('operation.sub_client.create', $client->uuid) }}" class="btn btn-xs btn-primary"><i class="fas fa-plus-circle"></i> {{ __('label.crud.add') }}</a>
                </div>
            </div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-hover table-responsive-md" id="sub_clients-table">
                    <thead>
                    <tr>
                        <th>@lang('label.sn')</th>
                        <th>{{ __('label.name') }}</th>
                        <th>{{ __('label.isactive') }}</th>
                    </tr>
                    </thead>

                             </table>
            </div>
        </div>
    </div>
</section>
@push('after-scripts')
    <script type="text/javascript">
        var url = "{{ url("/") }}";
        $('#sub_clients_tab').one('click',function () {
            $('#sub_clients-table').DataTable({
                processing: true,
                serverSide: true,
                ajax:{
                    url : '{{ route('operation.sub_client.get_by_client_for_dt',$client->uuid) }}',
                    type : 'get'
                },
                columns: [
                    { data: 'DT_Row_Index', name: 'DT_Row_Index', orderable: false, searchable: false},
                    { data: 'name', name: 'name', orderable: false, searchable: true },
                    { data: 'isactive', name: 'isactive', orderable: false, searchable: false },
                                  ],
                "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    $(nRow).click(function() {
                        document.location.href = url + "/operation/sub_client/edit/" + aData['uuid'] ;
                    }).hover(function() {
                        $(this).css('cursor','pointer');
                    }, function() {
                        $(this).css('cursor','auto');
                    });
                }
            });
        })

    </script>
@endpush
