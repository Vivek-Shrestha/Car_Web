<?php

namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use DB;
use App\User;
use App\Notification;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    function __construct() {
        $this->validate_session();
    }

    public function changepassword(Request $request)
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
    function logout()
    {
        if(!isset($_SESSION))
            {
                session_start();
        }
        session_destroy();

        unset($_SESSION['adminid']);
        unset($_SESSION['adminname']);
        unset($_SESSION['adminrole']);
        unset($_SESSION['adminphone']);
        unset($_SESSION['adminemail']);
        unset($_SESSION['adminstatus']);
        unset($_SESSION['adminphoto']);


     return redirect('/admin');
    }

    public function notifications()
    {
        if(!isset($_SESSION))
            {
                session_start();
        }
        $admin_notifications=Notification::where('to_id',$_SESSION['adminid'])->orderBy('id','DESC')->get();
        $adminnotificationscount=count($admin_notifications);
    return view('admin.notifications',compact('admin_notifications','adminnotificationscount'));
    }
    public function activestatus($id)
        {
            $data = User::find($id);
            $data->status = '1';
            $data->save();

            $msg="You have successfully Verified and Activated by Admin. Please Login to Continue!";

                        $notification=new Notification();
                        $notification->to_id=$data->id;
                        $notification->notification=$msg;
                        $url='/login';
                        $notification->url=$url;
                        $notification->save();

                        $data1 = array('msg'=>"msg",'url'=>"$url");

                        // Mail::send('webapp.notification-mail',$data1, function($message) use($data){
                        //     $message->to($data->email)->subject
                        //         ('Verification Mail');
                        //     $message->from('durgeshsingh156.ds@gmail.com');
                        // });

            return back()->with('message', ' user Activated successfully!');
        }
        public function inactivestatus($id)
        {
            $data = User::find($id);
            $data->status = '0';
            $data->save();
            return back()->with('message', ' user deactivated successfully!');
        }


}
