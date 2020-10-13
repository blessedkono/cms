
    <section class="card mb-4">
        {{--Start: Datatable--}}
        <div class="card-body">

            <br/>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-hover table-responsive-md" id="client_discount-table">
                        <thead>
                        <tr>
                            <th>@lang('label.sn')</th>
                            <th>{{ __('label.client.client') }}</th>
                            <th>{{ __('label.station') }}</th>
                            <th>{{ __('label.sales.shift.shift_date') }}</th>
                            <th>{{ __('label.sales.discount.type') }}</th>
                            <th>{{ __('label.amount') }}</th>
                        </tr>
                        </thead>

                        <tfoot>
                        <tr>
                            <td > </td>
                            <td > </td>
                            <td > </td>
                            <td > </td>
                            <th > {{ trans('label.total') }}</th>
                            <td > {{ number_2_format($client->total_discounts) }}</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </section>
@push('after-scripts')
    <script type="text/javascript">
        var url = "{{ url("/") }}";
        $('#discount_tab').one('click',function () {
            $('#client_discount-table').DataTable({
                processing: true,
                serverSide: true,
                ajax:{
                    url : '{{ route('operation.sales.discount.get_client_discount_for_dt',$client->uuid) }}',
                    type : 'get'
                },
                columns: [
                    { data: 'DT_Row_Index', name: 'DT_Row_Index', orderable: false, searchable: false},
                    { data: 'client_name', name: 'clients.name', orderable: false, searchable: true },
                    { data: 'station_id', name: 'station_id', orderable: false, searchable: false },
                    { data: 'shift_date', name: 'shift_date', orderable: false, searchable: false },
                    { data: 'discount_type', name: 'code_values.name', orderable: false, searchable: true },
                    { data: 'amount', name: 'amount', orderable: false, searchable: false },
                ],
                "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    $(nRow).click(function() {
                        document.location.href = url + "/operation/sales/discount/profile/" + aData['uuid'] ;
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
