<!-- <?php

namespace App\Http\Controllers\webapp;

use Illuminate\Http\Request;
use App\Listing;

class PaymentVerificationController extends Controller
{
    public function verify(Request $request)
    {
        $status = $request->q;
        // dd($status);
        $oid = $request->oid;
        $refId = $request->refId;
        $amt = $request->amt;
        // dump($oid, $refId, $amt);

        if ($status == 'su') {
            $url = "https://uat.esewa.com.np/epay/transrec";
            $data = [
                'amt' => $request->amt,
                'rid' => $refId,
                'pid' => '123456789147',
                'scd' => 'epay_payment',
            ];

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($curl);
            curl_close($curl);

            if (strpos($response, "Success") == true) {
                //dd('transaction was successfull');
                $data= Listing::find($request->listing_id);
                $data->sold_to=$request->user_id;
                $data->status='0';
                $data->payment_status='success';
                $data->save();
                return back()->with('message', ' Transaction was successfull!');
            } else {
                //dd('transaction failed');
                return back()->with('error', ' Transaction Failed!');
            }
        } else {
           // dd('transaction failed');
           return back()->with('error', ' Transaction Failed!');
        }
    }
}
 -->