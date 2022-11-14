@include('webapp.layout.header')

<section class="headings">
        <div class="text-heading text-center">
            <div class="container">
                <h1>My Messages</h1>
                <h2><a href="/">Home </a> &nbsp;/&nbsp; My Messages</h2>
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
                @if(session()->has('message'))
                  <div class="alert alert-success m-auto text-center alert-dismissible">
                        <strong>Success!! </strong> {{ session()->get('message') }}
                          <button type="button" class="close mt-0" data-dismiss="alert">&times;</button>
                  </div>
                @endif
                @if(session()->has('error'))
                  <div class="alert alert-danger m-auto text-center alert-dismissible">
                        <strong>Error!! </strong> {{ session()->get('message') }}
                          <button type="button" class="close mt-0" data-dismiss="alert">&times;</button>
                  </div>
                @endif
                <div class="section-body listing-table">

                <section class="comments">
						<h3 class="mb-5">Messages to {{$touser->name}} 

                       <!--  <form action="https://uat.esewa.com.np/epay/main" method="POST">
                            <input value="100" name="tAmt" type="hidden">
                            <input value="90" name="amt" type="hidden">
                            <input value="5" name="txAmt" type="hidden">
                            <input value="2" name="psc" type="hidden">
                            <input value="{{$listing->id}}" name="listing_id" type="hidden">
                            <input value="{{$listing->price}}" name="price" type="hidden">
                            <input value="{{$touser->id}}" name="user_id" type="hidden">
                            <input value="3" name="pdc" type="hidden">
                            <input value="EPAYTEST" name="scd" type="hidden">
                            <input value="ee2c3ca1-696b-4cc5-a6be-2c40d929d453" name="pid" type="hidden">
                            <input value="http://merchant.com.np/page/esewa_payment_success?q=su" type="hidden" name="su">
                            <input value="http://merchant.com.np/page/esewa_payment_failed?q=fu" type="hidden" name="fu">
                            <input class="btn btn-primary btn-sm" value="Make {{$listing->price}} Payment" type="submit">
                        </form> -->
                            
                           
                        
                        </h3>
                        <h4 class="mb-5">Car- {{$listing->vehicle_name}} </h4>
                        <form method="POST" action="/sendmessage">
                            {{ csrf_field() }}
                        <div class="input-group mb-5">
                            
                                <input type="hidden" name="from_id" value="{{$data->id}}">
                                <input type="hidden" name="from_name" value="{{$data->name}}">
                                <input type="hidden" name="to_id" value="{{$touser->id}}">
                                <input type="hidden" name="to_name" value="{{$touser->name}}">
                                <input type="hidden" name="listing_id" value="{{$listing->id}}">
                                <input type="text" name="message" class="form-control" placeholder="Enter Message...">
                                <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit">Send</button>
                            
                            </span>
						</div>
                        </form>
                        @foreach($messages as $messagesnew)
                                                       
                       
                    <div class="row mb-4">  
                       
						<div class="row mb-4">
							<ul class="col-12 commented">
								<li class="comm-inf">
									
									<div class="col-md-10 comments-info">
										<h5 class="mb-1">{{$messagesnew->from_name}}</h5>
										<p class="mb-4">{{$messagesnew->created_at}}</p>
										<p>{{$messagesnew->message}}</p>
									</div>
								</li>

							</ul>
						</div>
                        <hr>
                        @endforeach
						
					</section>

                </div>
						
						
					
				</div>
            </div>
        </div>
    </section>
    <!-- END SECTION DASHBOARD -->

    <!-- Info delete Modal -->
<div id="sold-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body p-4">
                <div class="text-center">
                    <i class="dripicons-information h1 text-info"></i>
                    <h4 class="mt-2">Car Sold!</h4>
                    <p class="mt-3">Are you sure?</p>
                    <button type="button" class="btn btn-info my-2" data-bs-dismiss="modal">Cancel</button>
                    <a href="#" id="update_sold" class="btn btn-danger my-2">Sold</a>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@include('webapp.layout.footer')
<script>
       function confirm_sold_modal(delete_url)
        {
            jQuery('#sold-alert-modal').modal('show', {backdrop: 'static'});
            document.getElementById('update_sold').setAttribute('href' , delete_url);
        }
  </script>