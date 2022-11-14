 @include('admin.layout.header')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
             
            <h1>Add Car Listing</h1>
            
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
                
                <li class="breadcrumb-item active">Add Car Listing</li>
               
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <!-- <h3 class="card-title">Select2 (Default Theme)</h3>
 -->
  @if(session()->has('error'))
                                                    <div class="alert alert-danger m-auto text-center alert-dismissible">
                                                            <strong>Error!! </strong> {{ session()->get('error') }}
                                                            <button type="button" class="close mt-0" data-dismiss="alert">&times;</button>
                                                        </div>
                                                    @endif
  @if(session()->has('message'))
                                                    <div class="alert alert-success m-auto text-center alert-dismissible">
                                                            <strong>Success!! </strong> {{ session()->get('message') }}
                                                            <button type="button" class="close mt-0" data-dismiss="alert">&times;</button>
                                                        </div>
                                                    @endif
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
           <form method="POST" action="/admin/savelisting" enctype="multipart/form-data">
                {{ csrf_field() }}
          <div class="card-body">
            <div class="row">
            <input type="hidden" name="user_id" value="{{$_SESSION['adminid']}}">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Car Name<span class="text-danger">*</span></label>
                  <input class="form-control" placeholder="Enter Car Name" type="text" name="vehicle_name" required>
                </div> 
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
                  <label>Other Images</label>
                  <input class="form-control" type="file" accept="image/*" name="other_images[]" multiple>
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
              
              <button style="margin: 0 auto;" type="submit" class="btn btn-primary">Add Car Listing</button>
              <!-- /.col -->

            </div>
            <!-- /.row -->

            <!-- /.row -->
          </div>
         
        </div>
        <!-- /.card -->
        </form>
        
        
       
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  
   @include('admin.layout.footer')

   <script>
     $(document).on('click', '.toggle-password', function() {
  
  $(this).toggleClass("fa-eye fa-eye-slash");

  var input = $(".pass_log_id");
  input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
});

   //Date picker
   $('#reservationdate').datetimepicker({
       format: 'DD/MM/YYYY'
   });

    //Date and time picker
    $('#reservationdatetime').datetimepicker({ 
       icons: { time: 'far fa-clock' } ,
       format:'DD/MM/YYYY HH:mm:A',
   });

   $('input[type=radio][name=duration]').change(function() {
            if (this.value != 'Daily') {
            $("#reservationdatetime").show();
            }else{
            $("#reservationdatetime").hide();
            }
        });


  </script>