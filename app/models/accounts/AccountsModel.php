<?php

namespace App\models\accounts;

use App\User;
use Illuminate\Database\Eloquent\Model;

class AccountsModel extends Model
{
    //
    protected $table = "accounts";
    protected $fillable = [
        "ac_name",
        "ac_email",
        "ac_description",
        "ac_type",
        "is_active",
        "created_by"
    ];

    public function AccountType()
    {
        return $this->belongsTo(AccountTypeModel::class, 'ac_type', 'id');
    }
    public function CreatedBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function storeAccount($data,$user_id)
    {
        return $this->create([
            "ac_name" => $data["account_name"],
            "ac_email" => isset($data["account_email"]) ? $data["account_email"] : null,
            "ac_description" => isset($data["account_description"]) ? $data["account_description"] : null,
            "ac_type" => $data["account_type"],
            "is_active" => true,
            "created_by" => $user_id
        ]);
    }

    public function DebitEntries()
    {
        return $this->hasMany(JournalEntriesModel::class, 'ac_debit', 'id');
    }
    public function CreditEntries()
    {
        return $this->hasMany(JournalEntriesModel::class, 'ac_credit', 'id');
    }
}
