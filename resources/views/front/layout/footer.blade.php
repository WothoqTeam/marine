<!-- Footer section starts -->
<footer class="footer" id="contact">
    <div class="container clm">

        @if (App::getLocale() == 'ar')
        <div class="row">
            <!-- Footer single info start -->
            <div class="col-md-4 col-sm-4">
                <img src="{{asset('front/images/icon1.png')}}" class="icn">
                <div class="footer-single wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                    <h4>للدعم اتصل بنا </h4>
                    <p>1800-3333-1234</p>
                </div>
            </div>
            <!-- Footer single info end -->
            
            <!-- Footer single info start -->
            <div class="col-md-4 col-sm-4">
                <img src="{{asset('front/images/icon1.png')}}" class="icn">
                <div class="footer-single wow fadeInUp" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                    <h4>راسلنا عبر البريد</h4>
                    <p>contact@domainname.com</p>
                </div>
            </div>
            <!-- Footer single info end -->
            
            <!-- Footer single info start -->
            <div class="col-md-4 col-sm-4">
                <img src="{{asset('front/images/icon1.png')}}" class="icn">
                <div class="footer-single wow fadeInUp" data-wow-delay="0.6s" style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInUp;">
                    <h4>عنوان مكتبنا</h4>
                    <p>101, Street Name Here <br>
                    California, CA-24561</p>
                </div>
            </div>
            <!-- Footer single info end -->
        </div>
        @else
        <div class="row">
            <!-- Footer single info start -->
            <div class="col-md-4 col-sm-4">
                <img src="{{asset('front/images/icon4.png')}}" class="icn">
                <div class="footer-single wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                    <h4>Our head office</h4>
                    <p>101, Street Name Here <br>
                        California, CA-24561</p>
                </div>
            </div>
            <!-- Footer single info end -->
            
            <!-- Footer single info start -->
            <div class="col-md-4 col-sm-4">
                <img src="{{asset('front/images/icon5.png')}}" class="icn">
                <div class="footer-single wow fadeInUp" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                    <h4>Contact us</h4>
                    <p>contact@domainname.com</p>
                </div>
            </div>
            <!-- Footer single info end -->
            
            <!-- Footer single info start -->
            <div class="col-md-4 col-sm-4">
                <img src="{{asset('front/images/icon6.png')}}" class="icn">
                <div class="footer-single wow fadeInUp" data-wow-delay="0.6s" style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInUp;">
                    <h4>Call for us:</h4>
                    <p>1800-3333-1234</p>
                </div>
            </div>
            <!-- Footer single info end -->
        </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                
                <!-- Footer social link start -->
                <div class="footer-social-links wow zoomIn" data-wow-delay="0.6s" style="visibility: visible; animation-delay: 0.6s; animation-name: zoomIn;">
                    <a href="#"><i class="fa fa-envelope"></i></a>
                    <a href="#"><i class="fa fa-instagram"></i></a>
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-whatsapp"></i></a>
                    <a href="#"><i class="fa fa-phone"></i></a>
                </div>
                <!-- Footer social link end -->
            </div>
        </div>
    </div>
</footer>
<!-- Footer section ends -->

<!-- Jquery Library File -->
<script src="{{asset('front/js/jquery-1.12.4.min.js')}}"></script>
<!-- Bootstrap js file -->
<script src="{{asset('front/js/bootstrap.min.js')}}"></script>
<!-- Bootstrap form validator -->
<script src="{{asset('front/js/validator.min.js')}}"></script>
<!-- Slick Nav js file -->
<script src="{{asset('front/js/jquery.slicknav.js')}}"></script>
<!-- Wow js file -->
<script src="{{asset('front/js/wow.js')}}"></script>
<!-- Swiper Carousel js file -->
<script src="{{asset('front/js/swiper.min.js')}}"></script>
<!-- Magnific Popup core JS file -->
<script src="{{asset('front/js/jquery.magnific-popup.min.js')}}"></script>
<!-- SmoothScroll -->
<script src="{{asset('front/js/SmoothScroll.js')}}"></script>
<!-- Main Custom js file -->
<script src="{{asset('front/js/function.js')}}"></script>

@yield('script')
</body>
</html>