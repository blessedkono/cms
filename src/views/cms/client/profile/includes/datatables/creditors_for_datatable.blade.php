
    <section class="card mb-4">
        {{--Start: Datatable--}}
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-right">
{{--                        <a href="{{ route('operation.expense.create') }}" class="btn btn-xs btn-primary"><i class="fas fa-plus-circle"></i> {{ __('label.crud.add') }}</a>--}}
                    </div>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-hover table-responsive-md" id="creditors-table">
                        <thead>
                        <tr>
                            <th>@lang('label.sn')</th>
                            <th>{{ __('label.client.client') }}</th>
                            <th>{{ __('label.sales.shift.shift') }}</th>
                            <th>{{ __('label.sales.shift.shift_date') }}</th>
                            <th>{{ __('label.product') }}</th>
                            <th>{{ __('label.qty') }}</th>
                            <th>{{ __('label.unit_price') }}</th>
                            <th>{{ __('label.amount') }}</th>
                            <th>{{ __('label.isfuel') }}</th>



                            {{--                            <th>{{ __('label.actions') }}</th>--}}
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <td > </td>
                            <td > </td>
                            <td > </td>
                            <td > </td>
                            <th > </th>
                            <td > </td>
                            <th > {{ trans('label.total') }}</th>
                            <td > {{ number_2_format($client->total_creditor_amount) }}</td>
                            <td > </td>

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
        $('#creditors_tab').one('click',function () {
            $('#creditors-table').DataTable({
                processing: true,
                serverSide: true,
                ajax:{
                    url : '{{ route('operation.loan.creditor.get_creditor_for_client',$client->uuid) }}',
                    type : 'get'
                },
                columns: [
                    { data: 'DT_Row_Index', name: 'DT_Row_Index', orderable: false, searchable: false},
                    { data: 'client_name', name: 'client_name', orderable: false, searchable: false },
                    { data: 'shift', name: 'shift', orderable: false, searchable: false },
                    { data: 'shift_date', name: 'shift_date', orderable: false, searchable: false },
                    { data: 'product_name', name: 'product_name', orderable: false, searchable: false },
                    { data: 'qty', name: 'qty', orderable: false, searchable: false },
                    { data: 'unit_price', name: 'unit_price', orderable: false, searchable: false },
                    { data: 'amount', name: 'amount', orderable: false, searchable: false },
                    { data: 'isfuel', name: 'isfuel', orderable: false, searchable: false },
                ],
            });
        })

    </script>
@endpush
