<?php

namespace App\models\client;

use Illuminate\Database\Eloquent\Model;

class clientModel extends Model
{
    //
    protected $table ="clients";
    protected $fillable = [
        "client_name",
        "client_location",
        "client_email",
        "client_phone", 
        "client_mark",
        "is_active"
    ];
}
