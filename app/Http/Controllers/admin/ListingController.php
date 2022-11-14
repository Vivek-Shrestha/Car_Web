<?php

namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use DB;
use App\User;
use App\Listing;
use App\Carotherimage;
use App\Notification;
use Mail;

class ListingController extends Controller
{
    function __construct() {
        $this->validate_session();
    }
    public function addlisting()
    {
        return view('admin.addlisting');
    }

    public function listings()
    {
        $listings=DB::table('listings')
        ->leftjoin('users', 'users.id','=','listings.user_id')
        ->select('listings.*', 'users.name as username', 'users.user_photo as userphoto', 'users.email as useremail')
        ->orderBy('listings.id','DESC')->get();
        return view('admin.listings',compact('listings'));
    }
    public function editlisting($id)
    {
        $listing=DB::table('listings')
        ->leftjoin('users', 'users.id','=','listings.user_id')
        ->select('listings.*', 'users.name as username', 'users.user_photo as userphoto', 'users.email as useremail')
        ->where('listings.id',$id)->first();
        $otherimages=Carotherimage::where('listing_id',$id)->get();
        return view('admin.editlisting',compact('listing','otherimages'));
    }
    public function savelisting(Request $request)
    {
            $data= new Listing();
            $data->user_id = $request->user_id;
            $data->vehicle_name = $request->vehicle_name;
            $data->vehicle_name = $request->vehicle_number;
            $data->price = $request->price;
            $data->location = $request->location;
            $data->description = $request->description;
            $data->status = '1';
            if($request->hasfile('main_image'))
             {
                $name = strtolower($request->vehicle_name);
                $file = $request->file('main_image');
                $extension = $file->getClientOriginalExtension(); // getting logo extension
                $filename =$name.'.'.time().'.'.$extension;
                $filename =  preg_replace('/[^A-Za-z0-9. ]/', '', $filename);
                $path=$file->move('images/car_images/', $filename);
                $data->main_image = $filename;
             }
            $data->save();

            $targetDir = "images/other_images/";
                $allowTypes = array('jpg','png','jpeg','svg');
                $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
            if(isset($_FILES['other_images']['name'])){
                if(!empty(array_filter($_FILES['other_images']['name']))){
                    $other_images1='';
                    $no=1;
                foreach($_FILES['other_images']['name'] as $key=>$val){
                    // File upload path
                    $vehicle_name = preg_replace('/[^A-Za-z0-9. ]/', '', $request->vehicle_name);
                    $fileName = preg_replace("/[^a-z0-9\_\-\.]/i", '', basename($vehicle_name.time().'-'.$no++.$_FILES['other_images']['name'][$key]));

                            $addotherimage=new Carotherimage();
                            $addotherimage->image=$targetDir . $fileName;
                            $addotherimage->listing_id=$data->id;
                            $addotherimage->save();  

                    $targetFilePath = $targetDir . $fileName;
                    
                    // Check whether file type is valid
                    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                    if(in_array($fileType, $allowTypes)){
                        // Upload file to server
                        if(move_uploaded_file($_FILES["other_images"]["tmp_name"][$key], $targetFilePath)){
                            // Image db insert sql
                            $insertValuesSQL .= $fileName.",";
                        }else{
                            // $errorUpload .= $_FILES['other_images']['name'][$key].', ';
                            
                        }
                    }else{
                        $errorUploadType .= $_FILES['other_images']['name'][$key].', ';
                    }
                }
            
                }
            }
            return back()->with('message', 'Car Listing Added Successfully!');
        
    }
    public function updatelisting(Request $request,$id)
    {
            $data= Listing::find($id);
            $data->user_id = $request->user_id;
            $data->vehicle_name = $request->vehicle_name;
            $data->price = $request->price;
            $data->location = $request->location;
            $data->description = $request->description;
            $data->status = '1';
            if($request->hasfile('main_image'))
             {
                $name = strtolower($request->vehicle_name);
                $file = $request->file('main_image');
                $extension = $file->getClientOriginalExtension(); // getting logo extension
                $filename =$name.'.'.time().'.'.$extension;
                $filename =  preg_replace('/[^A-Za-z0-9. ]/', '', $filename);
                $path=$file->move('images/car_images/', $filename);
                $data->main_image = $filename;
             }
            $data->save();

            $targetDir = "images/other_images/";
                $allowTypes = array('jpg','png','jpeg','svg');
                $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
            if(isset($_FILES['other_images']['name'])){
                if(!empty(array_filter($_FILES['other_images']['name']))){
                    $other_images1='';
                    $no=1;

                    $carotherimages= Carotherimage::where('listing_id',$id)->get();
                    if(count($carotherimages)>0){
                        foreach($carotherimages as $carotherimagesnew){
                            $deleteoldproduct= Carotherimage::find($carotherimagesnew->id);
                            $deleteoldproduct->delete();
                            @unlink('images/other_images/'.$deleteoldproduct->image);
                        }
                    }
                foreach($_FILES['other_images']['name'] as $key=>$val){
                    // File upload path
                    $vehicle_name = preg_replace('/[^A-Za-z0-9. ]/', '', $request->vehicle_name);
                    $fileName = preg_replace("/[^a-z0-9\_\-\.]/i", '', basename($vehicle_name.time().'-'.$no++.$_FILES['other_images']['name'][$key]));

                            $addotherimage=new Carotherimage();
                            $addotherimage->image=$targetDir . $fileName;
                            $addotherimage->listing_id=$data->id;
                            $addotherimage->save();  

                    $targetFilePath = $targetDir . $fileName;
                    
                    // Check whether file type is valid
                    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
                    if(in_array($fileType, $allowTypes)){
                        // Upload file to server
                        if(move_uploaded_file($_FILES["other_images"]["tmp_name"][$key], $targetFilePath)){
                            // Image db insert sql
                            $insertValuesSQL .= $fileName.",";
                        }else{
                            // $errorUpload .= $_FILES['other_images']['name'][$key].', ';
                            
                        }
                    }else{
                        $errorUploadType .= $_FILES['other_images']['name'][$key].', ';
                    }
                }
            
                }
            }
           
            return back()->with('message', 'Car Listing Updated Successfully!');
        
    }
    public function listingactivestatus($id)
        {
            $data = Listing::find($id);
            $data->status = '1';
            $data->save();

            $msg="You might like this car.please check out.";
            $users= User::where('id','!=',$data->user_id)->where('role','user')->get();
            if(count($users)){
                foreach($users as $usersnew){
                    $notification=new Notification();
                    $notification->to_id=$usersnew->id;
                    $notification->notification=$msg;
                    $url='/listing/'.$data->id;
                    $notification->url=$url;
                    $notification->save();

                    $data1 = array('msg'=>"msg",'url'=>"$url");

                    // Mail::send('webapp.notification-mail',$data1, function($message) use($usersnew){
                    //     $message->to($usersnew->email)->subject
                    //         ('Car Recommendation');
                    //     $message->from('phpproject003@gmail.com');
                    // });
                }
            }

            
            return back()->with('message', 'Car Listing Opened successfully!');
        }
   public function listinginactivestatus($id)
        {
            $data = Listing::find($id);
            $data->status = '0';
            $data->save();
            return back()->with('message', 'Car Listing Closed successfully!');
        }
        public function deletelisting($id){
            $data= Listing::find($id);
            $data->delete();
            return back()->with('message', 'Car Listing Deleted successfully!');
        }
}
