<?php

namespace App\Http\Controllers\karani;

use App\CustomClass\CustomValidator;
use App\CustomClass\Status;
use App\Http\Controllers\Controller;
use App\models\karani\karaniModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class karaniController extends Controller
{
    //
    public function __construct()
    {
        $this->Status = new Status();
        $this->CustomValidator = new CustomValidator();
        $this->expects_json = false;
    }
    public function showNewKaraniForm()
    {
        return view('karani.newkarani');
    }

    public function viewKaraniList()
    {
        $karanilist = karaniModel::get();
        return view('karani.karanilist', compact('karanilist'));
    }
    public function ApiAddNewKarani(Request $request)
    {
        $rules = [
            "karani_email" => "required|email|max:75|unique:karani,karani_email",
            "karani_name" => "required|string|max:75",
            "karani_phone" => "required|string|max:20",
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
        
        $new_karani = karaniModel::create([
            "karani_email" => $request->karani_email,
            "karani_name" => $request->karani_name,
            "karani_number" => $request->karani_phone,
        ]);

        
        $successmessage = "successfully added new karani ".$request->karani_name;
        $this->Status->setSuccess([$successmessage]);
        return $this->returnResponse("karani.newkarani", compact('successmessage'));

    }
    

    public function returnResponse($viewname, $compact = null)
    {
        if($this->expects_json)
            return $this->Status->getSuccess();
        else
            return view($viewname, $compact);
    }
}
