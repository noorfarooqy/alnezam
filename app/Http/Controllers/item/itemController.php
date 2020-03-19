<?php

namespace App\Http\Controllers\item;

use App\CustomClass\CustomValidator;
use App\CustomClass\Status;
use App\Http\Controllers\Controller;
use App\models\client\clientModel;
use App\models\item\itemModel;
use App\models\trips\tripListModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class itemController extends Controller
{
    //
    public function __construct()
    {
        $this->Status = new Status();
        $this->CustomValidator = new CustomValidator();
        $this->expects_json = false;
    }

    public function showNewitemForm()
    {
        return view('item.newitem');
    }
    public function viewitemList(Request $request)
    {

        if ($request->expectsJson()) {
            $this->expects_json = true;
        }

        $itemlist = itemModel::where('trip_id', $request->trip_id)->get();
        // $successmessage = $this->expects_json ? $client_list :
        if ($itemlist == null || $itemlist->count() <= 0) {
            $this->Status->setError("The trip you have selected could not be found");
            return $this->returnResponse('errors.404');
        }
        $total_usd = 0;
        $total_aed = 0;
        foreach ($itemlist as $key => $item) {
            # code...
            $total_usd = $total_usd + $item->item_total_usd;

            setlocale(LC_MONETARY, "en_US");
            $itemlist[$key]->item_total_usd = money_format("%i", $item->item_total_usd); 
            $total_aed = $total_aed + $item->item_total_aed;   
            setlocale(LC_MONETARY, "ar_AE");
            $itemlist[$key]->item_total_aed = money_format("%i", $item->item_total_aed); 
        }

        setlocale(LC_MONETARY, "en_US");
        $grand_total["grand_usd"] = money_format("%i", $total_usd);
        setlocale(LC_MONETARY, "ar_AE");
        $grand_total["grand_aed"] = money_format("%i", $total_aed);
        $this->Status->setSuccess([$itemlist, $grand_total]);
        return $this->returnResponse('trips.triplist', compact('itemlist', 'grand_total'));
    }

    public function ApiAddNewitem(Request $request)
    {
        if ($request->expectsJson()) {
            $this->expects_json = true;
        }

        $rules = [
            "trip_id" => "required|integer",
            "client_mark" => "required|integer",
            "client_name" => "required|string|max:45",
            "item_name" => "required|string|max:75",
            "item_quantity" => "required|numeric|min:1",
            "item_price" => "required|numeric|min:0",
            "item_total_aed" => "required|numeric|min:0",
            "item_total_usd" => "required|numeric|min:0",
            "item_paid" => "required|boolean",
        ];

        if ($this->expects_json) {
            $is_valid = Validator::make($request->all(), $rules);
            $isNotValidRequest = $this->CustomValidator->isNotValidRequest($is_valid);
            if ($isNotValidRequest) {
                return $isNotValidRequest;
            }

        } else {
            $is_valid = $request->validate($rules);
        }

        
        $trip_exists = tripListModel::where("id", $request->trip_id)->get();
        $client_exists = clientModel::where("id", $request->client_mark)->get();

        if ($trip_exists == null || $trip_exists->count() <= 0) {
            $error = ["The trip you are adding the item to does not exist"];
            $this->Status->setError($error);
            // return $this->returnResponse(view("items.newitem"), compact('itemlist'), $error);
            return $this->Status->getError();
        } else if ($client_exists == null || $client_exists->count() <= 0) {
            $error = ["The client you have selected does not exist"];
            $this->Status->setError($error);
            // return $this->returnResponse(view("items.newitem"), compact('itemlist'), $error);
            return $this->Status->getError();
        } else if ($trip_exists[0]->is_active == false) {
            $error = ["The trip you have selected is not active, cannot add any item."];
            $this->Status->setError($error);
            // return $this->returnResponse(view("items.newitem"), compact('itemlist'), $error);
            return $this->Status->getError();
        }

        $new_item = itemModel::create([
            "trip_id" => $request->trip_id,
            "client_id" => $request->client_mark,
            "item_name" => $request->item_name,
            "item_quantity" => $request->item_quantity,
            "item_price" => $request->item_price,
            "item_total_aed" => $request->item_total_aed,
            "item_total_usd" => $request->item_total_usd,
            "item_paid" => $request->item_paid,
        ]);

        $itemlist = itemModel::where("trip_id", $request->trip_id)->get(["item_total_aed", "item_total_usd"]);
        $total_aed = $itemlist->sum('item_total_aed');
        $total_usd = $itemlist->sum('item_total_usd');
        
        // $successmessage = $this->expects_json ? $new_item : "Successfully added new item ".$new_item;
        // return $this->returnResponse(view('i'))
        setlocale(LC_MONETARY, "en_US");
        $new_item->item_total_usd = money_format("%i", $new_item->item_total_usd);
        $grand_total["grand_usd"] = money_format("%i", $total_usd);
        setlocale(LC_MONETARY, "ar_AE");
        $grand_total["grand_aed"] = money_format("%i", $total_aed);
        $new_item->item_total_aed = money_format("%i", $new_item->item_total_aed);
        $this->Status->setSuccess([$new_item, $grand_total]);
        return $this->Status->getSuccess();

    }

    public function returnResponse($viewname, $compact = null, $error = false)
    {
        if ($this->expects_json) {
            if ($error) {
                return $this->Status->getError();
            } else {
                return $this->Status->getSuccess();
            }

        } else {
            return view($viewname, $compact);
        }

    }

}
