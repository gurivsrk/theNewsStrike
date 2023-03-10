<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

use App\Models\Category;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        "question",
        "answer",
        "category_id"
    ];

    public function answer(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => serialize($value),
            get: fn ($value) => unserialize($value),
        );
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
}
