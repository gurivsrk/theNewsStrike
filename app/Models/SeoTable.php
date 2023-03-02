<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoTable extends Model
{
    use HasFactory;
    protected $table = "seo";

    protected $fillable = [
        'meta_title',
        'meta_keywords',
        'meta_descritpions',
        'misc',
        'page_id'
    ];


}
