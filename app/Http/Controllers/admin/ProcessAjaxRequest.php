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
               $media = $this->getResult(new fileSystem, $request->post('search'), 'fileName', 'alt');
                return view('partials.galleryView',compact(['media']));
            break;
            case 'showModel':
                $media = fileSystem::findOrFail($request->post('search'));
                return view('partials.galleryModel',compact(['media']));
            break;
            case 'showImageAjax':
                $media = fileSystem::all();
                return view('partials.gallery',compact(['media']));
            break;
            case 'updateImageDetails':
                $media = fileSystem::findOrFail($request->post('id'));
                $media->update([
                    $request->post('type') => $request->post('data')
                ]);
                return true;
            break;
        }

    }

    protected function getResult($tableObj, $search, $column1,$column2)
    {
        return $tableObj->where($column1,'LIKE','%'.$search.'%')
                ->orWhere($column2,'LIKE','%'.$search.'%')
                ->get();
    }
}
