<?php

namespace App\models\accounts;

use App\User;
use Illuminate\Database\Eloquent\Model;

class JournalEntriesModel extends Model
{
    //
    protected $table = "journal_entries";

    protected $fillable = [
        "ac_debit",
        "ac_credit",
        "amount",
        "description",
        "created_by"
    ];
    public function CreatedBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
    public function CreditAccountInfo()
    {
        return $this->belongsTo(AccountsModel::class, 'ac_credit', 'id');
    }
    public function DebitAccountInfo()
    {
        return $this->belongsTo(AccountsModel::class, 'ac_debit', 'id');
    }


    public function RecordEntry($data,$user_id)
    {
        return $this->create([
            "ac_debit" => $data["account_destination"],
            "ac_credit" => $data["account_source"],
            "amount" => $data["transaction_amount"],
            "description" => $data["transaction_description"],
            "created_by" => $user_id
        ]);
    }

}
