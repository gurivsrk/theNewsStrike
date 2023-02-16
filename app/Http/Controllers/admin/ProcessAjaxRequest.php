<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\fileSystem;

class ProcessAjaxRequest extends Controller
{
    public function ajaxRequest(Request $request){
        switch($request->post('dataFor')){
            case 'gallery':
               $media = fileSystem::where('fileName','LIKE','%'.$request->post('search').'%')
                ->orWhere('alt','LIKE','%'.$request->post('search').'%')
                ->get();
                return view('partials.galleryView',compact(['media']));
            break;
        }
    }
}
