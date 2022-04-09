<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "title",
        "body",
        "user_id"
    ];

    public function tags()
    {
        return $this->morphMany(Tag::class, "model");
    }
}
