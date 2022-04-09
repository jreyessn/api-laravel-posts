<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelTag extends Model
{
    use HasFactory;

    protected $fillable = [
        "model_type",
        "model_id",
        "tag_id"
    ];

    public $timestamps = false;

    public function model()
    {
        return $this->morphTo();
    }
    
}
