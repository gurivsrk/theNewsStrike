<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\Scopes\DescOrder;

class fileSystem extends Model
{
    use HasFactory;

    protected $table = 'file_systems';

    protected $guarded = ['id'];

    protected function fileSize(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => bcdiv($value,1024,1).'kb',
        );
    }


   protected static function booted(){
        static::addGlobalScope('desc', new DescOrder);
   }

}
