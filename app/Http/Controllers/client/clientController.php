<?php

namespace App\Http\Controllers\client;

use App\CustomClass\CustomValidator;
use App\CustomClass\Status;
use App\Http\Controllers\Controller;
use App\models\client\clientModel;
use App\models\item\itemModel;
use App\models\trips\tripListModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class clientController extends Controller
{
    //
    public function __construct()
    {
        $this->Status = new Status();
        $this->CustomValidator = new CustomValidator();
        $this->expects_json = false;
    }

    public function showNewclientForm()
    {
        return view('client.newclient');
    }
    public function viewclientList(Request $request)
    {
        if($request->expectsJson())
            $this->expects_json = true;
        $client_list = clientModel::where('is_active', true)->get();
        // $successmessage = $this->expects_json ? $client_list : 
        $this->Status->setSuccess($client_list);
        return $this->returnResponse(view('clients.clientlist'), compact('client_list'));
    }
    public function viewclientItems($client_id, $trip_id)
    {
        // return "client id ".$client_id;
        $itemlist = itemModel::where([
            ["client_id", $client_id],
            ["trip_id", $trip_id]
        ])->get();
        $total_aed = 0;
        $total_usd = 0;
        foreach ($itemlist as $key => $item) {
            # code...

            setlocale(LC_MONETARY, "en_US");
            $total_usd +=  $item->item_total_usd;
            $itemlist[$key]->item_total_usd = money_format("%i", $item->item_total_usd);
            setlocale(LC_MONETARY, "ar_AE");
            $total_aed +=  $item->item_total_aed;
            $itemlist[$key]->item_total_aed = money_format("%i", $item->item_total_aed);
            $itemlist[$key]->item_price = money_format("%i", $item->item_price);
        }
        $client_exists = clientModel::where("id", $client_id)->exists();
        $trip_exists = tripListModel::where("id", $trip_id)->exists();
        if($itemlist == null || $itemlist->count() <=0 || !$trip_exists || !$client_exists)
            return view('errors.404');
        $clientInfo = clientModel::where('id', $client_id)->get()[0];
        $tripInfo = tripListModel::where('id', $trip_id)->get()[0];
        // return $tripInfo;

        setlocale(LC_MONETARY, "en_US");
        $grand_total["grand_usd"] = money_format("%i", $total_usd);
        setlocale(LC_MONETARY, "ar_AE");
        $grand_total["grand_aed"] = money_format("%i", $total_aed);
        return view("clients.clientitems", compact('itemlist', 'clientInfo', 'tripInfo', 'grand_total'));

    }

    // 
    public function ApiAddNewclient(Request $request)
    {
        if($request->expectsJson())
            $this->expects_json = true;
        $rules =[
            "client_name" => "required|string|max:75",
            "client_email" => "nullable|string|max:45",
            "client_phone" => "nullable|string|max:20",
            "client_mark" => "required|string|max:15|unique:clients,client_mark",
            "client_location" => "required|integer"
        ];
        
        
        if($this->expects_json)
        {
            $is_valid = Validator::make($request->all(), $rules);
            $isNotValidRequest = $this->CustomValidator->isNotValidRequest($is_valid);
            if($isNotValidRequest)
                return $isNotValidRequest;
        }
        else 
            $is_valid = $request->validate($rules);

        $new_client = clientModel::create([
            "client_name" => $request->client_name,
            "client_location" => $request->client_location,
            "client_email" => $request->client_email,
            "client_phone" => $request->client_phone, 
            "client_mark" => $request->client_mark,
        ]);

        $successmessage = $this->expects_json ? $new_client : "Successfully added new client ".$request->client_name;
        $this->Status->setSuccess($successmessage);
        return $this->returnResponse("client.newclient", compact('successmessage'));
    }


    public function returnResponse($viewname, $compact = null, $error=false)
    {
        if($this->expects_json)
        {
            if($error)
                return $this->Status->getError();
            else
                return $this->Status->getSuccess();
        }
        else
            return view($viewname, $compact);
    }
}

