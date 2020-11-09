@push('after-styles')
<style>


</style>
@endpush
<nav class="navbar navbar-expand-lg menu_one" id="stickyTwo">
    <div class="container-fluid pl-60 pr-60">
        <a class="navbar-brand" href="{{route('home')}}">
            <img src="{{ url("assets/img/psms_logo.png") }}" srcset="img/logo-2x.png 2x" alt="logo" width="100" height="46" alt="PSMS" style="margin-top: -3px; margin-left:-12px;">
            <img src="{{ url("assets/img/psms_logo.png") }}" srcset="img/logo-w2x.png 2x" alt="logo" width="100" height="46" alt="PSMS" style="margin-top: -3px; margin-left:-12px;">
        </a>
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="menu_toggle">
                        <span class="hamburger">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                        <span class="hamburger-cross">
                            <span></span>
                            <span></span>
                        </span>
                    </span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="list-unstyled menu_social" >
                <li class="search pull-right">
{{--                    <span class="badge badge-dark">--}}
{{--                        {{trans('label.user_manual')}}--}}
{{--                    </span>--}}

{{--                    <form action="#" method="get" class="search_form">--}}
{{--                        <input type="search" class="form-control" placeholder="Search for" id="search_input" onkeyup="customFilter()">--}}

{{--                        <button type="submit"><i class="icon_search"></i></button>--}}
{{--                    </form>--}}
                </li>
            </ul>
        </div>
    </div>
</nav>


@push('after-scripts')
    <script>

        function customFilter() {
            var text = document.getElementById("search_input").value;
            if (text.length != 0)
            {
                var data = {
                    'search_content' :text
                };
                var url = '{{route('cms.user_manual.module_functional_part.get_search_functional_part_by_ajax')}}';
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: url,
                    type: "get",
                    dataType: 'json',
                    data: data,
                    success: function (response) {
                        if (response){
                            $('#search_ul').empty();
                            $.each(response, function (key, value) {
                                $('#search_ul').css('display','block');
                                $('#search_ul').append($('<li id="'+ value.journal_id +'">'
                                    + '<a  class="nav-link" id="module_functional" data-valuee="'+ value.id +'">'+ value.title +'</a>'
                                    + '</li>'));
                            });
                        }
                    }
                }).done(
                )
            }else
            {
                $('#search_ul').empty();

            }

        }


        $(function (e) {
           $(document).on('click','#module_functional',function () {
                document.getElementById("search_ul").style.display = "none";

                // $('#search_ul').css('display','none')
            });

        })

    </script>

@endpush
