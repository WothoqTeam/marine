<!DOCTYPE html>
<html @if (App::getLocale() == 'ar') lang="ar" direction="rtl" dir="rtl" style="direction: rtl;" @else lang="en" @endif>
	<!--begin::Head-->
	<head><base href="{{asset('dash/assets/')}}"/>
		<title>{{$settings->append_name}}</title>
		<meta charset="utf-8" />
		<meta name="description" content="{{$settings->append_description}}" />
		<meta name="keywords" content="{{$settings->append_keywords}}" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />

		<link rel="shortcut icon" href="{{$settings->getFirstMediaUrl('fav')}}" />
		<!--begin::Fonts(mandatory for all pages)-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet">

        @if (App::getLocale() == 'ar')
			<link href="{{asset('dash/assets/plugins/global/plugins.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
			<link href="{{asset('dash/assets/css/style.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
		@else
			<link href="{{asset('dash/assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
			<link href="{{asset('dash/assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
		@endif
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="app-blank bgi-size-cover bgi-position-center bgi-no-repeat">

		<!--begin::Root-->
		<div class="d-flex flex-column flex-root" id="kt_app_root">
			<!--begin::Page bg image-->
			<style>body { background-image: url("{{asset('dash/assets/media/auth/14-2.jpg')}}"); } [data-bs-theme="dark"] body { background-image: url("{{asset('dash/assets/media/auth/bg6-dark.jpg')}}"); }</style>
			<!--end::Page bg image-->
			<!--begin::Authentication - Signup Welcome Message -->
			<div class="d-flex flex-column flex-center flex-column-fluid">
				<!--begin::Content-->
				<div class="d-flex flex-column flex-center text-center p-10">
					<!--begin::Wrapper-->
					<div class="card card-flush w-lg-650px py-5">
						<div class="card-body py-15 py-lg-20">
							<!--begin::Logo-->
							<div class="mb-13">
								<a href="javascript:void(0)" class="">
									<img alt="Logo" src="{{$settings->getFirstMediaUrl('logo')}}" class="h-40px" />
								</a>
							</div>
							<!--end::Logo-->
							<!--begin::Title-->
							<h1 class="fw-bolder text-gray-900 mb-7">{{$settings->append_name}}</h1>
							<!--end::Title-->

							<!--begin::Text-->
							<div class="fw-semibold fs-6 text-gray-500 mb-7">This is your opportunity to get creative amazing opportunaties
							<br />that gives readers an idea</div>
							<!--end::Text-->
							<!--begin::Form-->
							<form class="w-md-350px mb-2 mx-auto" action="#" id="kt_coming_soon_form">
								<div class="fv-row text-start">
									<div class="d-flex flex-column flex-md-row justify-content-center gap-3">
										<!--end::Input=-->
										<input type="text" placeholder="Email" name="email" autocomplete="off" class="form-control" />
										<!--end::Input=-->
										<!--begin::Submit-->
										<button class="btn btn-primary text-nowrap" id="kt_coming_soon_submit">
											<!--begin::Indicator label-->
											<span class="indicator-label">Notify Me</span>
											<!--end::Indicator label-->
											<!--begin::Indicator progress-->
											<span class="indicator-progress">Please wait...
											<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
											<!--end::Indicator progress-->
										</button>
										<!--end::Submit-->
									</div>
								</div>
							</form>
							<!--end::Form-->
							<!--begin::Illustration-->
							<div class="mb-n5">
								<img src="assets/media/auth/chart-graph.png" class="mw-100 mh-300px theme-light-show" alt="" />
								<img src="assets/media/auth/chart-graph-dark.png" class="mw-100 mh-300px theme-dark-show" alt="" />
							</div>
							<!--end::Illustration-->
						</div>
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Content-->
			</div>
			<!--end::Authentication - Signup Welcome Message-->
		</div>
		<!--end::Root-->
		<!--begin::Javascript-->
		<script>var hostUrl = "{{asset('dash/assets/')}}";</script>
		<!--begin::Global Javascript Bundle(mandatory for all pages)-->
		<script src="{{asset('dash/assets/plugins/global/plugins.bundle.js')}}"></script>
		<script src="{{asset('dash/assets/js/scripts.bundle.js')}}"></script>
		<!--end::Global Javascript Bundle-->
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>