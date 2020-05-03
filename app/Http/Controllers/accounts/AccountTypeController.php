<?php

namespace App\Http\Controllers\accounts;

use App\Http\Controllers\Controller;
use App\models\accounts\AccountTypeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AccountTypeController extends Controller
{
    //

    public function ViewListOfAccountsTypes(Request $request)
    {
        $user = $request->user();

        $ac_types = AccountTypeModel::all();

        return view('accounts.account_types', compact('ac_types'));
    }

    public function AddNewAccountType(Request $request)
    {
        $user = $request->user();
        $rules = [
            "account_type" => "required|string|max:255|min:6|unique:accounttypes,ac_type_name",
            "account_description" => "nullable|string|max:2000"
        ];

        $data = $request->validate($rules);
        
        $AcTypeModel = new AccountTypeModel();
        $new_account_type = $AcTypeModel->storeAccount($data, $user->id);
        
        return Redirect::back()->with('success', 'New account type has been added successfully');
    }

    
}
