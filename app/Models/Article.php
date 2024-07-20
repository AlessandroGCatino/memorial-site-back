<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;


class Article extends Model
{
    use HasFactory;
    protected $fillable = [
        "operaName",
        "slug",
        "videoUrl",
        "operaDescription",
        "operaYear",
        "operaMaterial",
        "show",
        "operaPicture",
        "artist_id"
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($article) {
            $article->slug = static::generateSlug($article->operaName);
        });
    }

    public static function generateSlug($name){
        return Str::slug($name, '-');
    }
    public function artist(): BelongsTo{
        return $this->belongsTo(Artist::class);
    }

    public function pictures(): HasMany{
        return $this->hasMany(Picture::class);
    }
}
