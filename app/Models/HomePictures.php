<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomePictures extends Model
{
    use HasFactory;

    protected $fillable = [
        "image",
        "xAxis",
        "yAxis",
        "height",
        "width",
        "linksTo",
        "layer"
    ];
}
