<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use App\Models\fileSystem;

trait FileHandler{

    public function addMedia($file,$loc,$isName=false){
        $img_name = $file->getClientOriginalName();
        $filename = ($isName == false) ? date('his') . '-' . $img_name : $img_name ;
        $img_name = $file->storePubliclyAs($loc, $filename,'public');
        $url = '/storage/'.$img_name;
        fileSystem::create([
            'fileUrl' => $url,
            'fileName' => $filename,
            'fileMime' => $file->getMimeType(),
            'fileSize' => $file->getSize()
        ]);
        return  $url;
    }

    public function updateMedia($oldFile,$file,$loc){
            $old = pathinfo($oldFile,PATHINFO_BASENAME);
            if(Storage::delete('public/'.$loc.'/'.$old)){
                return $this->addMedia($file,$loc);
            }
            else {
                return redirect()->back()->with('delete','Fail to Update File');
            }
    }




}
