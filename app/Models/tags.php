<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tags extends Model
{
    use HasFactory;

    protected $table = "blog_tags";

    protected $fillable = ['tag_id','blog_id'];

    public function tagName(){
        return $this->belongsTo(Category::class,'id','tag_id');
    }

}