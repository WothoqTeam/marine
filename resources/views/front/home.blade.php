@extends('front.layout.master')

@section('css')
@endsection

@section('style')
@endsection

@section('content')
@if (App::getLocale() == 'ar')
    <!-- Banner Section Starts -->
    <section class="banner hidden-xs" id="home">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <!-- Header image start -->
                    <div class="banner-image wow fadeInLeft">
                        <img src="{{asset('front/images/header-1.png')}}" alt="" />
                    </div>
                    <!-- Header image end -->
                </div>
                <div class="col-md-6 col-sm-6">
                    <!-- Header Content start -->
                    <div class="header-content wow fadeInUp">
                        <h2>يخوت محيط الأحلام</h2>
                        <p>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.هذا النص يمكن أن يتم تركيبه على أي تصميم دون مشكلة فلن يبدو وكأنه نص منسوخ، غير منظم، غير منسق، أو حتى غير مفهوم. لأنه مازال نصاً بديلاً ومؤقتاً.</p>
                        <p>حمل التطبيق الان <br><span>متاح لتطبيقات الاندرويد والايفون والاي باد</span></p>

                        <div class="download-button">
                            <a href="#" class="btn-download btn-apple"><i class="fa fa-apple"></i> App Store</a>
                            <a href="#" class="btn-download btn-android"><i class="fa fa-android"></i>  Google Play</a>
                        </div>
                    </div>
                    <!-- Header Content end -->
                </div>


            </div>
        </div>
    </section>

    <section class="banner visible-xs" id="home">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <!-- Header image start -->
                    <div class="banner-image wow fadeInLeft">
                        <img src="{{asset('front/images/header-1.png')}}" alt="" />
                    </div>
                    <!-- Header image end -->
                </div>

                <div class="col-md-6 col-sm-6">
                    <!-- Header Content start -->
                    <div class="header-content wow fadeInUp">
                        <h2>يخوت محيط الأحلام</h2>
                        <p>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.هذا النص يمكن أن يتم تركيبه على أي تصميم دون مشكلة فلن يبدو وكأنه نص منسوخ، غير منظم، غير منسق، أو حتى غير مفهوم. لأنه مازال نصاً بديلاً ومؤقتاً.</p>
                        <p>حمل التطبيق الان <br><span>متاح لتطبيقات الاندرويد والايفون والاي باد</span></p>

                        <div class="download-button">
                            <a href="#" class="btn-download btn-apple"><i class="fa fa-apple"></i> App Store</a>
                            <a href="#" class="btn-download btn-android"><i class="fa fa-android"></i>  Google Play</a>
                        </div>
                    </div>
                    <!-- Header Content end -->
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Section Ends -->

    <!-- About section starts -->
    <section class="how-it-works" id="hotitworks">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title wow fadeInUp">
                        <h2>من نحن</h2>
                        <p>هذا النص يمكن أن يتم تركيبه على أي تصميم دون مشكلة فلن يبدو وكأنه نص منسوخ<br>، غير منظم، غير منسق، أو حتى غير مفهوم. لأنه مازال نصاً بديلاً ومؤقتاً.</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <!-- How it work single start -->
                    <div class="how-it-work-single howitwork-skyblue wow fadeInUp" data-wow-delay="0.2s">
                        <div class="icon-box">
                            <img src="{{asset('front/images/icon1.png')}}" class="abimg">
                        </div>

                        <h3>هذا النص هو مثال</h3>
                        <p>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى</p>

                    </div>
                    <!-- How it work single end -->
                </div>

                <div class="col-md-4 col-sm-4">
                    <!-- How it work single start -->
                    <div class="how-it-work-single howitwork-yellow wow fadeInUp" data-wow-delay="0.4s">
                        <div class="icon-box">
                            <img src="{{asset('front/images/icon2.png')}}" class="abimg">
                        </div>

                        <h3>هذا النص هو مثال</h3>
                        <p>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى</p>
                    </div>
                    <!-- How it work single end -->
                </div>

                <div class="col-md-4 col-sm-4">
                    <!-- How it work single start -->
                    <div class="how-it-work-single howitwork-pink wow fadeInUp" data-wow-delay="0.6s">
                        <div class="icon-box">
                            <img src="{{asset('front/images/icon3.png')}}" class="abimg">
                        </div>

                        <h3>هذا النص هو مثال</h3>
                        <p>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى</p>
                    </div>
                    <!-- How it work single end -->
                </div>
            </div>
        </div>
    </section>
    <!-- About section ends -->

    <!-- Awesome features section starts -->
    <section class="awesome-features" id="features" style="padding: 0px 0;">
        <img src="{{asset('front/images/f-top.png')}}"  style="margin: -1px 0px 100px;"/>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title wow fadeInUp">
                        <h2>المميزات</h2>
                        <p>هذا النص يمكن أن يتم تركيبه على أي تصميم دون مشكلة فلن يبدو وكأنه نص منسوخ<br>، غير منظم، غير منسق، أو حتى غير مفهوم. لأنه مازال نصاً بديلاً ومؤقتاً.</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <br><br>
                    <div class="col-md-12">
                        <div class="feature-single feature-pink wow fadeInUp text-right" data-wow-delay="0.2s">
                            <img src="{{asset('front/images/dot.png')}}" class="dotimg" />
                            <h3>هذا النص هو مثال</h3>
                        <p>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى</p>
                        </div>
                    </div>
                    <!-- Feature single start -->

                    <!-- Feature single start -->
                    <div class="col-md-12">
                        <div class="feature-single feature-yellow wow fadeInUp text-right" data-wow-delay="0.4s">
                            <img src="{{asset('front/images/dot.png')}}" class="dotimg" />
                            <h3>هذا النص هو مثال</h3>
                        <p>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى</p>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="feature-single feature-yellow wow fadeInUp text-right" data-wow-delay="0.4s">
                            <img src="{{asset('front/images/dot.png')}}" class="dotimg" />
                            <h3>هذا النص هو مثال</h3>
                        <p>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <!-- Awesome Feature Image start -->
                    <div class="awesome-features-image wow fadeInRight" data-wow-delay="0.4s">
                        <img src="{{asset('front/images/header-1.png')}}" alt="" />
                    </div>
                    <!-- Awesome Feature Image end -->
                </div>

                <div class="col-md-4">
                    <br><br>
                    <div class="col-md-12">
                        <div class="feature-single feature-pink wow fadeInUp text-left" data-wow-delay="0.2s">
                            <img src="{{asset('front/images/dot.png')}}" class="dotimg" />
                            <h3>هذا النص هو مثال</h3>
                        <p>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى</p>
                        </div>
                    </div>
                    <!-- Feature single start -->

                    <!-- Feature single start -->
                    <div class="col-md-12">
                        <div class="feature-single feature-yellow wow fadeInUp text-left" data-wow-delay="0.4s">
                            <img src="{{asset('front/images/dot.png')}}" class="dotimg" />
                            <h3>هذا النص هو مثال</h3>
                        <p>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى</p>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="feature-single feature-yellow wow fadeInUp text-left" data-wow-delay="0.4s">
                            <img src="{{asset('front/images/dot.png')}}" class="dotimg" />
                            <h3>هذا النص هو مثال</h3>
                        <p>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <img src="{{asset('front/images/f-bottom.png')}}"  style="margin: 100px 0px 0px;"/>
    </section>
    <!-- Awesome features section ends -->

    <!-- Screenshot section starts -->
    <section class="intro-video" id="overview">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <!-- Intro video content start -->
                    <div class="video-entry wow fadeInUp">
                        <div class="section-title">
                            <h2>واجهات التطبيق</h2>
                        </div>

                        <p>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.</p>
                    </div>
                    <!-- Intro video content end -->
                </div>
                <div class="col-md-8">
                    <div class="swiper-container screenshot-slider">
                        <div class="swiper-wrapper">

                            <!-- Screenshot slide start -->
                            <div class="swiper-slide">
                                <div class="screenshot-slide">
                                    <img src="{{asset('front/images/slider-1.png')}}" alt="" />
                                </div>
                            </div>
                            <!-- Screenshot slide end -->
                            <!-- Screenshot slide start -->
                            <div class="swiper-slide">
                                <div class="screenshot-slide">
                                    <img src="{{asset('front/images/slider1.png')}}" alt="" />
                                </div>
                            </div>
                            <!-- Screenshot slide end -->
                            <!-- Screenshot slide start -->
                            <div class="swiper-slide">
                                <div class="screenshot-slide">
                                    <img src="{{asset('front/images/slider-3.png')}}" alt="" />
                                </div>
                            </div>
                            <!-- Screenshot slide end -->
                            <!-- Screenshot slide start -->
                            <div class="swiper-slide">
                                <div class="screenshot-slide">
                                    <img src="{{asset('front/images/slider1.png')}}" alt="" />
                                </div>
                            </div>
                            <!-- Screenshot slide end -->

                            <!-- Screenshot slide start -->
                            <div class="swiper-slide">
                                <div class="screenshot-slide">
                                    <img src="{{asset('front/images/slider-1.png')}}" alt="" />
                                </div>
                            </div>
                            <!-- Screenshot slide end -->

                            <!-- Screenshot slide start -->
                            <div class="swiper-slide">
                                <div class="screenshot-slide">
                                    <img src="{{asset('front/images/slider-3.png')}}" alt="" />
                                </div>
                            </div>
                            <!-- Screenshot slide end -->

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
    <!-- Screenshot section ends -->
