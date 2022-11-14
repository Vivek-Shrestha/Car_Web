@include('webapp.layout.header')

<section class="headings">
        <div class="text-heading text-center">
            <div class="container">
                <h1>My Listings</h1>
                <h2><a href="/">Home </a> &nbsp;/&nbsp; My Listings</h2>
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
                <div class="section-body listing-table">
<div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Vehicle Name</th>
                                                    <th>Price</th>
                                                    <th>Location</th>
                                                    <th>Description</th>
                                                    <th>Main Images</th>
                                            <th></th>
                                            </tr>
                                    </thead>
                                    <tbody>
                                    @php $x=1; @endphp
                                    @foreach($listings as $listingsnew)
                                        <tr>
                              <td>{{$x++}}</td>
                              <td>{{$listingsnew->vehicle_name}}</td>
                             
                              <td>{{$listingsnew->price}}</td>
                              <td>{{$listingsnew->location}}</td>
                              
                              <td>{{$listingsnew->description}}</td>
                              <td><a href="/images/car_images/{{$listingsnew->main_image}}" target="_blank"><img src="/images/car_images/{{$listingsnew->main_image}}" height="55" width="60"></a></td>
                             

                              <td class="actions">
                              <a class="" href="/edit-listing/{{$listingsnew->id}}"> <i class="fa fa-edit"></i></a>
                              <!-- @if($listingsnew->username!='') 
                               
                                Sold to {{$listingsnew->username}} 
                               
                               @endif -->
                      <!-- @if($listingsnew->status=='0') 
                            <div class="btn-group mr-2 mb-2" data-toggle="tooltip" data-animation="false" data-original-title="Change Status">
                                <span aria-expanded="false" aria-haspopup="true" class="btn btn-danger btn-sm lighten dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" id="dropdownMenuButton4">Close</span>

                               

                                <div style="padding: 0;min-width: 60px;margin: 0;" aria-labelledby="dropdownMenuButton4" class="dropdown-menu">
                                    <a class="btn btn-success btn-sm lighten dropdown-item"   onclick="active_modal('/listingactivestatus/{{$listingsnew->id}}');" href="#"> Open</a>
                                </div>
                            </div>
                            
                            @else
                            <div class="btn-group mr-2 mb-2" data-toggle="tooltip" data-animation="false" data-original-title="Change Status">
                                <span aria-expanded="false" aria-haspopup="true" class="btn btn-success btn-sm lighten dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" id="dropdownMenuButton4">Open</span>

                                <div style="padding: 0;min-width: 60px;margin: 0;" aria-labelledby="dropdownMenuButton4" class="dropdown-menu">
                                    <a class="btn btn-danger btn-sm lighten dropdown-item" onclick="inactive_modal('/listinginactivestatus/{{$listingsnew->id}}');" href="#"> Close</a>
                                </div>
                            </div>
                            @endif -->
                              </td>
                              </tr>
                                  @endforeach
                                    </tbody>
                                </table>
                                
                            </div>
                             </div>
						
						
					
				</div>
            </div>
        </div>
    </section>
    <!-- END SECTION DASHBOARD -->


     <!-- Info delete Modal -->
<div id="listingdelete-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body p-4">
                <div class="text-center">
                    <i class="dripicons-information h1 text-info"></i>
                    <h4 class="mt-2">Delete Listing!</h4>
                    <p class="mt-3">Are you sure?</p>
                    <button type="button" class="btn btn-warning my-2" data-dismiss="modal">Cancel</button>
                    <a href="#" id="update_listing_link" class="btn btn-danger my-2">Continue</a>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Info Alert Modal -->
<div id="activealert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body p-4">
                <div class="text-center">
                    <i class="dripicons-information h1 text-info"></i>
                    <h4 class="mt-2">Open Listing!</h4>
                    <p class="mt-3">Are you sure?</p>
                    <button type="button" class="btn btn-warning my-2" data-dismiss="modal">Cancel</button>
                    <a href="#" id="activeupdate_link" class="btn btn-danger my-2">Continue</a>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Info Alert Modal -->
<div id="inactivealert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body p-4">
                <div class="text-center">
                    <i class="dripicons-information h1 text-info"></i>
                    <h4 class="mt-2">Close Listing!</h4>
                    <p class="mt-3">Are you sure?</p>
                    <button type="button" class="btn btn-warning my-2" data-dismiss="modal">Cancel</button>
                    <a href="#" id="inactiveupdate_link" class="btn btn-danger my-2">Continue</a>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


@include('webapp.layout.footer')

<script>
      $(document).ready(function() {
         var table = $('#example').DataTable( {
            responsive: true
         } );
      
         new $.fn.dataTable.FixedHeader( table );
      } );

      function confirm_listingdelete_modal(delete_url)
        {
            jQuery('#listingdelete-alert-modal').modal('show', {backdrop: 'static'});
            document.getElementById('update_listing_link').setAttribute('href' , delete_url);
        }
        function active_modal(delete_url)
    {
        jQuery('#activealert-modal').modal('show', {backdrop: 'static'});
        document.getElementById('activeupdate_link').setAttribute('href' , delete_url);
    }
    function inactive_modal(delete_url)
    {
        jQuery('#inactivealert-modal').modal('show', {backdrop: 'static'});
        document.getElementById('inactiveupdate_link').setAttribute('href' , delete_url);
    }
   </script>