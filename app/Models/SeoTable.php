<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoTable extends Model
{
    use HasFactory;
    protected $table = "seos";

    protected $gaurded = ['id'];

}
