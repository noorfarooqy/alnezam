<?php

namespace App\models\accounts;

use App\User;
use Illuminate\Database\Eloquent\Model;

class AccountTypeModel extends Model
{
    //
    protected $table = "accounttypes";
    protected $fillable = [
        "ac_type_name",
        "ac_type_description",
        "is_active",
        "created_by"
    ];

    public function Accounts()
    {
        return $this->hasMany(AccountsModel::class, 'ac_type', 'id');
    }
    public function CreatedBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function storeAccount($data,$user_id)
    {
        return $this->create([
            "ac_type_name" => $data["account_type"],
            "ac_type_description" => $data["account_description"],
            "is_active" => true,
            "created_by" => $user_id
        ]);
    }
}
