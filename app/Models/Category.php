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

    static public function addNewTags($tags,$type,$for='all')
    {
        $id=[] ;
        foreach(explode(',',$tags) as $tag){
            $rows = @self::where('id',$tag)->orWhere('name',$tag)->where('type',$type)->first();
            if($rows){
                $id[] = $rows->id;
            }
            else{
                $rows =  @self::create([
                'for'=> $for,
                'name'=> $tag,
                'type' => $type,
                ]);
                $id[] = $rows->id;
            }
        }
        return $id;
    }

}
