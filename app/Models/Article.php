<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    use HasFactory;
    protected $fillable = [
        "title",
        "operaPicture",
        "operaName",
        "operaYear",
        "operaMaterial",
        "operaDescription",
        "artist_id"
    ];

    public function artist(): BelongsTo{
        return $this->belongsTo(Artist::class);
    }
}
