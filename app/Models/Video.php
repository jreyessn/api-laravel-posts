<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "title",
        "user_id"
    ];

    protected $with = [
        "tags"
    ];

    public function tags()
    {
        return $this->morphToMany(Tag::class, "model", "model_tags");
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
