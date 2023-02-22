<?php

use App\Models\codeMirror;
use App\Models\fileSystem;
use App\Models\staticPages;

// use Carbon\Carbon;
// use Throwable;

if(!function_exists('customCode')){
    function customCode($where){
        $result = codeMirror::where('where',$where)->get();
        foreach($result as $code){
            echo codeMirror::LinkOrCode($code->linking,$code->code,$code->type);
        }
    }
}

if(!function_exists('getImageById')){
    function getImageById($id=null){
        if($id){
            $media = fileSystem::find($id);
            if($media){
                return asset($media->fileUrl);
            }
            return asset('paper/img/dummy-image-min.jpg');
        }
        else{
            return asset('paper/img/dummy-image-min.jpg');
        }
    }
}

if(!function_exists('siteInfo')){
    function siteInfo($key){
           $value =  staticPages::getField('GD',$key);
           return $value['field_value'];
    }
}
