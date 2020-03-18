<?php

namespace App\Http\Controllers\client;

use App\CustomClass\CustomValidator;
use App\CustomClass\Status;
use App\Http\Controllers\Controller;
use App\models\client\clientModel;
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

