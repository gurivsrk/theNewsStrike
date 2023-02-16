<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;

class codeMirror extends Model
{
    use HasFactory;

    protected $table = "code_mirrors";

    protected $guarded = ['id'];

    protected function code(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => serialize($value),
            get: fn ($value) => unserialize($value),
        );
    }

   protected static function LinkOrCode($linking,$code,$type){
    switch($linking){
        case 'external' :
            $link =  asset(Str::replace('public','storage',$code));
            return $type === 'css' ? "<link rel='stylesheet' href='{$link}' />" : ($type === 'javascript' ?"<script src='{$link}'></script>":'');
         break;
         case 'internal' :
            return $type === 'css' ? "<style >$code<style/>" : ($type === 'javascript' ?"<script>$code</script>":$code);
         break;
    }
   }
}
