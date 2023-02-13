<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait FileHandler{

    public function addMedia($file,$loc,$isName=false){
        $img_name = $file->getClientOriginalName();
        $filename = ($isName == false) ? date('his') . '-' . $img_name : $img_name ;
        $img_name = $file->storePubliclyAs($loc, $filename,'public');
        return '/storage/'.$img_name;
    }

    public function updateMedia($oldFile,$file,$loc){
            $old = pathinfo($oldFile,PATHINFO_BASENAME);
            //echo $file_name;
            // echo 'public/'.$loc.'/'.$old;
            if(Storage::delete('public/'.$loc.'/'.$old)){
                return $this->addMedia($file,$loc);
            }
            else {
                return redirect()->back()->with('delete','Fail to Update File');
            }
    }




}
