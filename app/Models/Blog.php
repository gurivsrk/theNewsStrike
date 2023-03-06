<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

use App\Models\SeoTable;
use App\Models\User;
use App\Models\tags;
use App\Models\Category;
use App\Models\fileSystem;

class Blog extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "blogs";

    protected $fillable = [
        'title',
        'blog_image',
        'author',
        'content',
        'status',
        'slug'
    ];

    public function slug(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => Str::slug((pathinfo($value,PATHINFO_BASENAME))),
        );
    }



    public function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => date('F d, Y - H:i:sa', strtotime($value)),
        );
    }

    public function content(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => serialize($value),
            get: fn ($value) => unserialize($value),
        );
    }


    public function image(){
        return $this->belongsTo(fileSystem::class,'blog_image','id');
    }

    public function MetaData()
    {
        return $this->belongsTo(SeoTable::class,'id','page_id');
    }

    public function categoryName(){
        return $this->belongsTo(Category::class,'category','id');
    }

    public function authorName(){
        return $this->belongsTo(User::class,'author','id');
    }

}
