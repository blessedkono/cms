<aside id="sidebar-left" class="sidebar-left">

    <div class="sidebar-header">
        <div class="sidebar-title">
            Navigation
        </div>
        <div class="sidebar-toggle d-none d-md-block" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
            <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>

    <div class="nano has-scrollbar">
        <div class="nano-content" tabindex="0" style="right: -15px;">
            <nav id="menu" class="nav-main" role="navigation">

                <ul class="nav nav-main">
                    <li>
                        <a class="nav-link" href="{{route('cms.dashboard.index')}}">
                            <i class="fas fa-home" aria-hidden="true"></i>
                            <span>{{trans('label.dashboard')}}</span>
                        </a>
                    </li>

                    <li class="nav-parent">
                        <a class="nav-link" href="#">
                            <i class="fas fa-copy" aria-hidden="true"></i>
                            <span>{{trans('label.blog.post')}}</span>
                        </a>
                        <ul class="nav nav-children">
                            <li>
                                <a class="nav-link" href="{{route('cms.blog.create')}}">
                                    {{trans('label.blog.new_post')}}
                                </a>
                            </li>
                            <li>
                                <a class="nav-link" href="{{route('cms.blog.index')}}">
                                    {{trans('label.blog.posts')}}
                                </a>
                            </li>
                            <li>
                                <a class="nav-link" href="{{route('cms.category.index')}}">
                                   {{trans('label.blog.categories')}}
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li>
                        <a class="nav-link" href="{{route('cms.faq.index')}}">
                            <i class="fas fa-question" aria-hidden="true"></i>
                            <span>{{trans('label.faqs')}}</span>
                        </a>
                    </li>

                    <li>
                        <a class="nav-link" href="{{route('cms.client.index')}}">
                            <i class="fas fa-people-carry" aria-hidden="true"></i>
                            <span>{{trans('label.cms.client.client')}}</span>
                        </a>
                    </li>

                    <li>
                        <a class="nav-link" href="{{route('cms.testimonial.index')}}">
                            <i class="fas fa-newspaper" aria-hidden="true"></i>
                            <span>{{trans('label.cms.testimonial.client_testimonial')}}</span>
                        </a>
                    </li>

                    <li>
                        <a class="nav-link" href="{!! route('admin.user_manage.index') !!}">
                            <i class="fas fa-users" aria-hidden="true"></i>
                            <span>{!! __('label.administrator.users.manage_users') !!}  <br/>
                                </span>
                        </a>
                    </li>

                    <li>
                        <a class="nav-link" href="{!! route('admin.system_menu') !!}">
                            <i class="fas fa-cog" aria-hidden="true"></i>
                            <span>{!! __('label.system') !!}  <br/>
                                </span>
                        </a>
                    </li>

                    <li>
                        <a class="nav-link" href="{!! route('cms.user_manual.module_groups') !!}">
                            <i class="fas fa-align-center" aria-hidden="true"></i>
                            <span>{!! __('label.user_manual') !!}  <br/>
                                </span>
                        </a>
                    </li>

                </ul>
            </nav>
        </div>
    </div>

    <script>
            // Maintain Scroll Position
            if (typeof localStorage !== 'undefined') {
                if (localStorage.getItem('sidebar-left-position') !== null) {
                    var initialPosition = localStorage.getItem('sidebar-left-position'),
                        sidebarLeft = document.querySelector('#sidebar-left .nano-content');

                    sidebarLeft.scrollTop = initialPosition;
                }
            }
        </script>
        <div class="nano-pane" style="opacity: 1; visibility: visible;"><div class="nano-slider" style="height: 142px; transform: translate(0px, 0px);"></div></div>

</aside>
