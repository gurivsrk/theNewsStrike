<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Http\Requests\StoreCodeMirrorRequest;
use App\Models\codeMirror;
use Exception;

class CodeMirrorController extends Controller
{

    private function codeFile($code,$all){
        try{
            $type= $all->post('type') =='javascript' ? 'js': strtolower($all->post('type'));
            $fielName = "public/customCode/".Str::slug($all->post('page_name')).'.'.$type;
            Storage::put($fielName,$code);
           return $fielName;

        }catch(Exception $err){
            return $err;
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = codeMirror::all();
        return view('admin.custom-code.index',compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.custom-code.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCodeMirrorRequest $request)
    {
        try{
            if($request->post('linking') === 'external'){
                $request['code'] = $this->codeFile($request->post('code'), $request);
            }
            $request['slug'] = $request->post('page_name');
            codeMirror::create($request->all());
            return redirect()->route('custom-code.index')->with('success','Successfully Added');
        }
        catch(Exception $err){
            return redirect()->route('custom-code.index')->withErrors($err);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = codeMirror::findOrFail($id);
        return view('admin.custom-code.create',compact(['data']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $codeMirror = codeMirror::findOrFail($id);
        try{

            if($codeMirror->linking === 'external') if(Storage::exists($codeMirror->code)) Storage::delete($codeMirror->code);

            if($request->post('linking') === 'external') $request['code'] = $this->codeFile($request->post('code'),$request);

            $request['slug'] = $request->post('page_name');
            $codeMirror->update($request->all());
            return redirect()->back()->with('success','Successfully updated');
        }
        catch(Exception $err){
            return redirect()->route('custom-code.index')->withErrors($err);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = codeMirror::findOrFail($id);
        if($page->linking === 'external'){
            if(Storage::exists( $page ->code)) Storage::delete($page ->code);
        }
        $page->delete();
        return redirect()->back()->with('success','Successfully Deleted');
    }


}
