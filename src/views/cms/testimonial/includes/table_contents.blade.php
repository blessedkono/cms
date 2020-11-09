
@section('content')
    <section class="card mb-4">
        {{--Start: Datatable--}}
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-right">
                        <a href="{{ route('cms.testimonial.create') }}" class="btn btn-xs btn-primary"><i class="fas fa-plus-circle"></i> {{ __('label.crud.add') }}</a>
                    </div>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-hover table-responsive-md" id="client_testimonial-table">
                        <thead>
                        <tr>
                            <th>@lang('label.sn')</th>
                            <th>{{ __('label.cms.client.client') }}</th>
                            <th>{{ __('label.designation') }}</th>
                            <th>{{ __('label.company') }}</th>
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
        $('#client_testimonial-table').DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url : '{{ route('cms.testimonial.get_all_for_dt') }}',
                type : 'get'
            },
            columns: [
                { data: 'DT_Row_Index', name: 'DT_Row_Index', orderable: false, searchable: false},
                { data: 'client', name: 'client', orderable: false, searchable: true },
                { data: 'designation', name: 'designation', orderable: false, searchable: false },
                { data: 'company_name', name: 'company_name', orderable: false, searchable: false },
            ],
            "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                $(nRow).click(function() {
                    document.location.href = url + "/cms/testimonial/profile/" + aData['uuid'] ;
                }).hover(function() {
                    $(this).css('cursor','pointer');
                }, function() {
                    $(this).css('cursor','auto');
                });
            }
        });
    </script>

@endpush
