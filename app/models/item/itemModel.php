<?php

namespace App\models\item;

use App\models\client\clientModel;
use Illuminate\Database\Eloquent\Model;

class itemModel extends Model
{
    //
    protected $table = "shipping_items";
    protected $fillable = [
        "trip_id",
        "client_id",
        "item_name",
        "item_quantity",
        "item_price",
        "item_total_aed",
        "item_total_usd",
        "item_paid"
    ];

    public function clientInfo()
    {
        return $this->belongsTo(clientModel::class, "client_id", "id");
    }
}
