@include('webapp.layout.header')

<section class="headings">
        <div class="text-heading text-center">
            <div class="container">
                <h1>Faviourites</h1>
                <h2><a href="/">Home </a> &nbsp;/&nbsp; Faviourites</h2>
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
                <h3 class="heading">Faviourites</h3>
                @if(session()->has('message'))
                  <div class="alert alert-success m-auto text-center alert-dismissible">
                        <strong>Success!! </strong> {{ session()->get('message') }}
                          <button type="button" class="close mt-0" data-dismiss="alert">&times;</button>
                  </div>
                @endif
                <div class="section-body listing-table">
                    <div class="table-responsive my-properties">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                           
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            
                                            </tr>
                                    </thead>
                                    <tbody>
                                    @php $x=1; @endphp
                                    @foreach($listings as $listingsnew)
                            <tr>
                            
                              <td class="image myelist">
										<a href="/listing/{{$listingsnew->listing_id}}" target="_blank"><img src="/images/car_images/{{$listingsnew->main_image}}" height="100" width="150"></a>
								</td>
								<td>
										<div class="inner">
											<a href="/listing/{{$listingsnew->listing_id}}" target="_blank"><h2>{{$listingsnew->vehicle_name}}</h2></a>
											<figure><i class="fa fa-map-marker"></i> {{$listingsnew->location}}</figure>
                                            <figure><i class="fa fa-map-marker"></i> {{$listingsnew->price}}</figure>
											
										</div>
								</td>
                                <td class="actions">
										
										<a href="#" onclick="confirm_listingremove_modal('/listingremove/{{$listingsnew->id}}');"><i class="far fa-trash-alt"></i></a>
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
<div id="listingremove-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body p-4">
                <div class="text-center">
                    <i class="dripicons-information h1 text-info"></i>
                    <h4 class="mt-2">Remove from Faviourites!</h4>
                    <p class="mt-3">Are you sure?</p>
                    <button type="button" class="btn btn-warning my-2" data-bs-dismiss="modal">Cancel</button>
                    <a href="#" id="update_listing_link" class="btn btn-danger my-2">Continue</a>
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

      function confirm_listingremove_modal(delete_url)
        {
            jQuery('#listingremove-alert-modal').modal('show', {backdrop: 'static'});
            document.getElementById('update_listing_link').setAttribute('href' , delete_url);
        }
        
   </script>