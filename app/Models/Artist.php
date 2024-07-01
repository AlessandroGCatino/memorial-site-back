<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;


class Artist extends Model
{
    use HasFactory;
    protected $fillable = [
        "artistName",
        "artistDesc",
        "coverImage",
        "show",
        "slug",
        "exhibition_id"
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($artist) {
            $artist->slug = static::generateSlug($artist->artistName);
        });
    }

    public static function generateSlug($name){
        return Str::slug($name, '-');
    }

    public function exhibitions(): BelongsToMany{
        return $this->belongsToMany(Exhibition::class);
    }

    public function articles(): HasMany{
        return $this->hasMany(Article::class);
    }
}
