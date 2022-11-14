@include('webapp.layout.header')
    <div>
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <a href="/images/car_images/{{$listing->main_image}}" class="grid image-link">
                        <img src="/images/car_images/{{$listing->main_image}}" width="450" height="280" class="img-fluid" alt="#">
                    </a>
                </div>
                @if(count($otherimages)>0)
                  @foreach($otherimages as $otherimagesnew)
                  <div class="swiper-slide">
                    <a href="/{{$otherimagesnew->image}}" class="grid image-link">
                        <img src="/{{$otherimagesnew->image}}" width="450" height="280" class="img-fluid" alt="#">
                    </a>
                </div>
                  @endforeach
                  @endif
                
                
            </div>

            <div class="swiper-pagination swiper-pagination-white"></div>

            <div class="swiper-button-next swiper-button-white mr-3"></div>
            <div class="swiper-button-prev swiper-button-white ml-3"></div>
        </div>
    </div>
    <!-- END SECTION HEADINGS -->

    <!-- START SECTION LISTING DETAIL-->
    <section class="listing blog details">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 blog-pots">
                    <!-- Block heading end -->
                    <div class="row">
                        <div class="col-md-12">
                        @if(session()->has('message'))
                        <div class="alert alert-success m-auto text-center alert-dismissible">
                                <strong>Success!! </strong> {{ session()->get('message') }}
                                <button type="button" class="close mt-0" data-dismiss="alert">&times;</button>
                        </div>
                        @endif
                            <div class="detail-wrapper">
                                <div class="detail-wrapper-body">
                                    <div class="listing-title-bar">
                                        <h3>{{$listing->vehicle_name}} 
                                        @if(isset($_SESSION['userid']))
                                            <a href="/addtofaviourite/{{$listing->id}}/{{$_SESSION['userid']}}" title="Add to Faviourites" class="mrg-l-5 category-tag fa fa-heart-o pr-3 padd-r-10 text-danger"></a>
                                        @else
                                            <a href="/login" title="Add to Faviourites" class="mrg-l-5 category-tag fa fa-heart-o pr-3 padd-r-10 text-danger"></a>
                                        @endif
                                            
                                        </h3>
                                        <div class="mt-3">
                                            <a href="#listing-location" class="listing-address">
                                                <i class="fa fa-map-marker pr-2 ti-location-pin mrg-r-5"></i> {{$listing->location}}
                                            </a>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="widget_author__header">
                                <div class="widget_author__avatar">
                                    <img src="/webapp-assets/images/user-images/{{$listing->userphoto}}" alt="">
                                </div>
                                <div class="overflow-hidden">
                                    <h4 class="widget_author__name mt-4">{{$listing->username}}</h4>
                                    <span class="widget_author__role role--admin">
                                    <i class="fa fa-cogs mr-2 mt-2"></i> Seller</span>
                                    @if(isset($_SESSION['userid']))
                                    <a href="/view-messages/{{$listing->id}}/{{$_SESSION['userid']}}/{{$listing->user_id}}" class="btn_1 rounded">Send Message/Bargain</a>
                                    @else
                                    <a href="/login" class="btn_1 rounded">Send Message/Bargain</a>
                                    @endif
                                </div>
                            </div>
                            <div class="blog-info details overview">
                                <h5 class="mb-4">Status</h5>
                                <p class="mb-3">{{$listing->status}}</p>
                                
                            </div>
                            <div class="blog-info details overview">
                                <h5 class="mb-4">Vehicle Number</h5>
                                <p class="mb-3">{{$listing->vehicle_number}}</p>
                                
                            </div>
                            <div class="blog-info details overview">
                                <h5 class="mb-4">Engine Number</h5>
                                <p class="mb-3">{{$listing->engine_number}}</p>
                                
                            </div>
                            <div class="blog-info details overview">
                                <h5 class="mb-4">Vehicle Colour</h5>
                                <p class="mb-3">{{$listing->vehicle_colour}}</p>
                                
                            </div>
                            <div class="blog-info details overview">
                                <h5 class="mb-4">DESCRIPTION</h5>
                                <p class="mb-3">{{$listing->description}}</p>
                                
                            </div>
                        </div>
                    </div>
                    <!-- cars content -->
                  
                </div>
                <aside class="col-lg-4 col-md-12 car">
                    <div class="widget">
                       
                        <div class="widget widget_listings my-5">
                            <div class="widget-boxed-header">
                                <h4><i class="fa fa-map-marker pr-3"></i>Latest Car Listings</h4>
                            </div>
                            <div class="widget-boxed-body">
                                <ul>
                                    @foreach($otherlistings as $otherlistingsnew)
                                    <li>
                                        <a href="{{$otherlistingsnew->id}}"><img src="/images/car_images/{{$otherlistingsnew->main_image}}" alt=""></a>
                                        <div class="overflow-hidden">
                                            <span class="cat mt-0"><a href="{{$otherlistingsnew->id}}">{{$otherlistingsnew->vehicle_name}}</a></span>
                                            <h4><a href="{{$otherlistingsnew->id}}">{{$otherlistingsnew->location}}</a></h4>
                                            
                                        </div>
                                    </li>
                                    @endforeach
                                   
                                </ul>
                            </div>
                        </div>
                       
                    </div>
                </aside>
            </div>
        </div>
    </section>
    <!-- END SECTION LISTING DETAIL -->

    <!-- START FOOTER -->
    <footer class="first-footer">
        <div class="top-footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="netabout">
                            <a href="index.html" class="logo">
                                <img src="/webapp-assets/images/logo.svg" alt="netcom">
                            </a>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum incidunt architecto soluta laboriosam, perspiciatis, aspernatur officiis esse.</p>
                        </div>
                        <div class="contactus">
                            <ul>
                                <li>
                                    <div class="info">
                                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                                        <p class="in-p">95 South Park Avenue, USA</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="info">
                                        <i class="fa fa-phone" aria-hidden="true"></i>
                                        <p class="in-p">+456 875 369 208</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="info">
                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                        <p class="in-p ti">support@listingo.com</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="widget quick-link clearfix">
                            <h3 class="widget-title">Quick Links</h3>
                            <div class="quick-links">
                                <ul class="one-half mr-5">
                                    <li><a href="index.html">Home</a></li>
                                    <li><a href="about.html">About Us</a></li>
                                    <li><a href="listing-details.html">Listing Details</a></li>
                                    <li><a href="dashboard.html">Dashboard</a></li>
                                    <li><a href="register.html">Register</a></li>
                                    <li class="no-pb"><a href="blog-list.html">Blog List</a></li>
                                </ul>
                                <ul class="one-half">
                                    <li><a href="blog-grid.html">Blog</a></li>
                                    <li><a href="pricing-table.html">Pricing</a></li>
                                    <li><a href="contact-us.html">Contact</a></li>
                                    <li><a href="#">Support</a></li>
                                    <li><a href="faq.html">Our Faq</a></li>
                                    <li class="no-pb"><a href="listings-full-grid.html">Listings</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="widget">
                            <h3>Instagram</h3>
                            <ul class="photo">
                                <li class="hover-effect">
                                    <figure>
                                        <a href="#"><img src="/webapp-assets/images/instagram/inst-1.jpg" alt=""></a>
                                    </figure>
                                </li>
                                <li class="hover-effect">
                                    <figure>
                                        <a href="#"><img src="/webapp-assets/images/instagram/inst-2.jpg" alt=""></a>
                                    </figure>
                                </li>
                                <li class="hover-effect">
                                    <figure>
                                        <a href="#"><img src="/webapp-assets/images/instagram/inst-3.jpg" alt=""></a>
                                    </figure>
                                </li>
                                <li class="hover-effect">
                                    <figure>
                                        <a href="#"><img src="/webapp-assets/images/instagram/inst-4.jpg" alt=""></a>
                                    </figure>
                                </li>
                                <li class="hover-effect">
                                    <figure>
                                        <a href="#"><img src="/webapp-assets/images/instagram/inst-5.jpg" alt=""></a>
                                    </figure>
                                </li>
                                <li class="hover-effect">
                                    <figure>
                                        <a href="#"><img src="/webapp-assets/images/instagram/inst-6.jpg" alt=""></a>
                                    </figure>
                                </li>
                                <li class="hover-effect">
                                    <figure>
                                        <a href="#"><img src="/webapp-assets/images/instagram/inst-7.jpg" alt=""></a>
                                    </figure>
                                </li>
                                <li class="hover-effect">
                                    <figure>
                                        <a href="#"><img src="/webapp-assets/images/instagram/inst-8.jpg" alt=""></a>
                                    </figure>
                                </li>
                                <li class="hover-effect">
                                    <figure>
                                        <a href="#"><img src="/webapp-assets/images/instagram/inst-9.jpg" alt=""></a>
                                    </figure>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="newsletters">
                            <h3>Newsletters</h3>
                            <p>Sign Up for Our Newsletter to get Latest Updates and Offers. Subscribe to receive news in your inbox.</p>
                        </div>
                        <form class="bloq-email mailchimp form-inline" method="post">
                            <label for="subscribeEmail" class="error"></label>
                            <div class="email">
                                <input type="email" id="subscribeEmail" name="EMAIL" placeholder="Enter Your Email">
                                <input type="submit" value="Subscribe">
                                <p class="subscription-success"></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="second-footer">
            <div class="container">
                <p>Code-Theme. ©2020 All rights reserved. </p>
                <ul class="netsocials">
                    <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                    <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                    <li><a href="#"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                </ul>
            </div>
        </div>
    </footer>

    <a data-scroll href="#heading" class="go-up"><i class="fa fa-angle-double-up" aria-hidden="true"></i></a>
    <!-- END FOOTER -->
    
    <!--Style Switcher===========================================-->
	<div class="color-switcher" id="choose_color"> <a href="#." class="picker_close"><i class="fa fa-cog fa-spin fa-2x" ></i></a>
		<div class="theme-colours">
			<p class="font-italic">Choose Colour style</p>
			<ul>
				<li>
					<a href="#." class="blue" id="blue"></a>
				</li>
				<li>
					<a href="#." class="pink" id="pink"></a>
				</li>
				<li>
					<a href="#." class="orange" id="orange"></a>
				</li>
				<li>
					<a href="#." class="purple" id="purple"></a>
				</li>
				<li>
					<a href="#." class="green" id="green"></a>
				</li>
				<li>
					<a href="#." class="red" id="red"></a>
				</li>
				<li>
					<a href="#." class="cyan" id="cyan"></a>
				</li>
				<li>
					<a href="#." class="sky-blue" id="sky-blue"></a>
				</li>
				<li>
					<a href="#." class="gray" id="gray"></a>
				</li>
				<li>
					<a href="#." class="brown" id="brown"></a>
				</li>
			</ul>
		</div>
	</div>

    <!-- ARCHIVES JS -->
    <script src="/webapp-assets/js/jquery.min.js"></script>
    <script src="/webapp-assets/js/jquery-ui.js"></script>
    <script src="/webapp-assets/js/range-slider.js"></script>
    <script src="/webapp-assets/js/tether.min.js"></script>
    <script src="/webapp-assets/js/bootstrap.min.js"></script>
    <script src="/webapp-assets/js/smooth-scroll.min.js"></script>
    <script src="/webapp-assets/js/jquery.magnific-popup.min.js"></script>
    <script src="/webapp-assets/js/popup.js"></script>
    <script src="/webapp-assets/js/ajaxchimp.min.js"></script>
    <script src="/webapp-assets/js/newsletter.js"></script>
    <script src="/webapp-assets/js/timedropper.js"></script>
    <script src="/webapp-assets/js/datedropper.js"></script>
    <script src="/webapp-assets/js/jqueryadd-count.js"></script>
    <script src="/webapp-assets/js/leaflet.js"></script>
    <script src="/webapp-assets/js/leaflet-gesture-handling.min.js"></script>
    <script src="/webapp-assets/js/leaflet-providers.js"></script>
    <script src="/webapp-assets/js/leaflet.markercluster.js"></script>
    <script src="/webapp-assets/js/map-single.js"></script>
    <script src="/webapp-assets/js/swiper.min.js"></script>
    <script src="/webapp-assets/js/color-switcher.js"></script>
    <script>
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 3,
            slidesPerGroup: 3,
            loop: true,
            loopFillGroupWithBlank: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });

    </script>

    <script>
        if ($('.image-link').length) {
            $('.image-link').magnificPopup({
                type: 'image',
                gallery: {
                    enabled: true
                }
            });
        }
        if ($('.image-link2').length) {
            $('.image-link2').magnificPopup({
                type: 'image',
                gallery: {
                    enabled: true
                }
            });
        }

    </script>
    <!-- Date Dropper Script-->
    <script>
        $('#reservation-date').dateDropper();

    </script>
    <!-- Time Dropper Script-->
    <script>
        this.$('#reservation-time').timeDropper({
            setCurrentTime: false,
            meridians: true,
            primaryColor: "#e8212a",
            borderColor: "#e8212a",
            minutesInterval: '15'
        });

    </script>

    <script src="/webapp-assets/js/inner.js"></script>
</body>


</html>
