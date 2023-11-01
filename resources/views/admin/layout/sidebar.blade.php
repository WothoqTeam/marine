<!--begin::Sidebar-->
<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Wrapper-->
    <div id="kt_app_sidebar_wrapper" class="app-sidebar-wrapper hover-scroll-y my-5 my-lg-2" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_header" data-kt-scroll-wrappers="#kt_app_sidebar_wrapper" data-kt-scroll-offset="5px">
        <!--begin::Sidebar menu-->
        <div id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false" class="app-sidebar-menu-primary menu menu-column menu-rounded menu-sub-indention menu-state-bullet-primary px-6 mb-5">

            <div class="menu-item">
                <a class="menu-link @if(Request::is('admin')) active @endif " href="{{url('/admin')}}">
                    <span class="menu-icon">
                        <i class="fonticon-setting fs-2"></i>
                    </span>
                    <span class="menu-title">{{transAdmin('Dashboard')}}</span>
                </a>
            </div>

            @if(can_manager('employees.index'))
                <div class="menu-item">
                    <a class="menu-link @if(Request::is('admin/employees*')) active @endif " href="{{route('admin.employees.index')}}">
                    <span class="menu-icon">
                        <i class="fonticon-setting fs-2"></i>
                    </span>
                        <span class="menu-title">{{transAdmin('Employees')}}</span>
                    </a>
                </div>
            @endif

            @if(can_manager('providers.index'))
                <div class="menu-item">
                    <a class="menu-link @if(Request::is('admin/providers*')) active @endif " href="{{route('admin.providers.index')}}">
                    <span class="menu-icon">
                        <i class="fonticon-setting fs-2"></i>
                    </span>
                        <span class="menu-title">{{transAdmin('Providers')}}</span>
                    </a>
                </div>
            @endif

            @if(can_manager('users.index'))
                <div class="menu-item">
                    <a class="menu-link @if(Request::is('admin/users*')) active @endif " href="{{route('admin.users.index')}}">
                    <span class="menu-icon">
                        <i class="fonticon-setting fs-2"></i>
                    </span>
                        <span class="menu-title">{{transAdmin('Users')}}</span>
                    </a>
                </div>
            @endif

            @if(can_manager('banners.index'))
                <div class="menu-item">
                    <a class="menu-link @if(Request::is('admin/banners*')) active @endif " href="{{route('admin.banners.index')}}">
                    <span class="menu-icon">
                        <i class="fonticon-setting fs-2"></i>
                    </span>
                        <span class="menu-title">{{transAdmin('Banners')}}</span>
                    </a>
                </div>
            @endif

            {{--settings--}}
            @if(can_manager('settings.update') || can_manager('countries.index') || can_manager('cities.index') || can_manager('faq.index') || can_manager('pages.index'))
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion @if(Request::is('admin/settings*', 'admin/countries*', 'admin/cities*', 'admin/faqs*', 'admin/pages*')) show menu-accordion @endif">
                <span class="menu-link">
                    <span class="menu-icon">
                        <i class="fonticon-setting fs-2"></i>
                    </span>
                    <span class="menu-title">{{transAdmin('Settings')}}</span>
                    <span class="menu-arrow"></span>
                </span>

                    <div class="menu-sub menu-sub-accordion">
                        @if(can_manager('settings.update'))
                            <div class="menu-item">
                                <a class="menu-link @if(Request::is('admin/settings*')) active @endif" href="{{route('admin.settings.edit', 1)}}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                                    <span class="menu-title">{{transAdmin('Settings')}}</span>
                                </a>
                            </div>
                        @endif
                        @if(can_manager('countries.index'))
                            <div class="menu-item">
                                <a class="menu-link @if(Request::is('admin/countries*')) active @endif" href="{{route('admin.countries.index')}}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                                    <span class="menu-title">{{transAdmin('Countries')}}</span>
                                </a>
                            </div>
                        @endif
                        @if(can_manager('cities.index'))
                            <div class="menu-item">
                                <a class="menu-link @if(Request::is('admin/cities*')) active @endif" href="{{route('admin.cities.index')}}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                                    <span class="menu-title">{{transAdmin('Cities')}}</span>
                                </a>
                            </div>
                        @endif
                        @if(can_manager('faq.index'))
                            <div class="menu-item">
                                <a class="menu-link @if(Request::is('admin/faqs*')) active @endif" href="{{route('admin.faqs.index')}}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                                    <span class="menu-title">{{transAdmin('Faqs')}}</span>
                                </a>
                            </div>
                        @endif
                        @if(can_manager('pages.index'))
                            <div class="menu-item">
                                <a class="menu-link @if(Request::is('admin/pages*')) active @endif" href="{{route('admin.pages.index')}}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                                    <span class="menu-title">{{transAdmin('Pages')}}</span>
                                </a>
                            </div>
                        @endif
                    </div>

                </div>
            @endif

            @if(can_manager('specifications.index'))
                <div class="menu-item">
                    <a class="menu-link @if(Request::is('admin/specifications*')) active @endif " href="{{route('admin.specifications.index')}}">
                    <span class="menu-icon">
                        <i class="fonticon-setting fs-2"></i>
                    </span>
                        <span class="menu-title">{{transAdmin('Specifications')}}</span>
                    </a>
                </div>
            @endif

            @if(can_manager('yachts.index'))
            <div class="menu-item">
                <a class="menu-link @if(Request::is('admin/yachts*')) active @endif " href="{{route('admin.yachts.index')}}">
                    <span class="menu-icon">
                        <i class="fonticon-setting fs-2"></i>
                    </span>
                    <span class="menu-title">{{transAdmin('Yachts')}}</span>
                </a>
            </div>
            @endif

            @if(can_manager('reservations.index'))
                <div class="menu-item">
                    <a class="menu-link @if(Request::is('admin/reservations*')) active @endif " href="{{route('admin.reservations.index')}}">
                    <span class="menu-icon">
                        <i class="fonticon-setting fs-2"></i>
                    </span>
                        <span class="menu-title">{{transAdmin('Yachts Reservations')}}</span>
                    </a>
                </div>
            @endif

            @if(can_manager('marasi owners.index'))
            <div class="menu-item">
                <a class="menu-link @if(Request::is('admin/owners*')) active @endif " href="{{route('admin.owners.index')}}">
                    <span class="menu-icon">
                        <i class="fonticon-setting fs-2"></i>
                    </span>
                    <span class="menu-title">{{transAdmin('Marasi Owners')}}</span>
                </a>
            </div>
            @endif

            @if(can_manager('marasi.index'))
            <div class="menu-item">
                <a class="menu-link @if(Request::is('admin/marasi*')) active @endif "  href="{{route('admin.marasi.index')}}">
                    <span class="menu-icon">
                        <i class="fonticon-setting fs-2"></i>
                    </span>
                    <span class="menu-title">{{transAdmin('Marasi')}}</span>
                </a>
            </div>
            @endif

            @if(can_manager('marasi reservations.index'))
                <div class="menu-item">
                    <a class="menu-link @if(Request::is('admin/mReservations*')) active @endif " href="{{route('admin.mReservations.index')}}">
                    <span class="menu-icon">
                        <i class="fonticon-setting fs-2"></i>
                    </span>
                        <span class="menu-title">{{transAdmin('Marasi Reservations')}}</span>
                    </a>
                </div>
            @endif
        </div>

    </div>
    <!--end::Wrapper-->
</div>
<!--end::Sidebar-->
