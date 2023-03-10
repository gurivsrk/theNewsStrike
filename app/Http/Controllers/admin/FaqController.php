<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\StoreFaqRequest;
use App\Models\Faq;
use App\Models\Category;

class FaqController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function index()
    {

        $item = Faq::all();
        $Category = Category::where('for','Faq')->orwhere('for','other')->get();

      return view('admin.faqs.index',compact(['item','Category']));
    }

    public function create()
    {
        $categories = Category::where('for','Faq')->orwhere('for','other')->get();
        return view('admin.faqs.create',compact(['categories']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFaqRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFaqRequest $request)
    {
        $data = $request->all();

        $tags = Category::addNewTags($request->category_id,'category','faqs');
        $data['category_id'] = $tags[0];
        Faq::create($data);

        return redirect()->back()->with('success','Successfully added Faq');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Faq  $Faq
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Faq = Faq::findOrFail($id);
        $item = Faq::all();
        $Category = Category::where('for','Faq')->orwhere('for','other')->get();
        $type = 'edit-Faq';

      return view('pages.faq',compact(['Faq','Category','item','type']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFaqRequest  $request
     * @param  \App\Models\Faq  $Faq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $Faq = Faq::findOrFail($id);
        $data = $request->all();
        echo $Faq->update($data);

        return redirect()->route('Faq.index')->with('update', 'Successfull Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Faq  $Faq
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $Faq)
    {
        //
    }
}
