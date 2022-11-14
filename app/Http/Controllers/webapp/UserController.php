<?php

namespace App\Http\Controllers\webapp;
use Illuminate\Http\Request;
use DB;
use App\Carotherimage;
use App\User;
use App\Listing;
use App\Message;
use App\Notification;
use App\Faviourite;
use Mail;

class UserController extends Controller
{
 
    function __construct() {
        $this->validate_session();
    }
    public function dashboard()
    {
        if(!isset($_SESSION))
        {
            session_start();
        }
        $data=User::find($_SESSION['userid']);
        $listings=DB::table('listings')
            ->select('listings.*')
            ->where('listings.user_id',$_SESSION['userid'])->where('listings.status','1')->orderBy('listings.id','DESC')->limit(5)->get();
        $messages=DB::table('messages')
            ->select('messages.*')
            ->where('messages.to_id',$_SESSION['userid'])->get();
        $faviourites=DB::table('faviourites')
            ->select('faviourites.*')
            ->where('faviourites.user_id',$_SESSION['userid'])->get();
        return view('webapp.dashboard',compact('data','listings','messages','faviourites'));
    }
    public function myprofile($id)
    {
        $data=User::find($id);
       
        return view('webapp.my-profile',compact('data'));
    }
    public function updateprofile(Request $request,$id)
    {
        //return $request;
        $data= User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->city = $request->city;
        // $data->state = $request->state;
        $data->country = $request->country;
        $data->updated_at =date("Y-m-d h:i:s");
            if($request->hasfile('user_photo'))
             {
                $name = $request->name;
                $file = $request->file('user_photo');
                $extension = $file->getClientOriginalExtension(); // getting logo extension
                $filename =$name.'.'.time().'.'.$extension;
                $filename =  preg_replace('/[^A-Za-z0-9. ]/', '', $filename);
                $path=$file->move('webapp-assets/images/user-images/', $filename);
                $data->user_photo = $filename;
             }
             
        $data->save();
        
        return back()->with('message', ' Profile Updated successfully!');
    }
    public function createlisting()
    {
      if(!isset($_SESSION))
      {
         session_start();
      }
        $data=User::find($_SESSION['userid']);
       
        return view('webapp.create-listing',compact('data'));
    }

