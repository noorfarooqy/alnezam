<?php

namespace App\Http\Controllers\accounts;

use App\Http\Controllers\Controller;
use App\models\accounts\AccountsModel;
use App\models\accounts\AccountTypeModel;
use App\models\accounts\JournalEntriesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class JournalEntriesController extends Controller
{
    //


    public function RecordEntry(Request $request)
    {
        $user = $request->user();
        $rules = [
            "account_destination" => "required|integer|exists:accounts,id",
            "account_source" => "required|integer|exists:accounts,id",
            "transaction_amount" => "required|numeric|max:999999999999",
            "transaction_description" => "required|string|max:250|min:10"
        ];
        $data = $request->validate($rules);
        
        $debitAccount = AccountsModel::where('id', $request->account_destination)->get()[0];
        $creditAccount = AccountsModel::where('id', $request->account_source)->get()[0];
        if(!$debitAccount->is_active)
            return Redirect::back()->withErrors(['account_destination' => 'The account '.$debitAccount->ac_name.' is not active' ]);
        if(!$creditAccount->is_active)
            return Redirect::back()->withErrors(['account_source' => 'The account '.$creditAccount->ac_name.' is not active' ]);
        $debitAcType = $debitAccount->AccountType;
        $creditAcType = $creditAccount->AccountType;
        if(!$debitAcType->is_active)
            return Redirect::back()->withErrors(['account_destination' => "The account type for ".$debitAccount->ac_name.' is not active']);
        if(!$creditAcType->is_active)
            return Redirect::back()->withErrors(['account_source' => "The account type for ".$creditAccount->ac_name.' is not active']);
        $Journal = new JournalEntriesModel();
        $new_account_type = $Journal->RecordEntry($data, $user->id);
        
        return Redirect::back()->with('success', 'Transaction has been recorded successfully');
    }

    public function ShowEntriesPage(Request $request)
    {
        $user = $request->user();

        $entries = JournalEntriesModel::paginate(20);
        $accounts = AccountsModel::where("is_active", true)->get();
        return view('accounts.entries_page', compact('entries', 'accounts'));
    }

    public function OpenGivenEntry(Request $request, $entry_id)
    {
        $user = $request->user();

        $entry = JournalEntriesModel::where("id", $entry_id)->get();
        if($entry == null || $entry->count() <= 0)
            abort(404);
        $entry = $entry[0];
        $accounts = AccountsModel::where("is_active", true)->get();
        return view('accounts.view_entry', compact('entry', 'accounts'));
    }
}
