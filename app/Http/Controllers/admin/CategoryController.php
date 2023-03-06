<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Category;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $cat)
    {
        $category = $cat->paginate(15);
        return view('admin.category.index',compact(['category']));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

            if($request->file('logo')){
                $imgname = $this->addMedia($request->file('logo'),'logos');
                $data['logo'] = $imgname;
            }
            category::create($data);

            return redirect()->back()->with('success','Successfully Added');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $type = 'edit-catetag';
        $category = category::all();
        $cateUpdate = category::findOrFail($id);
        return view('admin.category.index',compact(['cateUpdate','category','type']));
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
        $category = category::findOrFail($id);
        $data = $request->all();
        if($request->hasFile('logo')){
            if(!empty($category->logo)){
                !empty($category->logo) ? $data['logo'] =  $this->updateMedia( $category->logo ,$request->file('logo'),'logos') : $data['logo'] = $this->addMedia($request->file('logo'),'logos');
            }
            else{
                $data['logo'] = $this->addMedia($request->file('logo'),'logos');
            }
        }
        $category->update($data);

        return redirect()->route('cateTag.index')->with('update','Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = category::findOrFail($id);

        if(empty($category->logo)){
            $category->delete();
        }
        else{
            $image = pathinfo($category->logo,PATHINFO_BASENAME);
            if(Storage::delete('public/logos/'.$image)){
                $category->delete();
            }
            else {
                return redirect()->back()->with('delete','Fail to delete');
            }

        }
        return redirect()->back()->with('success','Deleted Successfully');
    }
}
