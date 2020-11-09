

<aside class="doc_left_sidebarlist">
    <h3 class="nav_title">{{trans('label.user_manual')}}</h3>
    <div class="scroll">
        <ul class="list-unstyled nav-sidebar doc-nav">
            <li class="nav-item active">
                <a href="{{route('general_information.user_manual')}}" class="nav-link">Getting Started</a>
            </li>
            @foreach($modules as $module)
            <li class="nav-item">
                <a href="#module{{$module->id}}" class="nav-link" id="module" data-valuee="{{$module->id}}">{{$module->name}}</a>
                <ul class="list-unstyled dropdown_nav">
                    @foreach($module->moduleFunctionalParts as $functional_part)
                    <li class="nav-item"><a href="#module_functional{{$functional_part->id}}" class="nav-link" id="module_functional" data-valuee="{{$functional_part->id}}">{{$functional_part->title}}</a></li>
                     @endforeach
                </ul>
                <span class="icon">
                    <i class="icon_plus"></i>
                    <i class="icon_minus-06"></i>
                </span>
            </li>
            @endforeach
        </ul>
    </div>
</aside>

@push('after-scripts')
<script>
    $(function () {

        // get module functional part
        $(document).on('click','#module_functional',function (e) {
            e.preventDefault();
            var id = $(this).data('valuee');
            var data = {
                'functional_part_id' :id
            };
            var url = '{{route('cms.user_manual.module_functional_part.get_functional_part_row_by_ajax')}}';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                type: "get",
                dataType: 'HTML',
                data: data,
                success: function (response) {
                    if (response){
                        $('#post').empty();
                        $('#post').append(response);
                    }
                }
            }).done(
            )
        });

        // get module
        $(document).on('click','#module',function (e) {
            e.preventDefault();
            var id = $(this).data('valuee');
            var data = {
                'module_id' :id
            };
            var url = '{{route('cms.user_manual.get_module_row_by_ajax')}}';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                type: "get",
                dataType: 'HTML',
                data: data,
                success: function (response) {
                    if (response){
                        $('#post').empty();
                        $('#post').append(response);
                    }
                }
            }).done(
            )
        })
    })
</script>


@endpush
