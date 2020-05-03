<?php

namespace App\Http\Controllers\accounts;

use App\Http\Controllers\Controller;
use App\models\accounts\AccountsModel;
use App\models\accounts\AccountTypeModel;
use App\models\accounts\JournalEntriesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AccountsController extends Controller
{
    //

    public function ViewAccountsOnGivenType(Request $request, $ac_type)
    {
        $user = $request->user();

        $accounts = AccountsModel::where([
            ["ac_type", $ac_type]
        ])->get();
        
        $ac_types = AccountTypeModel::where('is_active', true)->get();

        return view('accounts.accounts', compact('accounts','ac_types'));
    }
    


    public function AddNewAccount(Request $request)
    {
        $user = $request->user();
        $rules = [
            "account_type" => "required|integer|exists:accounttypes,id|gte:1",
            "account_name" => "required|string|max:255|min:5|unique:accounts,ac_name",
            "account_email" => "nullable|email|max:255|min:5|unique:accounts,ac_email",
            "account_description" => "nullable|string|max:250"
        ];
        $data = $request->validate($rules);
        
        $ac_type = AccountTypeModel::where("id", $request->account_type)->get()[0];
        if(!$ac_type->is_active)
            return Redirect::back()->withErrors(['account_type' => "The account type is not valid"]);
        $AcModel = new AccountsModel();
        $new_account_type = $AcModel->storeAccount($data, $user->id);
        
        return Redirect::back()->with('success', 'New account has been added successfully');
    }


    public function OpenEntriesForAccountGiven(Request $request, $ac_id)
    {
        $user = $request->user();

        $account = AccountsModel::where([
            ["id", $ac_id]
        ])->get();
        if($account == null || $account->count() <= 0)
            abort(404);
        $account = $account[0];
        $entries = JournalEntriesModel::where("ac_credit", $ac_id)->orWhere("ac_debit", $ac_id)->get();
        return view('accounts.account_entries', compact('account', 'entries'));
    }
    
}
