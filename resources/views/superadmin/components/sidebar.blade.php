<!--begin::Sidebar-->
<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px"
    data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <div class="app-sidebar-logo flex-shrink-0 d-none d-md-flex align-items-center justify-content-center px-8" id="kt_app_sidebar_logo">
        <!--begin::Logo-->
        <a href="{{ route('superadmin.dashboard') }}">
            <img alt="Ticketify" src="assets/media/logos/ticketify.jpg" class="h-70px" style="border-radius: 10px;" />
        </a>
        <!--end::Logo-->
        <!--begin::Aside toggle-->
        <div class="d-flex align-items-center d-lg-none ms-n3 me-1" title="Show aside menu">
            <div class="btn btn-icon btn-active-color-primary w-30px h-30px" id="kt_aside_mobile_toggle">
                <i class="ki-outline ki-abstract-14 fs-1"></i>
            </div>
        </div>
        <!--end::Aside toggle-->
    </div>
    <!--begin::sidebar menu-->
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <!--begin::Menu wrapper-->
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5 mx-3"
            data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto"
            data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
            data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px">
            <!--begin::Menu-->
            <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold px-1" id="#kt_app_sidebar_menu"
                data-kt-menu="true" data-kt-menu-expand="false">
                <!--begin:Menu item-->
                <div class="menu-item">
                    <div class="menu-content">
                        <span class="menu-heading fw-bold text-uppercase fs-7">Pages</span>
                    </div>
                </div>
                <!--end:Menu item-->

                <!--begin:Menu item-->
                <div class="menu-item {{ request()->routeIs('superadmin.dashboard') ? 'here show' : '' }}">
                    <a href="{{ route('superadmin.dashboard') }}"
                        class="menu-link {{ request()->routeIs('superadmin.dashboard') ? 'active' : '' }}">
                        <span class="menu-icon">
                            <i class="ki-outline ki-home-2 fs-2"></i>
                        </span>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </div>
                <!--end:Menu item-->

                <!--begin:Menu item-->
                <div class="menu-item {{ request()->routeIs('superadmin.ticket*') ? 'here show' : '' }}">
                    <a href="{{ route('superadmin.ticket') }}"
                        class="menu-link {{ request()->routeIs('superadmin.ticket*') ? 'active' : '' }}">
                        <span class="menu-icon">
                            <i class="ki-outline ki-tag fs-2"></i>
                        </span>
                        <span class="menu-title">Tickets</span>
                    </a>
                </div>
                <!--end:Menu item-->

                <!--begin:Menu item-->
                <div class="menu-item {{ request()->routeIs('superadmin.discount*') ? 'here show' : '' }}">
                    <a href="{{ route('superadmin.discount') }}"
                        class="menu-link {{ request()->routeIs('superadmin.discount*') ? 'active' : '' }}">
                        <span class="menu-icon">
                            <i class="ki-outline ki-percentage fs-2"></i>
                        </span>
                        <span class="menu-title">Discounts</span>
                    </a>
                </div>
                <!--end:Menu item-->

                <!--begin:Menu item-->
                <div class="menu-item {{ request()->routeIs('superadmin.order*') ? 'here show' : '' }}">
                    <a href="{{ route('superadmin.order') }}"
                        class="menu-link {{ request()->routeIs('superadmin.order*') ? 'active' : '' }}">
                        <span class="menu-icon">
                            <i class="ki-outline ki-basket fs-2"></i>
                        </span>
                        <span class="menu-title">Orders</span>
                    </a>
                </div>
                <!--end:Menu item-->

                <!--begin:Menu item-->
                <div class="menu-item {{ request()->routeIs('superadmin.notification-log*') ? 'here show' : '' }}">
                    <a href="{{ route('superadmin.notification-log') }}"
                        class="menu-link {{ request()->routeIs('superadmin.notification-log*') ? 'active' : '' }}">
                        <span class="menu-icon">
                            <i class="ki-outline ki-notification-status fs-2"></i>
                        </span>
                        <span class="menu-title">Notification Logs</span>
                    </a>
                </div>
                <!--end:Menu item-->

                <!--begin:Menu item-->
                <div class="menu-item {{ request()->routeIs('superadmin.checkin-log*') ? 'here show' : '' }}">
                    <a href="{{ route('superadmin.checkin-log') }}"
                        class="menu-link {{ request()->routeIs('superadmin.checkin-log*') ? 'active' : '' }}">
                        <span class="menu-icon">
                            <i class="ki-outline ki-scan-barcode fs-2"></i>
                        </span>
                        <span class="menu-title">Check-in Logs</span>
                    </a>
                </div>
                <!--end:Menu item-->

            </div>
            <!--end::Menu-->
        </div>
        <!--end::Menu wrapper-->
    </div>
    <!--end::sidebar menu-->

    <!--begin::Footer-->
    <div class="app-sidebar-footer d-flex align-items-center px-8 pb-10" id="kt_app_sidebar_footer">
        <!--begin::User-->
        <div class="">
            <!--begin::User info-->
            <div class="d-flex align-items-center" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                data-kt-menu-overflow="true" data-kt-menu-placement="top-start">
                <div class="d-flex flex-center cursor-pointer symbol symbol-circle symbol-40px">
                    <img src="assets/media/avatars/300-1.jpg" alt="image" />
                </div>
                <!--begin::Name-->
                <div class="d-flex flex-column align-items-start justify-content-center ms-3">
                    <span class="text-gray-500 fs-8 fw-semibold">Hello</span>
                    <a href="#" class="text-gray-800 fs-7 fw-bold text-hover-primary">{{ session('user.name') }}</a>
                </div>
                <!--end::Name-->
            </div>
            <!--end::User info-->

            <!--begin::User account menu-->
            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
                data-kt-menu="true">
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <div class="menu-content d-flex align-items-center px-3">
                        <div class="symbol symbol-50px me-5">
                            <img alt="Logo" src="assets/media/avatars/300-1.jpg" />
                        </div>
                        <div class="d-flex flex-column">
                            <div class="fw-bold d-flex align-items-center fs-5">{{ session('user.name') }}</div>
                            <span class="fw-semibold text-muted fs-7">{{ session('user.email') }}</span>
                        </div>
                    </div>
                </div>
                <!--end::Menu item-->
                <div class="separator my-2"></div>
                <div class="menu-item px-5">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="menu-link px-5 border-0 bg-transparent w-100 text-start">
                            Sign Out
                        </button>
                    </form>
                </div>
            </div>
            <!--end::User account menu-->
        </div>
        <!--end::User-->
    </div>
    <!--end::Footer-->
</div>
<!--end::Sidebar-->
