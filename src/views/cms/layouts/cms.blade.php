<!DOCTYPE html>
                <html>
                {{--<html class="fixed">--}}
                <head>
                    {{--<!-- Basic -->--}}
                    <meta charset="UTF-8">
                    <title>{{ config("app.name") . " - " . $title }}</title>
                    <meta name="keywords" content="{{ config("env.app.keywords") }}" />
                    <meta name="description" content="{{ config("env.app.description") }}">
                    <meta name="author" content="{{ config("env.app.vendor") }}">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    {{ Html::style(url("img/psms_fav.png"), ['rel' => 'stylesheet icon', 'type' => 'image/x-icon']) }}

                    @stack('before-styles')

                    {{ Html::style(url("cms/css/fonts.googleapis.css"), ['rel' => 'stylesheet', 'type' => 'text/css']) }}

                    {{ Html::style(url('assets/cms/vendor/bootstrap/css/bootstrap.min.css')) }}
                    {{ Html::style(url('cms/vendor/animate/animate.css')) }}
                    {{ Html::style(url('cms/vendor/font-awesome/css/fontawesome-all.min.css')) }}
                    {{ Html::style(url('cms/vendor/magnific-popup/magnific-popup.css')) }}
                    {{ Html::style(url('cms/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')) }}
                    {{ Html::style(url("assets/nextbyte/plugins/jquery-ui/css/jquery-ui.min.css"), ['rel' => 'stylesheet']) }}
                    @stack('after-styles')
                    {{ Html::style(url('cms/css/theme.css')) }}
                    {{ Html::style(url('cms/css/theme-elements.css')) }}
                    {{ Html::style(url('cms/css/skins/default.css')) }}
                    {{ Html::style(url('cms/css/custom.css')) }}
                    {{ Html::style(url('cms/vendor/select2/css/select2.min.css')) }}
                    {{ Html::style(url("cms/vendor/pnotify/pnotify.custom.css")) }}
                    {{ Html::script(url('cms/vendor/modernizr/modernizr.js')) }}
                    {{ Html::script(url('cms/vendor/chartjs/Chart.min.js')) }}

                    @stack('custom')


                </head>
                <body>
                <section class="body" >

                    @include("cms::includes.components.header")

                    <div class="inner-wrapper">
                         @include('cms::includes.components.sidebar')
                        <section role="main" class="content-body">



                            @yield('content')

                        </section>


                    </div>


                </section>


                <script>
                    var base_url = "{{ url("/") }}";
                </script>
                {{--<!-- Scripts -->--}}
                @stack('before-scripts')
                {{ Html::script(url('cms/vendor/jquery/jquery.js')) }}
                {{ Html::script(url('assets/nextbyte/plugins/jquery-ui/js/jquery-ui.min.js')) }}
                {{ Html::script(url('cms/vendor/jquery-browser-mobile/jquery.browser.mobile.js')) }}
                {{ Html::script(url('cms/vendor/popper/umd/popper.min.js')) }}
                {{ Html::script(url('cms/vendor/bootstrap/js/bootstrap.min.js')) }}
                {{ Html::script(url('cms/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js')) }}
                {{ Html::script(url('cms/vendor/common/common.js')) }}
                {{ Html::script(url('cms/vendor/nanoscroller/nanoscroller.js')) }}
                {{ Html::script(url('cms/vendor/magnific-popup/jquery.magnific-popup.min.js')) }}
                {{ Html::script(url('cms/vendor/jquery-placeholder/jquery-placeholder.js')) }}
                @stack('after-scripts')
                {{ Html::script(url('cms/js/theme.js')) }}
                {{ Html::script(url('cms/js/custom.js')) }}
                {{ Html::script(url('cms/js/theme.init.js')) }}
                {{ Html::script(url('cms/vendor/select2/js/select2.min.js')) }}
                {{ Html::script(url('cms/vendor/jquery-maskedinput/jquery.maskedinput.js')) }}
                {{ Html::script(url('assets/nextbyte/js/custom.js')) }}
                {{ Html::script(url("cms/vendor/pnotify/pnotify.custom.js")) }}

                <script>
                    $(document).ready(function () {

                        $('.mobile').mask("9999999999");

                    })
                </script>

                </body>
                </html>
