<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Traits\FileHandler;

class HomeController extends Controller
{
    use FileHandler;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    public function post_upload(Request $request){

        try{

            if($request->file('file')){
                $file = $request->file('file');
                $destinationPath = 'uploads';
                // If the uploads fail due to file system, you can try doing public_path().'/uploads'
                // $filename = Str::random(12);
                // $filename = $file->getClientOriginalName();
                // $extension =$file->getClientOriginalExtension();
               // $upload_success = $request->file('file')->move($destinationPath,$file);
               return $file->getClientOriginalName();
                // if( $upload_success ) {
                // } else {
                //    return response()->json('error', 400);
                // }
            }
            else{
                $this->addMedia($request->file('file'),'test');
                 dd($request->all());
            }
        }
        catch(Exception $err){
            return response()->json($err, 400);
        }
    }
}
