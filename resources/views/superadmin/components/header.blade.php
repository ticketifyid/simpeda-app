<!--begin::Header-->
<div id="kt_app_header" class="app-header">
    <!--begin::Header container-->
    <div class="app-container container-fluid d-flex align-items-stretch flex-stack" id="kt_app_header_container">
        <!--begin::Sidebar toggle-->
        <div class="d-flex align-items-center d-block d-lg-none ms-n3" title="Show sidebar menu">
            <div class="btn btn-icon btn-active-color-primary w-35px h-35px me-2" id="kt_app_sidebar_mobile_toggle">
                <i class="ki-outline ki-abstract-14 fs-2"></i>
            </div>
            <!--begin::Logo image-->
            <a href="{{ route('superadmin.dashboard') }}">
                <img alt="Ticketify" src="assets/media/logos/ticketify.jpg" class="h-40px" style="border-radius: 8px;" />
            </a>
            <!--end::Logo image-->
        </div>
        <!--end::Sidebar toggle-->
    </div>
    <!--end::Header container-->
</div>
<!--end::Header-->
