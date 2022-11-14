<?php

namespace App\Http\Controllers\admin;

use App\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Notification;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    function __construct() {
        $this->validate_session();
    }


    public function users()
    {
    	    // $users= DB::table('users')
            // ->select('users.*')
            // ->orderBy('users.id','DESC')->get();
            // User::where('role','user')->orderBy('id','DESC')->get();
            $users = User::join('listings','listings.user_id','=','users.id')
            ->orderBy('users.id','DESC')
            ->get();

        return view('admin.users',compact('users'));
    }
    public function adduser()
    {
        return view('admin.adduser');
    }
    public function updateuser(Request $request,$id)
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

        return back()->with('message', ' User Updated successfully!');
    }
    public function edituser($id)
    {
        $userdata = User::find($id);
        return view('admin.edituser',compact('userdata'));
    }
    public function deleteuser($id){
        $data= User::find($id);
        $data->delete();
        return back()->with('message', ' User Deleted successfully!');
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

    public function saveuser(Request $request)
    {

           $data= new User();
            $data->name = $request->name;
            $data->email = $request->email;
            $data->phone = $request->phone;
            $data->city = $request->city;
            $data->state = $request->state;
            $data->country = $request->country;
            $data->status = $request->status;

            $data->password = md5($request->password);
            $data->role = 'user';
            $data->otp_verified= 'yes';
            $data->status = '1';
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

            return back()->with('message', ' User registered successfully.');

    }

    public function activestatus($id)
        {
            $data = User::find($id);
            $data->status = '1';
            $data->save();

            $msg="You have successfully Verified. Please Login to Continue!";

                        $notification=Notification::new();
                        $notification->to_id=$data->id;
                        $notification->notification=$msg;
                        $url='/login';
                        $notification->url=$url;
                        $notification->save();

                        $data1 = array('msg'=>"msg",'url'=>"$url");

                        // Mail::send('webapp.notification-mail',$data, function($message) use($data){
                        //     $message->to($data->email)->subject
                        //         ('Verification Mail');
                        //     $message->from('phpproject003@gmail.com');
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

        // public function listingremove($id)
        // {
        //     $data = listingnew::find($id);
        //     $data->delete();
        //     return back()->with('message', 'Car Listing Deleted successfully!');
        // }
}
