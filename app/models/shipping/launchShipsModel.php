<?php

namespace App\models\shipping;

use Illuminate\Database\Eloquent\Model;

class launchShipsModel extends Model
{
    //
    protected $table = "launch_ships";

    protected $fillable = [
        "launch_name",
        "captain_name",
        "average_capacity",
        "owner_name",
        "is_active"
    ];
}
