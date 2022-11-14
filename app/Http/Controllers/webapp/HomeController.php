<?php

namespace App\Http\Controllers\webapp;
use Illuminate\Http\Request;
use DB;
use App\User;
use App\Listing;
use App\Carotherimage;
use App\Notification;
use Mail;

class HomeController extends Controller
{

    public function index(Request $request)
    {
        if(!isset($_SESSION))
        {
            session_start();
        }
        if(isset($_SESSION['userid'])){
            $data= User::find($_SESSION['userid']);
            $usercity=$data->district;

        }else{
            $usercity='';

        }
        $listings=DB::table('listings')
            ->select('listings.*')
            ->where('status','1')->orderBy('id','DESC')->limit(10)->get();

        return view('webapp.index',compact('listings','usercity'));
    }
    public function register()
    {
        return view('webapp.register');
    }

    public function login()
    {
        return view('webapp.login');
    }

    public function changepassword()
    {
        if(!isset($_SESSION))
      {
         session_start();
      }
        $data=User::find($_SESSION['userid']);
        return view('webapp.change-password',compact('data'));
    }

     function resendotp()
    {
            $email= $_GET['n']; //email ID
            $rndno=rand(100000, 999999); // Generate random OTP
            $_SESSION['userotp']=$rndno; //Store in session

            $data = array('otp'=>"$rndno"); // pass variable in mail file

        //   Mail::send('webapp.otp-mail',$data, function($message) use($email){
        //      $message->to($email)->subject
        //         ('OTP');
        //      $message->from('phpproject003@gmail.com');
        //   });

            return back()->with('message', 'OTP Sent to your Number!');
        // return back()->with('message', 'OTP Resent to your Phone!');

    }


    function checkotp(Request $request,$id)
    {
            $data= User::find($id);
            if($request->otp==$data->otp){
                if(!isset($_SESSION))
                {
                    session_start();
                }
                $_SESSION['userid'] = $data->id;
                $_SESSION['username'] = $data->name;
                $_SESSION['userrole'] = $data->role;
                $_SESSION['userphone'] = $data->phone;
                $_SESSION['useremail'] = $data->email;
                $_SESSION['userphoto'] = $data->user_photo;
                $_SESSION['userstatus'] = $data->status;

                $data->otp_verified= 'yes';
                $data->save();
                $_SESSION['userotpstatus'] = $data->otp_verified;
                return redirect('/my-location/'.$data->id);
            }else{
                return back()->with('error', 'You have entered Invalid OTP!');
            }

    }

    function checklogin(Request $request)
    {
        $phone= $request->phone;
        $password= md5($request->password);

        $userdata =  DB::table('users')->where([['phone', $phone],['password', $password],['status', '1']])->get();

     if(count($userdata)>0)
     {
         if(!isset($_SESSION))
         {
        session_start();
         }
                $_SESSION['userid'] = $userdata[0]->id;
                $_SESSION['username'] = $userdata[0]->name;
                $_SESSION['userrole'] = $userdata[0]->role;
                $_SESSION['userphone'] = $userdata[0]->phone;
                $_SESSION['useremail'] = $userdata[0]->email;
                $_SESSION['userphoto'] = $userdata[0]->user_photo;
                $_SESSION['userstatus'] = $userdata[0]->status;
                $_SESSION['userotpstatus'] = $userdata[0]->otp_verified;

        if(isset($request->remember) && $request->remember == 1)
        {
            setcookie("cemail", $email, time()+(60*60*24));
            setcookie("cpassword", $password, time()+(60*60*24));
        }
        else
        {
        setcookie("Details", "PHP");
        }
            if($userdata[0]->otp_verified=='yes'){
                return redirect('/');
            }else{
               // return redirect('/');
            //    return redirect('/fill-details/'.$userdata[0]->id);
            return back()->with('loginerror', 'User is not active!');
            }

     }else
     {
      return back()->with('loginerror', 'Invalid Login Credentials!');
     }
    }


    public function changeuserpassword(Request $request)
    {
        //return $request;

        if($request->password!=$request->confirm_password){
            return back()->with('error', 'Password Do Not Match! ');

        }else{
           $data= User::find($request->userid);
            $data->password = md5($request->password);

            $data->save();

            return back()->with('message', 'Password Changed Successfully! ');
        }
    }


