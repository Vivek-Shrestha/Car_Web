 @include('admin.layout.header')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Car Listing</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class=""><a class="btn btn-primary" href="/admin/addlisting">Add New Car Listing</a> &nbsp;&nbsp;</li>
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Car Listing</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
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

            <div class="card">
              <!--<div class="card-header">-->
              <!--  <h3 class="card-title">DataTable with default features</h3>-->
              <!--</div>-->
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                          <th>#</th>
                           <th>Vehicle Name</th>
                           <th>Vehicle Number</th>
                           <th>Price</th>
                           <th>Location</th>
                           <th>Description</th>
                           <th>Main Images</th>
                           <th>BlueBook Image</th>
                          
                           <th class="all">Action</th>
                  </tr>
                  </thead>

                  <tbody>
                    @php $x=1; @endphp
                  @foreach($listings as $listingsnew)
                  <tr>
                              <td>{{$x++}}</td>
                              <td>{{$listingsnew->vehicle_name}}</td>
                              <td>{{$listingsnew->vehicle_number}}</td>
                             
                              <td>{{$listingsnew->price}}</td>
                              <td>{{$listingsnew->location}}</td>
                              <td>{{$listingsnew->description}}</td>
                              <td><a href="/images/car_images/{{$listingsnew->main_image}}" target="_blank"><img src="/images/car_images/{{$listingsnew->main_image}}" height="55" width="60"></a></td>
                            
                              <td><a href="/images/car_images/{{$listingsnew->bluebook_image}}" target="_blank"><img src="/images/car_images/{{$listingsnew->bluebook_image}}" height="55" width="60"></a></td>
        
                    <td>
                             
                             
                           
                      <a class="btn btn-warning btn-sm" href="/admin/editlisting/{{$listingsnew->id}}"><i class="fa fa-edit"></i></a>
                      <a class="btn btn-danger btn-sm" href="#" onclick="confirm_listingdelete_modal('/admin/deletelisting/{{$listingsnew->id}}');"><i class="fa fa-trash"></i></a>
                      
                      @if($listingsnew->status=='0') 
                            <div class="btn-group mr-2 mb-2" data-toggle="tooltip" data-animation="false" data-original-title="Change Status">
                                <span aria-expanded="false" aria-haspopup="true" class="btn btn-danger btn-sm lighten dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" id="dropdownMenuButton4">Close</span>

                                <div style="padding: 0;min-width: 60px;margin: 0;" aria-labelledby="dropdownMenuButton4" class="dropdown-menu">
                                    <a class="btn btn-success btn-sm lighten dropdown-item" onclick="listingopen_modal('/admin/listingactivestatus/{{$listingsnew->id}}');" href="#"> Open</a>
                                </div>
                            </div>
                            @if($listingsnew->username!='') 
                               
                               <br>  Sold 
                         
                               @endif
                            @else
                            <div class="btn-group mr-2 mb-2" data-toggle="tooltip" data-animation="false" data-original-title="Change Status">
                                <span aria-expanded="false" aria-haspopup="true" class="btn btn-success btn-sm lighten dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" id="dropdownMenuButton4">Open</span>

                                <div style="padding: 0;min-width: 60px;margin: 0;" aria-labelledby="dropdownMenuButton4" class="dropdown-menu">
                                    <a class="btn btn-danger btn-sm lighten dropdown-item" onclick="listingclose_modal('/admin/listinginactivestatus/{{$listingsnew->id}}');" href="#"> Close</a>
                                </div>
                            </div>
                            @endif
                            
                    </td>
                  </tr>
                  @endforeach
                  </tbody>

                 <!--  <tfoot>
                  <tr>
                  <th>#</th>
                  <th>Vehicle Name</th>
                  <th>Vehicle Number</th>

                           <th>Price</th>
                           <th>Description</th>
                           <th>Main Images</th>
                          
                           <th class="all">Action</th>
                  </tr>
                  </tfoot> -->

                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  
<!-- Info delete Modal -->
<div id="listingdelete-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body p-4">
                <div class="text-center">
                    <i class="dripicons-information h1 text-info"></i>
                    <h4 class="mt-2">Delete Listing!</h4>
                    <p class="mt-3">Are you sure?</p>
                    <button type="button" class="btn btn-info my-2" data-dismiss="modal">Cancel</button>
                    <a href="#" id="update_member_link" class="btn btn-danger my-2">Continue</a>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- Info Alert Modal -->
<div id="listingopenalert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body p-4">
                <div class="text-center">
                    <i class="dripicons-information h1 text-info"></i>
                    <h4 class="mt-2">Open Listing!</h4>
                    <p class="mt-3">Are you sure?</p>
                    <button type="button" class="btn btn-info my-2" data-dismiss="modal">Cancel</button>
                    <a href="#" id="listingopenupdate_link" class="btn btn-danger my-2">Continue</a>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Info Alert Modal -->
<div id="listingclosealert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body p-4">
                <div class="text-center">
                    <i class="dripicons-information h1 text-info"></i>
                    <h4 class="mt-2">Close Listing!</h4>
                    <p class="mt-3">Are you sure?</p>
                    <button type="button" class="btn btn-info my-2" data-dismiss="modal">Cancel</button>
                    <a href="#" id="listingcloseupdate_link" class="btn btn-danger my-2">Continue</a>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

   @include('admin.layout.footer')

   <script>
       function confirm_listingdelete_modal(delete_url)
        {
            jQuery('#listingdelete-alert-modal').modal('show', {backdrop: 'static'});
            document.getElementById('update_member_link').setAttribute('href' , delete_url);
        }
        function listingopen_modal(delete_url)
        {
            jQuery('#listingopenalert-modal').modal('show', {backdrop: 'static'});
            document.getElementById('listingopenupdate_link').setAttribute('href' , delete_url);
        }
        function listingclose_modal(delete_url)
        {
            jQuery('#listingclosealert-modal').modal('show', {backdrop: 'static'});
            document.getElementById('listingcloseupdate_link').setAttribute('href' , delete_url);
        }
  </script>