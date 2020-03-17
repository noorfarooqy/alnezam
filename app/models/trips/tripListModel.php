<?php

namespace App\models\trips;

use App\models\karani\karaniModel;
use App\models\shipping\launchShipsModel;
use Illuminate\Database\Eloquent\Model;

class tripListModel extends Model
{
    //
    protected $table = "launch_list";
    protected $fillable = [
        "launch_id",
        "trip_name",
        "loading_port",
        "destination_port",
        "karani_id",
        "is_active"
    ];

    public function karaniInfo()
    {
        return $this->hasOne(karaniModel::class, 'id', 'karani_id');
    }
    public function launchInfo()
    {
        return $this->hasOne(launchShipsModel::class, 'id', 'launch_id');
    }
}
