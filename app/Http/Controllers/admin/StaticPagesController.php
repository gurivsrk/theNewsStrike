<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Gate;
use App\Models\staticPages;
use Illuminate\Support\Facades\Request as FacadesRequest;

class StaticPagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\staticPages  $staticPages
     * @return \Illuminate\Http\Response
     */
    public function edit(staticPages $staticPages,$id)
    {
        $data = $staticPages->getAllFields($id);

        return view('admin.'.$id,compact(['data']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatestaticPagesRequest  $request
     * @param  \App\Models\staticPages  $staticPages
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, staticPages $staticPages,$id)
    {
        $staticPages->updateFields($id,$request);
        return redirect()->back()->with('success','Successfully Updated');
    }
}
