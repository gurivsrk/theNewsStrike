<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\gallery;
use App\Http\Requests\StoregalleryRequest;
use App\Http\Requests\UpdategalleryRequest;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\fileSystem;
use App\Traits\FileHandler;
use Exception;

class GalleryController extends Controller
{

    use FileHandler;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(fileSystem $media)
    {
        $media = $media->get();
        return view('admin.gallery',compact(['media']));
    }


    public function store(StoregalleryRequest $request, fileSystem $media)
    {

        try{
            $this->addMedia($request->file('dropZoneImage'),'media');
            $media = $media->all();
            return view('partials.galleryView',compact(['media']));
        }
        catch(Exception $err){
            return $err;
        }

    }

    public function destroy(gallery $gallery)
    {
        abort_if(Gate::denies('admin'), Response::HTTP_UNAUTHORIZED, '401 unauthorized');
    }

    public function massDestroy(Request $request)
    {

    abort_if(Gate::denies('admin'), Response::HTTP_UNAUTHORIZED, '401 unauthorized');

       $media = fileSystem::whereIn('id',$request->post('ids'))->get();
        foreach ($media as $media) {
            if(Storage::delete('public/media/'.$media->fileName)){
                $media->delete();
            }
        }

        $media = $media->all();
        return view('partials.galleryView',compact(['media']));
    }
}
