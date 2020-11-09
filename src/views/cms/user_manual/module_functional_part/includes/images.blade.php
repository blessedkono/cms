
@if($module_functional_part->documents()->count() > 0)
        <div class="row mg-files" data-sort-destination="" data-sort-id="media-gallery" style="position: relative;">
            @foreach($module_functional_part->documents as $imag)
            <div class="isotope-item document col-sm-6 col-md-4 col-lg-3" style=" left: 0px; top: 5px;height: 30%">
                <div class="thumbnail">
                    <div class="thumb-preview">
                        <a class="thumb-image" href="{{documentUrl($imag->pivot->id)}}">
                            <img src="{{documentUrl($imag->pivot->id)}}" class="img-fluid" alt="Project" style="height: 200px;width: 100%">
                        </a>
{{--                        <div class="mg-thumb-options" style="">--}}
{{--                            <div class="mg-toolbar">--}}
{{--                                <div class="mg-group float-right">--}}
{{--                                    <button class="dropdown-toggle mg-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button>--}}
{{--                                    <div class="dropdown-menu mg-dropdown" role="menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(284px, 4px, 0px);">--}}
{{--                                        <a class="dropdown-item text-1" href="#"><i class="fas fa-download"></i> Download</a>--}}
{{--                                        <a class="dropdown-item text-1" href="#"><i class="far fa-trash-alt"></i> Delete</a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>
            @endforeach

        </div>
{{--        <div class="col-md-4">--}}
{{--            <img src="{{documentUrl($imag->pivot->id)}}" height="200" style="width: 100%;">--}}
{{--            <a href="{!! route('system.document_resource.delete',$imag->pivot->id) !!}" style="text-decoration: none"><i class="far fa-times-circle" style="color: red">@lang('label.remove')</i></a>--}}
{{--        </div>--}}

@endif

@push('after-scripts')
    {!! Html::script(url('cms/vendor/isotope/isotope.js')) !!}

<script>

</script>
@endpush
