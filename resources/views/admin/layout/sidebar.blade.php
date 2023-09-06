<!--begin::Sidebar-->
<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Wrapper-->
    <div id="kt_app_sidebar_wrapper" class="app-sidebar-wrapper hover-scroll-y my-5 my-lg-2" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_header" data-kt-scroll-wrappers="#kt_app_sidebar_wrapper" data-kt-scroll-offset="5px">
        <!--begin::Sidebar menu-->
        <div id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false" class="app-sidebar-menu-primary menu menu-column menu-rounded menu-sub-indention menu-state-bullet-primary px-6 mb-5">

            <div class="menu-item">
                <a class="menu-link" href="{{url('/admin')}}">
                    <span class="menu-icon">
                        <i class="fonticon-setting fs-2"></i>
                    </span>
                    <span class="menu-title">لوحة التحكم</span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link" href="javascript:void()">
                    <span class="menu-icon">
                        <i class="fonticon-setting fs-2"></i>
                    </span>
                    <span class="menu-title">الحجوزات</span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link" href="javascript:void()">
                    <span class="menu-icon">
                        <i class="fonticon-setting fs-2"></i>
                    </span>
                    <span class="menu-title">اليخوت</span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link" href="javascript:void()">
                    <span class="menu-icon">
                        <i class="fonticon-setting fs-2"></i>
                    </span>
                    <span class="menu-title">مقدمي الخدمة</span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link" href="javascript:void()">
                    <span class="menu-icon">
                        <i class="fonticon-setting fs-2"></i>
                    </span>
                    <span class="menu-title">الاعلانات</span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link" href="javascript:void()">
                    <span class="menu-icon">
                        <i class="fonticon-setting fs-2"></i>
                    </span>
                    <span class="menu-title">المراسي</span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link" href="javascript:void()">
                    <span class="menu-icon">
                        <i class="fonticon-setting fs-2"></i>
                    </span>
                    <span class="menu-title">المدن والاحياء</span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link" href="javascript:void()">
                    <span class="menu-icon">
                        <i class="fonticon-setting fs-2"></i>
                    </span>
                    <span class="menu-title">الدعم</span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link" href="javascript:void()">
                    <span class="menu-icon">
                        <i class="fonticon-setting fs-2"></i>
                    </span>
                    <span class="menu-title">الصفحات</span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link" href="{{route('admin.users.index')}}">
                    <span class="menu-icon">
                        <i class="fonticon-setting fs-2"></i>
                    </span>
                    <span class="menu-title">العملاء</span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link" href="{{route('admin.employees.index')}}">
                    <span class="menu-icon">
                        <i class="fonticon-setting fs-2"></i>
                    </span>
                    <span class="menu-title">المديرين</span>
                </a>
            </div>

            <div class="menu-item">
                <a class="menu-link" href="{{route('admin.settings.edit', 1)}}">
                    <span class="menu-icon">
                        <i class="fonticon-setting fs-2"></i>
                    </span>
                    <span class="menu-title">الاعدادات العامة</span>
                </a>
            </div>

        </div>

    </div>
    <!--end::Wrapper-->
</div>
<!--end::Sidebar-->
