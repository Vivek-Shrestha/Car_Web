@include('webapp.layout.header')

 <!-- STAR HEADER SEARCH -->
    <div id="map-container" class="fullwidth-home-map dark-overlay">
        <!-- Video -->
        <div class="video-container">
            <video poster="/webapp-assets/images/bg/video-poster.jpg" loop autoplay muted>
                <source src="/webapp-assets/video/4.mp4" type="video/mp4">
            </video>
        </div>
        <div id="hero-area" class="main-search-inner search-2 vid">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="hero-inner2">

                        
           
                            <!-- Welcome Text -->
                            <div class="welcome-text" style="padding-top: 15px;">
                                <h1>Find Places That People Love</h1>
                               <p>
								   @if(isset($_SESSION['userid']))
                                    <a style="text-decoration: none; color:#fff;" href="/create-listing" class="btn_1 rounded">Add Listing</a>
                                    @else
                                    <a style="text-decoration: none; color:#fff;" href="#" data-toggle="modal" data-target="#loginModal" class="btn_1 rounded">Add Listing</a>
                                    @endif
								</p>
                            </div>
                            <!--/ End Welcome Text -->
                            <!-- Search Form -->
                            <div class="trip-search 3s">
                                <form class="form" method="GET" action="/all-listings">
                                     <!-- Form Lookin for -->
                                     <div class="form-group looking">
                                        <div class="first-select wide">
                                            <div class="main-search-input-item">
                                                <input type="text" placeholder="Which Car are you looking for?" name="car" value="" />
                                            </div>
                                        </div>
                                    </div>
                                    <!--/ End Form Lookin for -->
                                    <!-- Form Lookin for -->
                                    <div class="form-group looking">
                                        <div class="first-select wide">
                                            <div class="main-search-input-item">
                                                <input type="text" placeholder="Location" name="location" value="" />
                                            </div>
                                        </div>
                                    </div>
                                    <!--/ End Form Lookin for -->
                                    
                                  
                                    <!-- Form Button -->
                                    <div class="form-group button">
                                        <button type="submit" class="btn">Search</button>
                                    </div>
                                    <!--/ End Form Button -->
                                </form>
                            </div>
                            <!--/ End Search Form -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END HEADER SEARCH -->


    <!-- START SECTION POPULAR LISTINGS -->
    <section class="popular portfolio freelancers">
        <div class="container">
            <div class="sec-title">
                <h2><span>Popular </span>Listings</h2>
                <p>What are you interested.</p>
            </div>
            <div class="portfolio col-xl-12">
                <div class="slick-lancers">
                @foreach($listings as $listingsnew)
                <div class="item col-lg-4 col-md-6 col-xs-12 landscapes sale">
                    <div class="project-single">
                        <div class="project-inner project-head">
                            <div class="homes">
                                <!-- homes img -->
                                <a href="/listing/{{$listingsnew->id}}" class="homes-img hover-effect">
                                    <div class="homes-tag button alt featured">{{$listingsnew->vehicle_name}}</div>
                                    
                                    <div class="W-100" style="width: 100% ; height: 200px">
                                    <img src="/images/car_images/{{$listingsnew->main_image}}" alt="{{$listingsnew->vehicle_name}}" class="img-responsive" ></div>
                                    <div class="overlay"  ></div>
                                </a>
                            </div>
                        </div>
                        <!-- homes content -->
                        <div class="homes-content">
                            <!-- homes address -->F
                            <a href="/listing/{{$listingsnew->id}}"><h3>{{$listingsnew->vehicle_name}}</h3></a>
                            <p class="homes-address">
                                <a href="/listing/{{$listingsnew->id}}">
                                    <i class="fa fa-rupee"></i><span>{{$listingsnew->price}}</span> &nbsp;
                                    <i class="fa fa-map-marker"></i><span>{{$listingsnew->location}}</span>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
                    
                </div>
            </div>
        </div>
        <div class="bg-all">
            <a href="/all-listings" class="btn btn-outline-light">View All</a>
        </div>
    </section>
    <!-- END SECTION POPULAR LISTINGS -->

    <!-- START SECTION HOW IT WORKS -->
    <section class="how-it-works">
        <div class="container">
            <div class="sec-title">
                <h2><span>How </span>It Works</h2>
                <p>There are many variations to get a better one</p>
            </div>
            <div class="row service-1">
                <article class="col-lg-4 col-md-6 col-xs-12 serv">
                    <div class="serv-flex">
                        <div class="art-1 img-1">
                            <img src="/webapp-assets/images/map.png" alt="">
                            <h3>Find Good Places</h3>
                        </div>
                        <div class="service-text-p">
                            <p class="text-center">When you leave a beautiful place, you carry it with you wherever you go. I fell in Love with Nepal, Its beautiful Place.</p>
                        </div>
                    </div>
                </article>
                <article class="col-lg-4 col-md-6 col-xs-12 serv">
                    <div class="serv-flex">
                        <div class="art-1 img-2">
                            <img src="/webapp-assets/images/contact.png" alt="">
                            <h3>Contact The Owner</h3>
                        </div>
                        <div class="service-text-p">
                            <p class="text-center">Don't Hegitate to Bargain, He is just a seller and Its your Money</p>
                        </div>
                    </div>
                </article>
                <article class="col-lg-4 col-md-6 col-xs-12 serv mb-0 pt">
                    <div class="serv-flex arrow">
                        <div class="art-1 img-3">
                            <img src="/webapp-assets/images/user.png" alt="">
                            <h3>Make a Reservation</h3>
                        </div>
                        <div class="service-text-p">
                            <p class="text-center">This Feature is not available yet. We will update you soon .</p>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>
    <!-- END SECTION HOW IT WORKS -->


    
    <!-- START SECTION TESTIMONIALS -->
    <section class="testimonials">
        <div class="container">
            <div class="sec-title">
                <h2><span>People </span>Says</h2>
                <p>There are many variations of lorem of Lorem.</p>
            </div>
            <div class="owl-carousel style1">
                <div class="test-1">
                    <p class="mb-3">The second-hand car demand is very high and we see people wanting to buy a second hand car. It comes at the back of two or three things. One, there is a delay in availability of the new vehicles and so if people want a car, they may prefer to go for a second hand car.</p>
                    <img src="/webapp-assets/images/testimonials/ts-1.jpg" alt="">
                    <h3 class="mt-3">Lisa Smith</h3>
                    <h6>New York</h6>
                    <ul class="starts text-center">
                        <li><i class="fa fa-star"></i>
                        </li>
                        <li><i class="fa fa-star"></i>
                        </li>
                        <li><i class="fa fa-star"></i>
                        </li>
                        <li><i class="fa fa-star"></i>
                        </li>
                        <li><i class="fa fa-star"></i>
                        </li>
                    </ul>
                </div>
                <div class="test-1">
                    <p class="mb-3">For some of the segments, the new car price is very high and if the use is very limited, may be they are looking at pre-owned vehicles. The demand is definitely high and the supply is very weak probably because the last whole year, the financials reprocessed not many vehicles. Therefore they are not putting out too many vehicles to sell.</p>

                    <img src="/webapp-assets/images/testimonials/ts-2.jpg" alt="">
                    <h3 class="mt-3">Jhon Morris</h3>
                    <h6>Los Angeles</h6>
                    <ul class="starts text-center">
                        <li><i class="fa fa-star"></i>
                        </li>
                        <li><i class="fa fa-star"></i>
                        </li>
                        <li><i class="fa fa-star"></i>
                        </li>
                        <li><i class="fa fa-star"></i>
                        </li>
                        <li><i class="fa fa-star-o"></i>
                        </li>
                    </ul>
                </div>
                <div class="test-1">
                    <p class="mb-3">With the non-availability of new vehicles, the exchange programmes are going slow and therefore the supply has been impacted. Put these two together and we believe the demand will hold on and it is very high.</p>

                    <img src="/webapp-assets/images/testimonials/ts-3.jpg" alt="">
                    <h3 class="mt-3">Mary Deshaw</h3>
                    <h6>Chicago</h6>
                    <ul class="starts text-center">
                        <li><i class="fa fa-star"></i>
                        </li>
                        <li><i class="fa fa-star"></i>
                        </li>
                        <li><i class="fa fa-star"></i>
                        </li>
                        <li><i class="fa fa-star"></i>
                        </li>
                        <li><i class="fa fa-star"></i>
                        </li>
                    </ul>
                </div>
                <div class="test-1">
                    <p class="mb-3">The reason why pre-owned vehicles will do even better. If the cost is going up, the vehicle price will go up and people would probably think twice before investing in a new vehicle if a good second hand vehicle is available.</p>

                    <img src="/webapp-assets/images/testimonials/ts-4.jpg" alt="">
                    <h3 class="mt-3">Gary Steven</h3>
                    <h6>Philadelphia</h6>
                    <ul class="starts text-center">
                        <li><i class="fa fa-star"></i>
                        </li>
                        <li><i class="fa fa-star"></i>
                        </li>
                        <li><i class="fa fa-star"></i>
                        </li>
                        <li><i class="fa fa-star"></i>
                        </li>
                        <li><i class="fa fa-star-o"></i>
                        </li>
                    </ul>
                </div>
                <div class="test-1">
                    <p class="mb-3">Lorem ipsum dolor sit amet, ligula magna at etiam aliquip venenatis. Vitae sit felis donec, suscipit tortor et sapien donec.</p>
                    <img src="/webapp-assets/images/testimonials/ts-5.jpg" alt="">
                    <h3 class="mt-3">Cristy Mayer</h3>
                    <h6>San Francisco</h6>
                    <ul class="starts text-center">
                        <li><i class="fa fa-star"></i>
                        </li>
                        <li><i class="fa fa-star"></i>
                        </li>
                        <li><i class="fa fa-star"></i>
                        </li>
                        <li><i class="fa fa-star"></i>
                        </li>
                        <li><i class="fa fa-star"></i>
                        </li>
                    </ul>
                </div>
                <div class="test-1">
                    <p class="mb-3">This website is amazing to buy the used car because They are genuine and legal as well service is veru good.</p>
                    <img src="/webapp-assets/images/testimonials/ts-6.jpg" alt="">
                    <h3 class="mt-3">Ichiro Tasaka</h3>
                    <h6>Houston</h6>
                    <ul class="starts text-center">
                        <li><i class="fa fa-star"></i>
                        </li>
                        <li><i class="fa fa-star"></i>
                        </li>
                        <li><i class="fa fa-star"></i>
                        </li>
                        <li><i class="fa fa-star"></i>
                        </li>
                        <li><i class="fa fa-star-o"></i>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- END SECTION TESTIMONIALS -->

    
         @include('webapp.layout.footer')

<script>
   $("#sourcelist li").click(function(){
      $("#source").val($(this).attr("value"));
   });
   $("#destinationlist li").click(function(){
      $("#destination").val($(this).attr("value"));
   });
   $("#vehicletypelist li").click(function(){
      $("#vehicle_type").val($(this).attr("value"));
   });
@if(!isset($_SESSION['userid']))
	$(window).on('load', function() {
        $('#loginModal').modal('show');
    });
	@endif
</script>