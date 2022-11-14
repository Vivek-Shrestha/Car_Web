@include('webapp.layout.header')

<section class="headings">
        <div class="text-heading text-center">
            <div class="container">
                <h1>Dashboard</h1>
                <h2><a href="/">Home </a> &nbsp;/&nbsp; Dashboard</h2>
            </div>
        </div>
    </section>
    <!-- END SECTION HEADINGS -->

    <!-- START SECTION DASHBOARD -->
    <section class="user-page section-padding">
        <div class="container">
            <div class="row">
            @include('webapp.layout.sidebar')
                <div class="col-lg-8 col-md-12 col-xs-12">
                    <div class="dashborad-box">
                        <h4 class="title">Manage Dashboard</h4>
                        <div class="section-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="item">
                                        <div class="icon">
                                            <i class="fa fa-list" aria-hidden="true"></i>
                                        </div>
                                        <div class="info">
                                            <h6 class="number">{{count($listings)}}</h6>
                                            <p class="type ml-1">Listing</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="item">
                                        <div class="icon">
                                            <i class="fa fa-heart" aria-hidden="true"></i>
                                        </div>
                                        <div class="info">
                                            <h6 class="number">{{count($faviourites)}}</h6>
                                            <p class="type ml-1">Faviourites</p>
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="col-sm-4">
                                    <div class="item">
                                        <div class="icon">
                                            <i class="fas fa-comments"></i>
                                        </div>
                                        <div class="info">
                                            
                                                 <h6 class="number">{{count($messages)}}</h6>
                                          
                                            <p class="type ml-1">Messages</p>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="dashborad-box">
                        <h4 class="title">Listing</h4>
                        <div class="section-body listing-table">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                        <th>Vehicle Name</th>
                                        <th>Vehicle Number</th>
                                        <th>Price</th>
                                        <th>Location</th>
                                        <th>Main Images</th>
                                        <th>Status</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php $x=1; @endphp
                                    @foreach($listings as $listingsnew)
                                        <tr>
                        
                                        <td>{{$listingsnew->vehicle_name}}</td>
                                        <td>{{$listingsnew->vehicle_number}}</td>
                                        <td>{{$listingsnew->price}}</td>
                                        <td>{{$listingsnew->location}}</td>
                                        <td><a href="/images/car_images/{{$listingsnew->main_image}}" target="_blank"><img src="/images/car_images/{{$listingsnew->main_image}}" height="55" width="60"></a></td>
                                        <td>@if($listingsnew->status=='1')
                                            <span class='text-success'>Open</span>
                                            @else
                                            <span class='text-danger'>Closed</span>
                                            @endif
                                        </td>
                                        
                                        </tr>
                                  @endforeach
                                    </tbody>
                                </table>
                                
                            </div>
                            <div class="dashborad-box mb-0">
                    @if(count($listings)>0)
                        <div class="section-inforamation text-center">
                            <a href="/my-listings" class="text-center">View All</a>
                        </div>
                    @else
                        <div class="section-inforamation text-center">
                            <a href="/create-listing" class="text-center"><i class="fa fa-plus"></i> Add Car Listing</a>
                        </div>
                    @endif 

                    </div>

                            
                        </div>
                        
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- END SECTION DASHBOARD -->

@include('webapp.layout.footer')

