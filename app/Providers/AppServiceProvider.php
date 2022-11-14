<?php

namespace App\Providers;
use App\Websitecontent;
use Illuminate\Support\ServiceProvider;
use App\Notification;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(!isset($_SESSION))
            {
                session_start();
        }
        if(isset($_SESSION['userid'])){
            $notifications1=Notification::where('to_id',$_SESSION['userid'])->orderBy('id','DESC')->get();
            $notificationscount=count($notifications1);
            $headersdata = array(

                'notifications' => $notifications1,
                'notificationscount' => $notificationscount
            );
            view()->share('headersdata', $headersdata);
        }
        if(isset($_SESSION['adminid'])){
            $admin_notifications=Notification::where('to_id',$_SESSION['adminid'])->orderBy('id','DESC')->get();
            $adminnotificationscount=count($admin_notifications);
            $adminheadersdata = array(

                'adminnotifications' => $admin_notifications,
                'adminnotificationscount' => $adminnotificationscount
            );
            view()->share('adminheadersdata', $adminheadersdata);
        }

    }
}
