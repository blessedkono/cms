
<div class="">
    <form action="#" class="banner_search_form" style="margin: 0;max-width: 100%">
        <div class="input-group" style="z-index: 9999;border-bottom: solid 1px;margin-left: 0px">
            <input type="search" class="form-control" placeholder="Search for" id="search_input" onkeyup="customFilter()" style="height: 0%">

            <a type="submit"><i class="icon_search"></i></a>
        </div>
    </form>

</div>
<ul id="search_ul" style="">
    {{--                            <li><a href="">test ul</a> </li>--}}
</ul>
<div class="" id="post">
    <!--doc-->
    <article class="documentation_body doc-section pt-0" id="doc">
        <div class="shortcode_title">
            <h2>Documentation</h2>
            <p><span>Welcome to PSMS !</span> Get familiar with the System and explore their features:</p>
        </div>
        <div class="row">
            @foreach($modules as $module)

            <div class="col-lg-4 col-sm-6">
                <div class="media documentation_item">
                    <div class="icon">
                        <img src="img/home_one/icon/folder.png" alt="">
                    </div>
                    <div class="media-body">
                        <a href="#module{{$module->id}}" id="module" data-valuee="{{$module->id}}">
                            <h5>{{$module->name}}</h5>
                        </a>
                        <p>{{truncateString($module->description,100)}}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="border_bottom " ></div>
    </article>
    <!--shortcode-->
{{--    @foreach($modules as $module)--}}
{{--    <article class="documentation_body shortcode_text doc-section" id="module{{$module->id}}">--}}
{{--        <div class="shortcode_title">--}}
{{--            <h2>{{$module->name}}</h2>--}}
{{--            <p><span>Welcome to Docly !</span> Get familiar with the Stripe products and explore their features:</p>--}}
{{--        </div>--}}
{{--        <p>{{$module->description}}</p>--}}
{{--        <div class="border_bottom"></div>--}}

{{--        @foreach($module->moduleFunctionalParts as $functional_part)--}}

{{--        <div class="shortcode_info" id="module_functional{{$functional_part->id}}">--}}
{{--            <h4>{{$functional_part->title}}</h4>--}}
{{--            <div class="code-toolbar">--}}
{{--                <pre class="snippet language-html">--}}
{{--                    <code class=" language-html" data-lang="html">--}}
{{--                        {{$functional_part->navigation_link}}--}}
{{--                    </code>--}}
{{--                </pre>--}}
{{--                <div class="toolbar">--}}
{{--                    <div class="toolbar-item">--}}
{{--                        <button>Copy</button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <p>{{$functional_part->description}}</p>--}}
{{--            <div class="border_bottom"></div>--}}
{{--        </div>--}}
{{--        @endforeach--}}

{{--    </article>--}}
{{--            @endforeach--}}


</div>
