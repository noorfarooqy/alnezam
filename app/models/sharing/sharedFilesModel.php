<?php

namespace App\models\sharing;

use Illuminate\Database\Eloquent\Model;

class sharedFilesModel extends Model
{
    //
    protected $table = "shared_files";
    protected $fillable = [
        "shared_type",
        "file_id",
        "shared_email",
        "expired",
        "expire_time"
    ];
}
