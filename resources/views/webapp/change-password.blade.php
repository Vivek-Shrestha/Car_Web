@include('webapp.layout.header')

<section class="headings">
        <div class="text-heading text-center">
            <div class="container">
                <h1>My Profile</h1>
                <h2><a href="/">Home </a> &nbsp;/&nbsp; My Profile</h2>
            </div>
        </div>
    </section>
    <!-- END SECTION HEADINGS -->

    <!-- START SECTION DASHBOARD -->
    <section class="user-page section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-xs-12">
                    <div class="user-profile-box">
                        <div class="header clearfix">
                            <h2>{{$data->name}}</h2>
                            <h4>Active User</h4>
                            <img src="/webapp-assets/images/user-images/{{$data->user_photo}}" alt="avatar" class="img-fluid profile-img">
                        </div>
                        <div class="detail clearfix">
                            <ul>
                                <li>
                                    <a href="/dashboard">
                                        <i class="fa fa-home"></i> Dashboard
                                    </a>
                                </li>
                                <li>
                                    <a class="" href="#">
                                        <i class="fa fa-star"></i>Packages
                                    </a>
                                </li>
                                <li>
                                    <a href="/my-profile/{{$data->id}}">
                                        <i class="fa fa-user"></i>My Profile
                                    </a>
                                </li>
                                <li>
                                    <a href="/my-listings">
                                        <i class="fa fa-list" aria-hidden="true"></i>My Listings
                                    </a>
                                </li>
                                
                                <li>
                                    <a href="/create-listing">
                                        <i class="fa fa-list" aria-hidden="true"></i>Create New Listings
                                    </a>
                                </li>
                               <!--  <li>
                                    <a class="active" href="/change-password">
                                        <i class="fa fa-lock"></i>Change Password
                                    </a>
                                </li> -->
                                <li>
                                    <a href="/logout">
                                        <i class="fas fa-sign-out-alt"></i>Log Out
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-xs-12">
					   <div class="my-address pro">
						<h3 class="heading">Change Password</h3>
                        @if(session()->has('message'))
                            <div class="alert alert-success m-auto text-center alert-dismissible">
                                <strong>Success!! </strong> {{ session()->get('message') }}
                                <button type="button" class="close mt-0" data-dismiss="alert">&times;</button>
                            </div>
                        @endif
                        @if(session()->has('error'))
                            <div class="alert alert-danger m-auto text-center alert-dismissible">
                                <strong>Error!! </strong> {{ session()->get('error') }}
                                <button type="button" class="close mt-0" data-dismiss="alert">&times;</button>
                            </div>
                        @endif
						<form method="POST" action="/changeuserpassword" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="userid" value="{{$data->id}}">
							<div class="row">
								
                                <div class="col-lg-12">
									<div class="form-group">
										<label>New Password <span class="text-danger">*</span></label>
										<input type="password" name="password" id="password" class="form-control rounded-0" required>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="form-group">
										<label>Confirm Password <span class="text-danger">*</span></label>
										<input type="password" name="confirm_password" id="confirm_password" class="form-control rounded-0" required>
									</div>
								</div>
                        
								<div class="col-lg-12">
									<div class="send-btn text-center">
										<button type="submit" class="btn btn-primary btn-lg">Change Password</button>
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

   $('#date_time').datetimepicker({ format: 'D-MM-YYYY hh:mm:ss A' });
</script>