    public function savelisting(Request $request)
    {
       
        $data= new Listing();
            $data->user_id = $request->user_id;
            $data->vehicle_name = $request->vehicle_name;
            $data->vehicle_number = $request->vehicle_number;
            $data->engine_number = $request->engine_number;
            $data->vehicle_colour= $request->vehicle_colour;
            $data->price = $request->price;
            $data->location = $request->location;
            $data->description = $request->description;
            $data->status = '0';
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
            if($request->hasfile('bluebook_image'))
            {
               $name = strtolower($request->vehicle_name);
               $file = $request->file('bluebook_image');
               $extension = $file->getClientOriginalExtension(); // getting logo extension
               $filename =$name.'.'.time().'.'.$extension;
               $filename =  preg_replace('/[^A-Za-z0-9. ]/', '', $filename);
               $path=$file->move('images/bluebook_images/', $filename);
               $data->bluebook_image = $filename;
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

            $msg="New Car Listing Added by User!";
                $admin= User::where('id','1')->where('role','admin')->first();
               
                    
                        $notification= new Notification();
                        $notification->to_id=$admin->id;
                        $notification->notification=$msg;
                        $url='/admin/listings';
                        $notification->url=$url;
                        $notification->save();

                        $data = array('msg'=>"msg",'url'=>"$url");

                        // Mail::send('webapp.notification-mail',$data, function($message) use($admin){
                        //     $message->to($admin->email)->subject
                        //         ('New Car Listing');
                        //     $message->from('phpproject003@gmail.com');
                        // });
            
            return back()->with('message', 'Listing Added Successfully!');
        
    }

    public function mylistings()
    {
      if(!isset($_SESSION))
      {
         session_start();
      }
        $listings=DB::table('listings')
            ->leftjoin('users', 'users.id','=','listings.user_id')
            ->select('listings.*', 'users.name as username')
            ->where('listings.user_id', $_SESSION['userid'])->groupBy('listings.id')->orderBy('listings.id','DESC')->get();
        $data=User::find($_SESSION['userid']);
        return view('webapp.my-listings',compact('listings','data'));
    }
    public function deletelisting($id){
      $data= Listing::find($id);
      $data->delete();
      return back()->with('message', ' Listing Deleted successfully!');
  }
  public function listingactivestatus($id)
        {
            $data = Listing::find($id);
            $data->status = '1';
            $data->save();
            return back()->with('message', ' Listing Opened successfully!');
        }
   public function listinginactivestatus($id)
        {
            $data = Listing::find($id);
            $data->status = '0';
            $data->save();
            return back()->with('message', ' Listing Closed successfully!');
        }


        public function editlisting($id)
        {
            if(!isset($_SESSION))
            {
                session_start();
            }
            $listing=DB::table('listings')
            ->select('listings.*')
            ->where('id',$id)->first();
            
            $otherimages=Carotherimage::where('listing_id',$id)->get();
            $data=User::find($_SESSION['userid']);
            return view('webapp.edit-listing',compact('listing','otherimages','data'));
        }
        public function updatelisting(Request $request,$id)
        {
            $data= Listing::find($id);
            $data->user_id = $request->user_id;
            $data->vehicle_name = $request->vehicle_name;
            $data->price = $request->price;
            $data->location = $request->location;
            $data->description = $request->description;
            $data->status = '0';
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

    
                if($request->hasfile('bluebook_image'))
                {
                   $name = strtolower($request->vehicle_name);
                   $file = $request->file('bluebook_image');
                   $extension = $file->getClientOriginalExtension(); // getting logo extension
                   $filename =$name.'.'.time().'.'.$extension;
                   $filename =  preg_replace('/[^A-Za-z0-9. ]/', '', $filename);
                   $path=$file->move('images/bluebook_images/', $filename);
                   $data->bluebook_image = $filename;
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
                return back()->with('message', 'Listing Updated Successfully!');
            
        }

    public function mymessages()
    {
      if(!isset($_SESSION))
      {
         session_start();
      }
      $userid=$_SESSION['userid'];
      $messages=  DB::table('messages')
            ->leftjoin('listings', 'listings.id','=','messages.listing_id')
            ->select('messages.*', 'listings.vehicle_name as vehicle_name', 'listings.main_image as main_image')
            ->where('messages.from_id', $userid)->orWhere('messages.to_id', $userid)->groupBy('messages.listing_id')->orderBy('messages.id','DESC')->get();

        $data=User::find($userid);
        return view('webapp.my-messages',compact('messages','data'));
    }
    public function viewmessages($listingid, $from, $to)
    {
      if(!isset($_SESSION))
      {
         session_start();
      }
      $messages= Message::where([['listing_id', '=', $listingid],['from_id', '=', $from]])->orWhere([['listing_id', '=', $listingid],['to_id', '=', $from]])->orderBy('id','Desc')->get();
        $data=User::find($_SESSION['userid']);
        $listing= Listing::find($listingid);
        $touser=User::find($to);

        return view('webapp.view-messages',compact('messages','data','listing','touser'));
    }

    public function sendmessage(Request $request)
    {
        //return $request;
        $user= User::first();
        //return $user;
        $data= new Message();
        $data->from_id = $request->from_id;
        $data->from_name = $request->from_name;
        $data->to_id = $request->to_id;
        $data->to_name = $request->to_name;
         $data->listing_id = $request->listing_id;
        $data->message = $request->message;
        $data->today_date = date("d-m-Y"); 
        $data->save();

        $msg="You have new message from ".$request->from_name.".";
        $notification=new Notification();
        $notification->to_id=$request->to_id;
        $notification->notification=$msg;
        $url='/view-messages/'.$request->listing_id.'/'.$request->to_id.'/'.$request->from_id;
        $notification->url=$url;
        $notification->save();

                        $data = array('msg'=>"msg",'url'=>"$url");
                        $user= User::find($request->to_id);
                        // Mail::send('webapp.notification-mail',$data, function($message) use($user){
                        //     $message->to($user->email)->subject
                        //         ('New Message');
                        //     $message->from('phpproject003@gmail.com');
                        // });

        return back()->with('message', ' Message Sent successfully!');
    }

    public function sellcar($listingid, $sellto){
        
        $data= Listing::find($listingid);
        $data->sold_to=$sellto;
        $data->status='0';
        $data->save();
        return back()->with('message', ' Car Sold successfully!');
    }
    public function notifications()
    {
      if(!isset($_SESSION))
      {
         session_start();
      }
        $notifications=DB::table('notifications')
            ->select('notifications.*')
            ->where('to_id',$_SESSION['userid'])->orderBy('id','DESC')->get();
        $data=User::find($_SESSION['userid']);
        return view('webapp.notifications',compact('notifications','data'));
    }


    public function faviourites()
    {
      if(!isset($_SESSION))
      {
         session_start();
      }
        $listings=DB::table('faviourites')
            ->leftjoin('users', 'users.id','=','faviourites.user_id')
            ->leftjoin('listings', 'listings.id','=','faviourites.listing_id')
            ->select('faviourites.*', 'listings.vehicle_name as vehicle_name', 'listings.main_image as main_image', 'listings.price as price', 'listings.location as location', 'listings.id as listing_id')
            ->where('faviourites.user_id', $_SESSION['userid'])->orderBy('listings.id','DESC')->get();
        $data=User::find($_SESSION['userid']);
        return view('webapp.faviourites',compact('listings','data'));
    }

    public function listingremove($id){
        $data= Faviourite::find($id);
        $data->delete();
        return back()->with('message', ' Listing Removed from Faviourite successfully!');
    }

    public function addtofaviourite($listingid, $userid){
        $data= new Faviourite();
        $data->user_id=$userid;
        $data->listing_id=$listingid;
        $data->save();
        return back()->with('message', ' Listing Added to Faviourite successfully!');
    }

}