    public function alllistings()
    {
        if(isset($_GET['car']) && !empty($_GET['car']) && isset($_GET['location']) && !empty($_GET['location'])){
            $listings=DB::table('listings')
                    ->select('listings.*')
                    ->where('vehicle_name', 'like', '%'.$_GET['car'].'%')->where('location', 'like', '%'.$_GET['location'].'%')->where('status','1')->orderBy('id','DESC')->get();
        }elseif(isset($_GET['car']) && !empty($_GET['car']) && isset($_GET['location']) && empty($_GET['location'])){
            $listings=DB::table('listings')
                    ->select('listings.*')
                    ->where('vehicle_name', 'like', '%'.$_GET['car'].'%')->where('status','1')->orderBy('id','DESC')->get();
        }elseif(isset($_GET['car']) && empty($_GET['car']) && isset($_GET['location']) && !empty($_GET['location'])){
            $listings=DB::table('listings')
                    ->select('listings.*')
                    ->where('location', 'like', '%'.$_GET['location'].'%')->where('status','1')->orderBy('id','DESC')->get();
        }else{
            $listings=DB::table('listings')
                    ->select('listings.*')
                    ->where('status','1')->orderBy('id','DESC')->get();
        }
        if(!isset($_SESSION))
        {
            session_start();
        }
        if(isset($_SESSION['userid'])){
            $data= User::find($_SESSION['userid']);
            $usercity=$data->district;
        }else{
            $usercity='';
        }


        return view('webapp.all-listings',compact('listings','usercity'));
    }
    public function listing($id)
    {
        $listing=DB::table('listings')
        ->leftjoin('users', 'users.id','=','listings.user_id')
        ->select('listings.*', 'users.id as userid', 'users.name as username', 'users.user_photo as userphoto', 'users.email as useremail')
        ->where('listings.id',$id)->first();
        $otherimages=Carotherimage::where('listing_id',$id)->get();
        $otherlistings=Listing::where('id','!=',$id)->orderBy('ID','DESC')->get();

        if(!isset($_SESSION))
        {
            session_start();
        }
        if(isset($_SESSION['userid'])){
            $data= User::find($_SESSION['userid']);
            $usercity=$data->district;
        }else{
            $usercity='';
        }

        return view('webapp.listing',compact('listing','usercity','otherimages','otherlistings'));
    }

    function logout()
    {
        if(!isset($_SESSION))
            {
                session_start();
        }
        session_destroy();

        unset($_SESSION['userid']);
        unset($_SESSION['username']);
        unset($_SESSION['userrole']);
        unset($_SESSION['userphone']);
        unset($_SESSION['useremail']);
        unset($_SESSION['usestatus']);
        unset($_SESSION['userphoto']);
        unset($_SESSION['userotpstatus']);

     return redirect('/');
    }


    public function sendotp(Request $request)
    {

            $rndno=rand(100000, 999999);
            $_SESSION['userotp']=$rndno;
            $email= $request->email;
            $data = array('otp'=>"$rndno");

        //   Mail::send('webapp.otp-mail',$data, function($message) use($email){
        //      $message->to($email)->subject
        //         ('OTP');
        //      $message->from('phpproject003@gmail.com');
        //   });
        return redirect('/verify-email?n='.$email)->with('message','OTP is sent to your Email ID!');
    }
    public function verifyemail()
    {
        return view('webapp.verify-email');
    }
    public function verifyuserotp(Request $request)
    {

        if($request->otp==$request->uotp){
            $userdata =  DB::table('users')->Where('email','=',$request->email)->get();
            if(count($userdata)>0){

                if($userdata[0]->status=='1' && $userdata[0]->otp_verified=='yes'){
                    $_SESSION['userid'] = $userdata[0]->id;
                $_SESSION['username'] = $userdata[0]->name;
                $_SESSION['userrole'] = $userdata[0]->role;
                $_SESSION['userphone'] = $userdata[0]->phone;
                $_SESSION['useremail'] = $userdata[0]->email;
                $_SESSION['userphoto'] = $userdata[0]->user_photo;
                $_SESSION['userstatus'] = $userdata[0]->status;
                $_SESSION['userotpstatus'] = $userdata[0]->otp_verified;
                    return redirect('/');
                }else{
                    return redirect('/fill-details/'.$userdata[0]->id);
                }
            }else{
                $data= new User();
                $data->email = $request->email;
                $data->role = 'user';
                $data->otp_verified = 'yes';
                $data->save();

                return redirect('/fill-details/'.$data->id);
            }

        }else{
            return back()->with('error', 'Invalid OTP!');
        }
    }
    public function filluserdetails($id)
    {
        $user=User::find($id);
        return view('webapp.fill-details',compact('user'));
    }
    public function registerform(Request $request)
    {
            $id=$request->user_id;
                $data= User::find($id);
                $data->name = $request->name;
                $data->email = $request->email;
                $data->phone = $request->phone;
                $data->status = '0';
                //$data->password = md5($request->password);
                $data->role = 'user';
                $data->city = $request->city;
                // $data->state = $request->state;
                $data->country = $request->country;
                $data->save();

                $_SESSION['userid'] = $data->id;
                $_SESSION['username'] = $data->name;
                $_SESSION['userrole'] = $data->role;
                $_SESSION['userphone'] = $data->phone;
                $_SESSION['useremail'] = $data->email;
                $_SESSION['userphoto'] = $data->user_photo;
                $_SESSION['userstatus'] = $data->status;
                $_SESSION['userotpstatus'] = $data->otp_verified;

                $msg="New User Registered!";
                $admin= User::where('id','1')->where('role','admin')->first();


                        $notification= new Notification();
                        $notification->to_id=$admin->id;
                        $notification->notification=$msg;
                        $url='/admin/users';
                        $notification->url=$url;
                        $notification->save();

                        $data = array('msg'=>"msg",'url'=>"$url");

                        // Mail::send('webapp.notification-mail',$data, function($message) use($admin){
                        //     $message->to($admin->email)->subject
                        //         ('New User Registration');
                        //     $message->from('phpproject003@gmail.com');
                        // });

            return redirect('/dashboard');

    }

    public function about(Request $request){//this is used to redirect to about page
        return view('webapp.about-us');

    }
    public function contact(Request $request){//this is used to redirect to contact page
        return view('webapp.contact');

    }


}
