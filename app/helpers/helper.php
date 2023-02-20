<?php

use App\Models\codeMirror;
use Carbon\Carbon;

if(!function_exists('customCode')){
    function customCode($where){
        $result = codeMirror::where('where',$where)->get();
        foreach($result as $code){
            echo codeMirror::LinkOrCode($code->linking,$code->code,$code->type);
        }
    }
}

