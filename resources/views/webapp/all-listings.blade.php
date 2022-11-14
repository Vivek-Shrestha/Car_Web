@include('webapp.layout.header')

<section class="headings">
        <div class="text-heading text-center">
            <div class="container">
                <h1>All Car Listings</h1>
                <h2><a href="/">Home </a> &nbsp;/&nbsp; All Car Listings</h2>
            </div>
        </div>
    </section>
    <!-- END SECTION HEADINGS -->

    <!-- START SECTION LISTINGs GRID -->
	<section class="listings-full-grid featured popular portfolio blog">
		<div class="container">
			<!-- Block heading Start-->
			<div class="block-heading">
				<div class="row">
					<div class="col-lg-6 col-md-5 col-2">
						<h4>
                            <span class="heading-icon">
                                <i class="fa fa-th-list"></i>
                                </span>
                                <span class="hidden-sm-down">Car Listings</span>
                            </h4>
					</div>
					<div class="col-lg-6 col-md-7 col-10 cod-pad mt-22">
						<div class="sorting-options">
							<form method="GET" action="/all-listings">
							<input type="text" name="car" Placeholder="Car Name" @if(isset($_GET['car']) ) value="{{$_GET['car']}}" @endif>
							<input type="text" name="location" Placeholder="Location" @if(isset($_GET['location']) ) value="{{$_GET['location']}}" @endif>
							<button type="submit" class="btn btn-primary ">Search</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- Block heading end -->
			<div class="row featured portfolio-items">
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
							<!-- homes address -->
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
			<!-- <nav aria-label="..." class="pt-2">
				<ul class="pagination mt-0">
					<li class="page-item disabled">
						<a class="page-link" href="#" tabindex="-1">Previous</a>
					</li>
					<li class="page-item active">
						<a class="page-link" href="#">1 <span class="sr-only">(current)</span></a>
					</li>
					<li class="page-item"><a class="page-link" href="#">2</a></li>
					<li class="page-item"><a class="page-link" href="#">3</a></li>
					<li class="page-item"><a class="page-link" href="#">3</a></li>
					<li class="page-item"><a class="page-link" href="#">5</a></li>
					<li class="page-item">
						<a class="page-link" href="#">Next</a>
					</li>
				</ul>
			</nav> -->
		</div>
	</section>
	<!-- END SECTION LISTINGs GRID -->
    

@include('webapp.layout.footer')
