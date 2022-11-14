<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Purchase;
use App\Listing;
use App\Ad;
class PlanExpiry extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'planexpiry:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // $current_date=date("Y-m-d");
        // $allplans= Purchase::where('expiry_date',$current_date)->get();
        // if(count($allplans)>0){
        //     foreach($allplans as $allplansnew){
        //         $data=Purchase::find($allplansnew->id);
        //         $data->status='0';
        //         $data->save();
        //     }
        // }

        $current_date=date("d/m/Y");
        $alllistings= Listing::where('listing_expiry',$current_date)->get();
        if(count($alllistings)>0){
            foreach($alllistings as $alllistingsnew){
                $data=Listing::find($alllistingsnew->id);
                $data->status='0';
                $data->save();
            }
        }


        $ads=Ad::where('expiry',$current_date)->get();
        if(count($ads)>0){
            foreach($ads as $adsnew){
                $data1=Ad::find($adsnew->id);
                $data1->status='0';
                $data1->save();
            }
        }



    }


}
