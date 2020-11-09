{{--@foreach($module->moduleFunctionalParts as $functional_part)--}}

    <div class="shortcode_info" id="module_functional{{$functional_part->id}}">
        <h4>{{$functional_part->title}}</h4>
        {{--  blog photos slider--}}
        <div class="image_pointer">
            <div class="row">
                @foreach($functional_part->documents()->where('document_id',3)->get() as $imag)
                    <div class="col-lg-4 col-sm-6">
                        <div class="pointing_img">
                            <a href="#" data-toggle="modal" data-target="#exampleModal{{$imag->pivot->id}}">
                                <img src="{{documentUrl($imag->pivot->id)}}" class="rounded float-left img-fluid" alt="..." style="width: 100%;height: 300px">
                            </a>
                        </div>
                    </div>


                    <!-- Image Hotspots modal popup 02 -->
                    <div class="modal fade img_modal" id="exampleModal{{$imag->pivot->id}}" tabindex="-2" role="dialog" aria-hidden="false">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class=" icon_close"></i>
                        </button>
                        <div class="modal-dialog pointing_img_container" role="document">
                            <div class="modal-content">
                                <img src="{{documentUrl($imag->pivot->id)}}" class="rounded float-left img-fluid" alt="..." style="width: 100%;height: 700px">

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="code-toolbar">
                <pre class="snippet language-html">
                    <code class=" language-html" data-lang="html">
                        {{$functional_part->navigation_link}}
                    </code>
                </pre>
            <div class="toolbar">
                <div class="toolbar-item">
                    <button>Copy</button>
                </div>
            </div>
        </div>


        <p>{!! $functional_part->description !!}</p>
        <div class="border_bottom"></div>
    </div>
{{--@endforeach--}}
