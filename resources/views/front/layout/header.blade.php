<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="{{$settings->append_description}}">
    <meta name="keywords" content="{{$settings->append_keywords}}">

	<link rel="shortcut icon" href="{{$settings->getFirstMediaUrl('fav')}}" />

	<!-- Page Title -->
	<title>{{$settings->append_name}}</title>
	<!-- Google Fonts css-->
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
	<!-- Bootstrap css -->
	<link href="{{asset('front/css/bootstrap.min.css')}}" rel="stylesheet" media="screen">
	<!-- Font Awesome icon css-->
	<link href="{{asset('front/css/font-awesome.min.css')}}" rel="stylesheet" media="screen">
	<link href="{{asset('front/css/flaticon.css')}}" rel="stylesheet" media="screen">
	<!-- Swiper's CSS -->
	<link rel="stylesheet" href="{{asset('front/css/swiper.min.css')}}">
	<!-- Slick nav css -->
	<link rel="stylesheet" href="{{asset('front/css/slicknav.css')}}">
	<!-- Animated css -->
	<link href="{{asset('front/css/animate.css')}}" rel="stylesheet">
	<!-- Magnific Popup CSS -->
	<link href="{{asset('front/css/magnific-popup.css')}}" rel="stylesheet">
	<!-- Main custom css -->

	@yield('css')

	<link href="{{asset('front/css/custom.css')}}" rel="stylesheet" media="screen">

	@if (App::getLocale() == 'ar')
    <link href="{{asset('front/css/rtl.css')}}" rel="stylesheet" media="screen">
	@endif

	@yield('style')
	

</head>
<body data-spy="scroll" data-target="#navigation" data-offset="71">
	
	<!-- Preloader starts -->
	<div class="preloader">
		<div class="sk-wave">
			<div class="sk-rect sk-rect1"></div>
			<div class="sk-rect sk-rect2"></div>
			<div class="sk-rect sk-rect3"></div>
			<div class="sk-rect sk-rect4"></div>
			<div class="sk-rect sk-rect5"></div>
		</div>
	</div>
	<!-- Preloader Ends -->

	<!-- Header Section Starts-->
	<header>
        @if (App::getLocale() == 'ar')
		<nav id="main-nav" class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<!-- Logo starts -->
					<a class="navbar-brand" href="{{url('/')}}" >
						<img src="{{$settings->getFirstMediaUrl('logo')}}" alt="Logo" />
					</a>
					<!-- Logo Ends -->
					
					<!-- Responsive Menu button starts -->
					<div class="navbar-toggle">
					</div>
					<!-- Responsive Menu button Ends -->
				</div>
				<div id="responsive-menu"></div>
				<!-- Navigation starts -->
				<div class="navbar-collapse collapse" id="navigation">
					<ul class="nav navbar-nav navbar-left main-navigation" id="main-menu">
						<li class="active"><a href="#home">الرئيسية</a></li>
						<li><a href="#hotitworks">من نحن</a></li>
						<li><a href="#features">المميزات</a></li>
						<li><a href="#overview">واجهات التطبيق</a></li>
						<li><a href="#contact">تواصل معنا</a></li>
						<li><a href="{{url('/lang-change?lang=en')}}">انجليزي</a></li>
					</ul>
				</div>
				<!-- Navigation Ends -->
			</div>
		</nav>
        @else

        <nav id="main-nav" class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<!-- Logo starts -->
					<a class="navbar-brand" href="{{url('/')}}" >
						<img src="{{$settings->getFirstMediaUrl('logo')}}" alt="Logo" />
					</a>
					<!-- Logo Ends -->
					
					<!-- Responsive Menu button starts -->
					<div class="navbar-toggle">
					</div>
					<!-- Responsive Menu button Ends -->
				</div>
				<div id="responsive-menu"></div>
				<!-- Navigation starts -->
				<div class="navbar-collapse collapse" id="navigation">
					<ul class="nav navbar-nav navbar-left main-navigation" id="main-menu">
						<li class="active"><a href="#home">Home</a></li>
						<li><a href="#hotitworks">About us</a></li>
						<li><a href="#features">App Features</a></li>
						<li><a href="#overview">App Screenshot</a></li>
						<li><a href="#contact">Contact us</a></li>
						<li><a href="{{url('/lang-change?lang=ar')}}">Arabic</a></li>
					</ul>
				</div>
				<!-- Navigation Ends -->
			</div>
		</nav>
        @endif
	</header>
	<!-- Header Section Ends-->