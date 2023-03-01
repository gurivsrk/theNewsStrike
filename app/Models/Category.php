<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = "categories_tags";

    protected $fillable = [
        'bg_color',
        'for',
        'logo',
        'name',
        'type',
    ];

    static public function addNewTags($tags)
    {
        $id=[] ;
        foreach(explode(',',$tags) as $tag){
            $rows = @self::where('id',$tag)->orWhere('name',$tag)->first();
            if($rows){
                $id[] = $rows->id;
            }
            else{
                $rows =  @self::create([
                'for'=>'all',
                'name'=> $tag,
                'type' => 'tag',
                ]);
                $id[] = $rows->id;
            }
        }
        return $id;
    }

    static public function addNewCategory($category_raw){
            $id='' ;
            $rows = @self::find($category_raw);
            if($rows){
                $id = $rows->id;
            }
            else{
                $rows =  @self::create([
                'for'=>'all',
                'name'=> $category_raw,
                'type' => 'category',
                ]);
                $id = $rows->id;
            }
            return $id;
    }

}
