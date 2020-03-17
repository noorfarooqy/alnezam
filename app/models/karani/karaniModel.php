<?php

namespace App\models\karani;

use Illuminate\Database\Eloquent\Model;

class karaniModel extends Model
{
    //
    protected $table = "karani";
    protected $fillable = [
        "karani_email",
        "karani_name",
        "karani_number",
        "is_active"
    ];
}