@else
<!-- Banner Section Starts -->
<section class="banner hidden-xs" id="home">
    <div class="container">
        <div class="row">

            <div class="col-md-6 col-sm-6">
                <!-- Header Content start -->
                <div class="header-content wow fadeInUp">
                    <h2>Oceanic Dream Yachts</h2>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                    <p>Get The App Now <br><span>*Available on iphone, ipad and all android devices</span></p>

                    <div class="download-button">
                        <a href="#" class="btn-download btn-apple"><i class="fa fa-apple"></i> App Store</a>
                        <a href="#" class="btn-download btn-android"><i class="fa fa-android"></i>  Google Play</a>
                    </div>
                </div>
                <!-- Header Content end -->
            </div>
            <div class="col-md-6 col-sm-6">
                <!-- Header image start -->
                <div class="banner-image wow fadeInLeft">
                    <img src="{{asset('front/images/header-1.png')}}" alt="" />
                </div>
                <!-- Header image end -->
            </div>

        </div>
    </div>
</section>

<section class="banner visible-xs" id="home">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <!-- Header image start -->
                <div class="banner-image wow fadeInLeft">
                    <img src="{{asset('front/images/header-1.png')}}" alt="" />
                </div>
                <!-- Header image end -->
            </div>

            <div class="col-md-6 col-sm-6">
                <!-- Header Content start -->
                <div class="header-content wow fadeInUp">
                    <h2>Oceanic Dream Yachts</h2>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                    <p>Get The App Now <br><span>*Available on iphone, ipad and all android devices</span></p>

                    <div class="download-button">
                        <a href="#" class="btn-download btn-apple"><i class="fa fa-apple"></i> App Store</a>
                        <a href="#" class="btn-download btn-android"><i class="fa fa-android"></i>  Google Play</a>
                    </div>
                </div>
                <!-- Header Content end -->
            </div>
        </div>
    </div>
