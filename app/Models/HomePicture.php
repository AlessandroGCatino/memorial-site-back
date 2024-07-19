<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomePicture extends Model
{
    use HasFactory;

    protected $fillable = [
        "imagePic",
        "videoUrl",
        "selectedMode",
        "xAxis",
        "yAxis",
        "height",
        "width",
        "linksTo",
        "layer"
    ];
}
