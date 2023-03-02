<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Blog;
use App\Models\Category;
use App\Models\tags;
use App\Models\SeoTable;


class BlogController extends Controller
{

    private function tags($tags, $blogId){
        $tags = Category::addNewTags($tags);
        foreach($tags as $tag){
            tags::create([
                'tag_id' => $tag,
                'blog_id' => $blogId
            ]);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function index(Blog $blog)
    {
        $blogs = $blog->paginate(20);
        return view('admin.posts.index',compact(['blogs']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $authors = User::select('name','id')->get();
        $categories = Category::select('name','id')->where('type','category')->get();
        return view('admin.posts.create',compact(['authors','categories']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBlogRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogRequest $request)
    {
        $data = $request->all();
        $data['category'] = Category::addNewCategory($request->category);
        $post = Blog::create($data);

        $this->tags($request->tags, $post['id']);

        SeoTable::create([
            'page_id'=>$post['id'],
            'meta_title'=>$request->meta_title??$post->title,
            'meta_keywords' => $request->meta_keywords??null,
            'meta_descritpions' => $request->meta_descritpions??null,

        ]);
        return 'Post Created Successfully';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        $authors = User::select('name','id')->get();
        $categories = Category::select('name','id')->where('type','category')->get();
        $data = SeoTable::select('meta_title','meta_keywords','meta_descritpions','misc')->where('page_id',$blog->id)->first();
        return view('admin.posts.create',compact(['authors','categories','blog','data']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBlogRequest  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        tags::where('blog_id',$blog->id)->delete();

        SeoTable::where('page_id',$blog->id)->update([
            'meta_title'=>$request->meta_title,
            'meta_keywords' => $request->meta_keywords,
            'meta_descritpions' => $request->meta_descritpions,
        ]);

        $this->tags($request->tags, $blog->id);

        $request = $request->all();

        $blog->update($request);

        return 'Updated Successfully';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->back()->with('Deleted Successfully');
    }
}
