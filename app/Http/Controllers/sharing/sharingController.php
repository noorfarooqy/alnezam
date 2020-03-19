<?php

namespace App\Http\Controllers\sharing;

use App\CustomClass\CustomValidator;
use App\CustomClass\Status;
use App\Http\Controllers\Controller;
use App\Mail\sharing\fileSharingMail;
use App\models\item\itemModel;
use App\models\sharing\sharedFilesModel;
use App\models\trips\tripListModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class sharingController extends Controller
{
    //

    public function __construct()
    {
        $this->Status = new Status();
        $this->CustomValidator = new CustomValidator();
        $this->expects_json = false;
    }

    public function showShareTripForm($trip_id)
    {
        $trip = tripListModel::where('id', $trip_id)->get();
        // $successmessage = $this->expects_json ? $client_list : 
        if($trip == null || $trip->count() <= 0)
            return view('errors.404');
        $trip = $trip[0];
        return view('sharing.sharefile', compact('trip'));
    }

    public function viewSharedFile( $share_id, $trip_id)
    {
        // return "shared ".$share_id;
        $tripInfo = tripListModel::where('id', $trip_id)->get();
        // $successmessage = $this->expects_json ? $client_list : 
        if($tripInfo == null || $tripInfo->count() <= 0)
            return view('errors.404');
        $tripInfo = $tripInfo[0];
        $has_shared = sharedFilesModel::where([
            ["id", $share_id],
            ["file_id", $trip_id],
        ])->get();
        if($has_shared == null || $has_shared->count() <= 0)
            return view('errors.403');
        $itemlist = itemModel::where("trip_id", $tripInfo->id)->get();
        $total_aed= 0;
        $total_usd =0;
        foreach ($itemlist as $key => $item) {
            # code...
            $clientinfo = $item->clientInfo;

            setlocale(LC_MONETARY, "en_US");
            $total_usd +=  $item->item_total_usd;
            $itemlist[$key]->item_total_usd = money_format("%i", $item->item_total_usd);
            setlocale(LC_MONETARY, "ar_AE");
            $total_aed +=  $item->item_total_aed;
            $itemlist[$key]->item_total_aed = money_format("%i", $item->item_total_aed);
            $itemlist[$key]->item_price = money_format("%i", $item->item_price);
        }
        // $tripInfo = tripListModel::where('id', $trip_id)->get()[0];
        setlocale(LC_MONETARY, "en_US");
        $grand_total["grand_usd"] = money_format("%i", $total_usd);
        setlocale(LC_MONETARY, "ar_AE");
        $grand_total["grand_aed"] = money_format("%i", $total_aed);
        // return 'what is th';
        return view('sharing.viewsharedfile', compact('tripInfo', 'itemlist', 'grand_total'));
    }
    
    public function shareTripFile(Request $request)
    {
        // return "whts it";
        $rules =[
            "share_email" => "required|email|max:75",
            "trip_id" => "required|integer|exists:launch_list,id"
        ];
        // return "what";
        $request->validate($rules);
        // return "valid";
        $trip = tripListModel::where("id", $request->trip_id)->get();
        $trip_id = $request->trip_id;
        if($trip == null || $trip->count() <=0 )
            return view('errors.404');
        $existing_email = sharedFilesModel::where([
            ["file_id", $trip_id],
            ["shared_email", $request->share_email],
            ["expired", false]
        ])->exists();
        // return "wer are hre";
        if($existing_email)
        {
            $sharedfile = sharedFilesModel::where([
                ["file_id", $trip_id],
                ["shared_email", $request->share_email],
                ["expired", false]
            ])->get()[0];
            return $this->sendFileNotification(1, $trip_id,$trip[0], $request->share_email, $sharedfile->id);
        }
        
        $is_shared = sharedFilesModel::create([
            "shared_type" => 1,
            "file_id" => $trip_id,
            "shared_email" => $request->share_email,
            "expired" => false,
            "expire_time" => Carbon::now()->add(3,'days')
        ]);
        // return $is_shared;

        return $this->sendFileNotification(1, $trip_id, $trip[0],$request->share_email, $is_shared->id);
    }
    
    public function sendFileNotification($filetype, $file_id, $trip, $email, $shared_id)
    {
        $is_sent = Mail::to($email)->send(new fileSharingMail($filetype, $file_id, $shared_id));
        $successmessage = "Successfully shared ".$trip->trip_name." with email ".$email;
        // return $successmessage;
        return view("sharing.sharefile", compact('trip', 'successmessage'));
    }

}