</section>
<!-- Banner Section Ends -->

<!-- About section starts -->
<section class="how-it-works" id="hotitworks">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title wow fadeInUp">
                    <h2>About us</h2>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. <br />Lorem Ipsum has been the industry's standard dummy</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 col-sm-4">
                <!-- How it work single start -->
                <div class="how-it-work-single howitwork-skyblue wow fadeInUp" data-wow-delay="0.2s">
                    <div class="icon-box">
                        <img src="{{asset('front/images/icon1.png')}}" class="abimg">
                    </div>

                    <h3>Create free account</h3>
                    <p>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages Lorem Ipsum passages</p>

                </div>
                <!-- How it work single end -->
            </div>

            <div class="col-md-4 col-sm-4">
                <!-- How it work single start -->
                <div class="how-it-work-single howitwork-yellow wow fadeInUp" data-wow-delay="0.4s">
                    <div class="icon-box">
                        <img src="{{asset('front/images/icon2.png')}}" class="abimg">
                    </div>

						<h3>Connect your devices</h3>
						<p>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages Lorem Ipsum passages</p>
                </div>
                <!-- How it work single end -->
            </div>

            <div class="col-md-4 col-sm-4">
                <!-- How it work single start -->
                <div class="how-it-work-single howitwork-pink wow fadeInUp" data-wow-delay="0.6s">
                    <div class="icon-box">
                        <img src="{{asset('front/images/icon3.png')}}" class="abimg">
                    </div>

                    <h3>Tracke Records</h3>
                    <p>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages Lorem Ipsum passages</p>
                </div>
                <!-- How it work single end -->
            </div>
        </div>
    </div>
</section>
<!-- About section ends -->

