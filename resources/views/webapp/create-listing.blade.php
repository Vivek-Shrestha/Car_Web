@include('webapp.layout.header')

<section class="headings">
        <div class="text-heading text-center">
            <div class="container">
                <h1>Create Car Listing</h1>
                <h2><a href="/">Home </a> &nbsp;/&nbsp; Create Car Listing</h2>
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
					   <div class="my-address pro">
						<h3 class="heading">Create Car Listing</h3>
                            @if(session()->has('message'))
                            <div class="alert alert-success m-auto text-center alert-dismissible">
                                <strong>Success!! </strong> {{ session()->get('message') }}
                                <button type="button" class="close mt-0" data-dismiss="alert">&times;</button>
                            </div>
                        @endif
                  
						<form method="POST" action="/savelisting" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="user_id" value="{{$data->id}}">
							<div class="row">
                           
                            <div class="col-md-12">
                                <div class="form-group">
                                <label>Car Name<span class="text-danger">*</span></label>
                                <input class="form-control"  placeholder="Enter Car Name" type="text" name="vehicle_name" required>
                                </div> 
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                <label>Vehicle Number<span class="text-danger">*</span></label>
                                <input class="form-control" pattern="[a-zA-Z ]+[0-9 ]+[a-zA-Z ]+[0-9]+" placeholder="BA 2 Kha 1234" type="text" name="vehicle_number" required>                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                <label>Engine Number<span class="text-danger">*</span></label>
                                <input class="form-control" pattern="[0-9]+[a-zA-Z]+[0-9]+" placeholder="52WZC12345" type="text" name="engine_number" required>                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                <label>Vehicle Colour<span class="text-danger">*</span></label>
                                <input class="form-control" placeholder="Enter Car Number" type="text" name="vehicle_colour" required>                                </div>
                            </div>
                            

                            
                            <div class="col-md-6">
                                <div class="form-group">
                                <label>Price<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" placeholder="Enter Price" name="price" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                <label>Main Image<span class="text-danger">*</span></label>
                                <input class="form-control" type="file" name="main_image" accept="image/*" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label>Blubook Image<span class="text-danger">*</span></label>
                                <input class="form-control" type="file" name="bluebook_image" accept="image/*" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                <label>Other Images</label>
                                <input class="form-control" type="file" accept="image/*" name="other_images[]"   multiple>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                <label>Location<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" placeholder="Enter Location" name="location" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                <label>Description<span class="text-danger">*</span></label>
                                <textarea class="form-control" type="text" rows="5" placeholder="Enter Description" name="description" required></textarea>
                                </div>
                            </div>

                           
								<div class="col-lg-12">
									<div class="send-btn text-center">
										<button type="submit" class="btn btn-primary btn-lg">Submit</button>
									</div>
								</div>
							</div>
						</form>
                      
                    
                        
					</div>
				</div>
            </div>
        </div>
    </section>
    <!-- END SECTION DASHBOARD -->

@include('webapp.layout.footer')

<script>
 function isNumber(evt) {
     evt = (evt) ? evt : window.event;
     var charCode = (evt.which) ? evt.which : evt.keyCode;
     if (charCode > 31 && (charCode < 48 || charCode > 57)) {
       return false;
     }
     return true;
   }

</script>