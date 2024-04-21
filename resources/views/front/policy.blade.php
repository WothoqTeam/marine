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

{{--        @if (App::getLocale() == 'ar')--}}
{{--			<link href="{{asset('dash/assets/plugins/global/plugins.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />--}}
{{--			<link href="{{asset('dash/assets/css/style.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />--}}
{{--		@else--}}
			<link href="{{asset('dash/assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
			<link href="{{asset('dash/assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
{{--		@endif--}}
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="app-blank bgi-size-cover bgi-position-center bgi-no-repeat">

		<!--begin::Root-->
		<div class="d-flex flex-column flex-root" id="kt_app_root">
			@php
            $page=\App\Models\Pages::find(1);
//            if (App::getLocale() == 'ar'){
//                $content=$page->content_ar;
//            }else{
                $content=$page->content_en;
//            }
			@endphp
            {{$content}}
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
