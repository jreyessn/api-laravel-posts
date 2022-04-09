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

    public function tags()
    {
        return $this->morphMany(Tag::class, "model");
    }
}
