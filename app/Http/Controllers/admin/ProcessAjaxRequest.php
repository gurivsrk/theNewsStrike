<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

use App\Models\fileSystem;
use App\Traits\FileHandler;

class ProcessAjaxRequest extends Controller
{

    use FileHandler;

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
            case 'insertImage':
                $media = fileSystem::findOrFail($request->post('id'));
                return  $media;
            break;
        }

    }

    public function dynaTags(request $request,Category $category){
        $incomeData = strtolower($request->post('input'));
        $outgoingData = '';
        if(strlen($incomeData) > 3){
            $outgoingData =  $category->select('id','name')->where('name','like', "$incomeData%")->where('type','tag')->get();
        }
        return $outgoingData ;
    }

    public function uploadCkImage(Request $request){
        if ($request->hasFile('upload')) {
            $url = $this->addMedia($request->file('upload'),'ckeditor');
            return response()->json(["url"=> $url]);
        }
    }

    protected function getResult($tableObj, $search, $column1,$column2)
    {
        return $tableObj->where($column1,'LIKE','%'.$search.'%')
                ->orWhere($column2,'LIKE','%'.$search.'%')
                ->get();
    }
}
