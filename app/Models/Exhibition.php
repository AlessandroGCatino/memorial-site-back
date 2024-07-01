<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;


class Exhibition extends Model
{
    use HasFactory;
    protected $fillable = [
        "title",
        "expositionDates",
        "slug",
        "show",
        "section_id"
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($exhibition) {
            $exhibition->slug = static::generateSlug($exhibition->title);
        });
    }

    public static function generateSlug($name){
        return Str::slug($name, '-');
    }

    public function artists(): BelongsToMany{
        return $this->BelongsToMany(Artist::class);
    }

    public function section(): BelongsTo{
        return $this->belongsTo(Section::class);
    }
}
