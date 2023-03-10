<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
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
            case 'posts':
               $blogs = $this->getResult(new Blog, $request->post('search'), 'title', 'content');
                return view('partials.table',compact(['blogs']));
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
                $this->middleware('auth');
                $media = fileSystem::findOrFail($request->post('id'));
                $media->update([
                    $request->post('type') => $request->post('data')
                ]);
                return true;
            break;
            case 'insertImage':
                $this->middleware('auth');
                $media = fileSystem::findOrFail($request->post('id'));
                return  $media;
            break;
        }

    }

    public function dynaTags(request $request,Category $category){
        $this->middleware('auth');
        $incomeData = strtolower($request->post('input'));
        $outgoingData = '';
        if(strlen($incomeData) > 3){
            $outgoingData =  $category->select('id','name')->where('name','like', "$incomeData%")->where('type','tag')->get();
        }
        return $outgoingData ;
    }

    public function uploadCkImage(Request $request){
        $this->middleware('auth');
        if ($request->hasFile('upload')) {
            $url = $this->addMedia($request->file('upload'),'ckeditor');
            return response()->json(["url"=> $url]);
        }
    }

    public function changeStatus(Request $request){
        $this->middleware('auth');

        $status = $request->status ? '' : true;
        $msg = $request->status ? 'Unpublished successfully' : $request->type.' is visible now!';
        if($request->type == "Post"){
            Blog::where('id',$request->id)->update([
                'status' => $status
            ]);
        }

        // echo ($request->id . $request->type . $request->status);
        return $msg;

    }
    protected function getResult($tableObj, $search, $column1,$column2)
    {
        return $tableObj->where($column1,'LIKE','%'.$search.'%')
                ->orWhere($column2,'LIKE','%'.$search.'%')
                ->get();
    }
}