<!-- Awesome features section starts -->
<section class="awesome-features" id="features" style="padding: 0px 0;">
    <img src="{{asset('front/images/f-top.png')}}"  style="margin: -1px 0px 100px;"/>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title wow fadeInUp">
                    <h2>App Features</h2>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. <br />Lorem Ipsum has been the industry's standard dummy</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <br><br>
                <div class="col-md-12">
                    <div class="feature-single feature-pink wow fadeInUp text-right" data-wow-delay="0.2s">
                        <img src="{{asset('front/images/dot.png')}}" class="dotimg" />
                        <h3>Fast & Simple</h3>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting off industry. HTML template pre</p>
                </div>
                </div>
                <!-- Feature single start -->

                <!-- Feature single start -->
                <div class="col-md-12">
                    <div class="feature-single feature-yellow wow fadeInUp text-right" data-wow-delay="0.4s">
                        <img src="{{asset('front/images/dot.png')}}" class="dotimg" />
                        <h3>Fast & Simple</h3>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting off industry. HTML template pre</p>
                </div>
                </div>

                <div class="col-md-12">
                    <div class="feature-single feature-yellow wow fadeInUp text-right" data-wow-delay="0.4s">
                        <img src="{{asset('front/images/dot.png')}}" class="dotimg" />
                        <h3>Fast & Simple</h3>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting off industry. HTML template pre</p>
                </div>
                </div>
            </div>

            <div class="col-md-4">
                <!-- Awesome Feature Image start -->
                <div class="awesome-features-image wow fadeInRight" data-wow-delay="0.4s">
                    <img src="{{asset('front/images/header-1.png')}}" alt="" />
                </div>
                <!-- Awesome Feature Image end -->
            </div>

            <div class="col-md-4">
                <br><br>
                <div class="col-md-12">
                    <div class="feature-single feature-pink wow fadeInUp text-left" data-wow-delay="0.2s">
                        <img src="{{asset('front/images/dot.png')}}" class="dotimg" />
                        <h3>Fast & Simple</h3>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting off industry. HTML template pre</p>
                </div>
                </div>
                <!-- Feature single start -->

                <!-- Feature single start -->
                <div class="col-md-12">
                    <div class="feature-single feature-yellow wow fadeInUp text-left" data-wow-delay="0.4s">
                        <img src="{{asset('front/images/dot.png')}}" class="dotimg" />
                        <h3>Fast & Simple</h3>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting off industry. HTML template pre</p>
                </div>
                </div>

                <div class="col-md-12">
                    <div class="feature-single feature-yellow wow fadeInUp text-left" data-wow-delay="0.4s">
                        <img src="{{asset('front/images/dot.png')}}" class="dotimg" />
                        <h3>Fast & Simple</h3>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting off industry. HTML template pre</p>
                </div>
                </div>
            </div>
        </div>
    </div>
    <img src="{{asset('front/images/f-bottom.png')}}"  style="margin: 100px 0px 0px;"/>
</section>
<!-- Awesome features section ends -->

<!-- Screenshot section starts -->
<section class="intro-video" id="overview">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <!-- Intro video content start -->
                <div class="video-entry wow fadeInUp">
                    <div class="section-title">
                        <h2>App Screenshot</h2>
                    </div>

                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>
                </div>
                <!-- Intro video content end -->
            </div>
            <div class="col-md-8">
                <div class="swiper-container screenshot-slider">
                    <div class="swiper-wrapper">

                        <!-- Screenshot slide start -->
                        <div class="swiper-slide">
                            <div class="screenshot-slide">
                                <img src="{{asset('front/images/slider-1.png')}}" alt="" />
                            </div>
                        </div>
                        <!-- Screenshot slide end -->
                        <!-- Screenshot slide start -->
                        <div class="swiper-slide">
                            <div class="screenshot-slide">
                                <img src="{{asset('front/images/slider1.png')}}" alt="" />
                            </div>
                        </div>
                        <!-- Screenshot slide end -->
                        <!-- Screenshot slide start -->
                        <div class="swiper-slide">
                            <div class="screenshot-slide">
                                <img src="{{asset('front/images/slider-3.png')}}" alt="" />
                            </div>
                        </div>
                        <!-- Screenshot slide end -->
                        <!-- Screenshot slide start -->
                        <div class="swiper-slide">
                            <div class="screenshot-slide">
                                <img src="{{asset('front/images/slider1.png')}}" alt="" />
                            </div>
                        </div>
                        <!-- Screenshot slide end -->

                        <!-- Screenshot slide start -->
                        <div class="swiper-slide">
                            <div class="screenshot-slide">
                                <img src="{{asset('front/images/slider-1.png')}}" alt="" />
                            </div>
                        </div>
                        <!-- Screenshot slide end -->

                        <!-- Screenshot slide start -->
                        <div class="swiper-slide">
                            <div class="screenshot-slide">
                                <img src="{{asset('front/images/slider-3.png')}}" alt="" />
                            </div>
                        </div>
                        <!-- Screenshot slide end -->

                    </div>
                </div>

            </div>

        </div>
    </div>
</section>
<!-- Screenshot section ends -->
@endif
@endsection

@section('script')
@endsection
