<?php

namespace App\Http\Controllers\shipping;

use App\CustomClass\CustomValidator;
use App\CustomClass\Status;
use App\Http\Controllers\Controller;
use App\models\client\clientModel;
use App\models\karani\karaniModel;
use App\models\shipping\launchShipsModel;
use App\models\trips\tripListModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;

class shippingController extends Controller
{
    //
    public function __construct()
    {
        $this->Status = new Status();
        $this->CustomValidator = new CustomValidator();
        $this->expects_json = false;
    }
    public function addNewShippingLaunch()
    {
        return view('launches.newlaunch');
    }
    public function viewShippingLaunchList()
    {
        $launchlist = launchShipsModel::get();
        return view('launches.list', compact('launchlist'));
    }
    public function showNewTripForm()
    {
        $karanilist = karaniModel::where('is_active',true)->get();
        $launchlist = launchShipsModel::where('is_active',true)->get();
        return view('trips.new', compact('launchlist', 'karanilist'));
    }

    public function getTripList(Request $request)
    {
        $triplist = tripListModel::where('is_active',true)->get();
        foreach ($triplist as $key => $trip) {
            # code...
            $trip->karaniInfo;
            $trip->launchInfo;
        }
        return view('trips.triplist', compact('triplist'));
    }
    public function viewTripGiven($trip_id)
    {
        $tripdata = tripListModel::where([
            ["id", $trip_id]
        ])->get();
        if($tripdata == null || $tripdata->count() <= 0)
        {
            return view("errors.404");
        }
        $tripdata = $tripdata[0];
        $customerlist = clientModel::where("is_active", true)->get();
        return view('trips.viewtrip', compact('tripdata', 'customerlist'));
    }
    
    
    public function ApiaddNewShippingLaunch(Request $request)
    {
        $rules = [
            "launch_name" => "required|string|max:75|unique:launch_ships,launch_name",
            "owner_name" => "required|string|max:75",
            "captain_name" => "required|string|max:45",
            "average_capacity" => "required|integer|min:10",
        ];
        if($request->expectsJson())
        {
            $this->expects_json = true;
            $is_valid = Validator::make($request->all(), $rules);
            $isNotValidRequest = $this->CustomValidator->isNotValidRequest($is_valid);
            if($isNotValidRequest)
                return $isNotValidRequest;
        }
        else 
            $is_valid = $request->validate($rules);


        $is_created = launchShipsModel::create([
            "launch_name" => $request->launch_name,
            "owner_name" => $request->owner_name,
            "captain_name" => $request->captain_name,
            "average_capacity" => $request->average_capacity
        ]);
        $successmessage = "successfully added new launch ".$request->launch_name;
        $this->Status->setSuccess([$successmessage]);
        return $this->returnResponse("launches.newlaunch", compact('successmessage'));
        
        

    }

    public function ApiAddNewTrip(Request $request)
    {
        $rules = [
            "launch"  => "required|integer",
            "trip_name" => "required|string|max:75|unique:launch_list,trip_name",
            "loading_port" => "required|string|max:45",
            "destination_port" => "required|string|max:45",
            "karani" => "required|integer",
        ];
        if($request->expectsJson())
        {
            $this->expects_json = true;
            $is_valid = Validator::make($request->all(), $rules);
            $isNotValidRequest = $this->CustomValidator->isNotValidRequest($is_valid);
            if($isNotValidRequest)
                return $isNotValidRequest;
        }
        else 
        {
            $is_valid = $request->validate($rules);
            
        }
        // return "isvalid";    

        // return "wats happening";
        $launch_exist = launchShipsModel::where([
            ["id", $request->launch],
            ["is_active", true]
        ])->exists();
        $karanilist = karaniModel::where('is_active',true)->get();
        $launchlist = launchShipsModel::where('is_active',true)->get();
        if(!$launch_exist)
        {
            $error = ["launch" =>"The launch you have selected does not exists or is diactivated"];
            // return $error;
            $this->Status->setError($error);
            if($request->expectsJson())
                return $this->Status->getError();
            else
                return view("trips.new", compact('error', 'karanilist', 'launchlist'));
        }
        $karani_exists = karaniModel::where([
            ["id", $request->karani],
            ["is_active", true]
        ])->exists();
            
        if(!$karani_exists)
        {

            
            $error = [ "karani"=>"The karani you have selected does not exists or is diactivated"];
            // return $error;
            $this->Status->setError($error);
            if($request->expectsJson())
                return $this->Status->getError();
            else
                return view("trips.new", compact('error', 'karanilist', 'launchlist'))->withInput();
            // return $this->returnResponse("trips.new", , true);

        }
        
        $new_trip = tripListModel::create([
            "launch_id" => $request->launch,
            "trip_name" => $request->trip_name,
            "loading_port" => $request->loading_port,
            "destination_port" => $request->destination_port,
            "karani_id" => $request->karani,
        ]);

        $successmessage = "successfully created the new trip. Visit the trip page to add items";
        $this->Status->setSuccess($successmessage);
        return $this->returnResponse("trips.new",compact("successmessage","karanilist", "launchlist"));
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
