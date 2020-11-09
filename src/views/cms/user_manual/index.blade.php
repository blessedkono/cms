<!doctype html>
<html lang="en">


<!-- Mirrored from html.creativegigs.net/docly/docly-html/Onepage.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 21 Oct 2020 13:54:15 GMT -->
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="X-Frame-Options" value="sameorigin">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('cms/assets/user_manual/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('cms/assets/user_manual/bootstrap/css/bootstrap-select.min.css')}}">
    <!-- icon css-->
    <link rel="stylesheet" href="{{asset('cms/assets/user_manual/elagent-icon/style.css')}}">
    <link rel="stylesheet" href="{{asset('cms/assets/user_manual/font-awesome/css/all.css')}}">
    <link rel="stylesheet" href="{{asset('cms/assets/user_manual/niceselectpicker/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('cms/assets/user_manual/font-size/css/rvfs.css')}}">
    <link rel="stylesheet" href="{{asset('cms/assets/user_manual/animation/animate.css')}}">
    <link rel="stylesheet" href="{{asset('cms/assets/user_manual/video/video-js.css')}}">
    <link rel="stylesheet" href="{{asset('cms/assets/user_manual/tooltipster/css/tooltipster.bundle.css')}}">
    <link rel="stylesheet" href="{{asset('cms/assets/user_manual/prism/prism.css')}}">
    <link rel="stylesheet" href="{{asset('cms/assets/user_manual/prism/prism-coy.css')}}">
    <link rel="stylesheet" href="{{asset('cms/assets/user_manual/magnify-pop/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('cms/assets/user_manual/mcustomscrollbar/jquery.mCustomScrollbar.min.css')}}">
    <link rel="stylesheet" href="{{asset('cms/assets/user_manual/style.css')}}">
    <link rel="stylesheet" href="{{asset('cms/assets/user_manual/custom.css')}}">
    <link rel="stylesheet" href="{{asset('cms/assets/user_manual/responsive.css')}}">
    {{ Html::style(url('assets/img/fav1.png'), ['rel' => 'stylesheet icon', 'type' => 'image/x-icon']) }}

    @stack('after-styles')

    <style>


    </style>
    <title>{{trans('label.user_manual')}}</title>
</head>

<body class="doc full-width-doc sticky-nav-doc onepage-doc" data-spy="scroll" data-target=".navbar" data-offset="-120">
{{--<div id="preloader">--}}
{{--    <div id="ctn-preloader" class="ctn-preloader">--}}
{{--        <div class="round_spinner">--}}
{{--            <div class="spinner"></div>--}}
{{--            <div class="text">--}}
{{--                <img src="img/spinner_logo.png" alt="">--}}
{{--                <h4><span>Doc</span>ly</h4>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <h2 class="head">Did You Know?</h2>--}}
{{--        <p></p>--}}
{{--    </div>--}}
{{--</div>--}}

<div class="body_wrapper sticky_menu">

    @include('cms.user_manual.includes.components.nav')

    <section class="doc_documentation_area onepage_doc_area" id="sticky_doc">
        <div class="overlay_bg"></div>
        <div class="container-fluid pl-60 pr-60">
            <div class="row doc-container">
                <div class="col-lg-2 doc_mobile_menu doc-sidebar display_none">
                    @include('cms.user_manual.includes.components.aside')
                </div>
                <div class="col-lg-8 col-md-8">
               @include('cms.user_manual.includes.components.main_section')
                </div>
                <div class="col-lg-2 col-md-4 doc_right_mobile_menu">
                  @include('cms.user_manual.includes.components.right_sidebar')
                </div>
            </div>
        </div>
    </section>

    @include('cms.user_manual.includes.components.footer')
</div>

<!-- Tooltip content -->
<div class="tooltip_templates d-none">
    <div id="tooltipOne" class="tip_content">
        <div class="text">
            <p>Me old mucker bamboozled horse play fantastic skive off baking cakes knees up lurgy spiffing, Harry bog wind up say are you taking the piss porkies hunky-dory, blower pardon you you mug pear shaped pukka get stuffed mate lavatory.</p>
            <h6>Related Reading:<span>Child Theming for Layers</span></h6>
        </div>
    </div>
</div>
<div class="tooltip_templates d-none">
    <div id="tooltipTwo" class="tip_content">
        <img src="img/blog-grid/blog_grid_post1.jpg" alt="">
        <div class="text">
            <p>Me old mucker bamboozled horse play fantastic skive off baking cakes knees up lurgy spiffing, Harry bog wind up say are you taking the piss porkies hunky-dory,</p>
            <h6>Related Reading:<span>Child Theming for Layers</span></h6>
        </div>
    </div>
</div>
<div class="tooltip_templates d-none">
    <div id="note-link-a" class="tip_content">
        <div class="text footnotes_item">
            <strong>Footnote Name A</strong>
            <br>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Amet voluptas dicta dolor.
        </div>
    </div>
</div>
<div class="tooltip_templates d-none">
    <div id="note-link-b" class="tip_content">
        <div class="text footnotes_item">
            <strong>Footnote Name B</strong> <a href="#0">[PDF]</a>
            <br>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Amet voluptas dicta dolor.
        </div>
    </div>
</div>
<div class="tooltip_templates d-none">
    <div id="note-link-c" class="tip_content">
        <div class="text footnotes_item">
            <strong>Footnote Name C</strong>
            <br>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Amet voluptas dicta dolor.
        </div>
    </div>
</div>
<video id="vid2" class="video-js vjs-default-skin mfp-hide" preload="auto">
    <p>Video Playback Not Supported</p>
</video>

<!-- Back to top button -->
<a id="back-to-top" title="Back to Top"></a>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="{{asset('cms/assets/user_manual/js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('cms/assets/user_manual/js/pre-loader.js')}}"> </script>
<script src="{{asset('cms/assets/user_manual/bootstrap/js/popper.min.js')}}"></script>
<script src="{{asset('cms/assets/user_manual/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('cms/assets/user_manual/bootstrap/js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('cms/assets/user_manual/parallaxie.js')}}"></script>
<script src="{{asset('cms/assets/user_manual/TweenMax.min.js')}}"></script>
<script src="{{asset('cms/assets/user_manual/anchor.js')}}"></script>
<script src="{{asset('cms/assets/user_manual/wow/wow.min.js')}}"></script>
<script src="{{asset('cms/assets/user_manual/prism/prism.js')}}"></script>
<script src="{{asset('cms/assets/user_manual/niceselectpicker/jquery.nice-select.min.js')}}"></script>
<script src="{{asset('cms/assets/user_manual/mcustomscrollbar/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<script src="{{asset('cms/assets/user_manual/magnify-pop/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('cms/assets/user_manual/tooltipster/js/tooltipster.bundle.min.js')}}"></script>
<script src="{{asset('cms/assets/user_manual/font-size/js/rv-jquery-fontsize-2.0.3.js')}}"></script>
<script src="{{asset('cms/assets/user_manual/video/video.min.js')}}"></script>
<script src="{{asset('cms/assets/user_manual/video/wistia.js')}}"></script>
<script src="{{asset('cms/assets/user_manual/onpage-menu.js')}}"></script>
<script src="{{asset('cms/assets/user_manual/main.js')}}"></script>
@stack('after-scripts')
</body>

<!-- Mirrored from html.creativegigs.net/docly/docly-html/Onepage.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 21 Oct 2020 13:56:38 GMT -->
</html>
