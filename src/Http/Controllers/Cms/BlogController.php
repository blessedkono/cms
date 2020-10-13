<?php

namespace Nextbyte\Cms\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\Cms\Blog;
use App\Repositories\Cms\BlogCategoryRepository;
use App\Repositories\Cms\BlogRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BlogController extends Controller
{
    /**
     * DashboardController constructor.
     */
    protected $blogs;
    public function __construct()
    {
//        $this->middleware('auth');
        $this->blogs = new BlogRepository();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::all();
        return view('cms.blog.index')
            ->with('blogs',$blogs);
    }

    //create blog
    public function create()
    {
        $categories = (new BlogCategoryRepository())->queryActive()->pluck('name','id');
        return view('cms.blog.create.create')
            ->with('categories',$categories);

    }

    //store blog
    public function store(Request $request)
    {
        $input = $request->all();
        $blog = (new BlogRepository())->store($input);
        return response()->json($blog,200);
    }

    //view blog
    public function viewBlog(Request $request)
    {
        $input = $request->all();
        $blog = Blog::find($input['blog_id']);
        $html = view('cms.blog.show.includes.blog_details',compact('blog'))->render();
        return response()->json(['data' =>$blog,'html' =>$html]);
    }

    //get note by id for edit modal
    public function getBlogByIdForEdit(Request $request)
    {
        $input =$request->all();
        $blog = $this->blogs->find($input['blog_id']);
        return response()->json($blog);
    }
    //edit blog
    public function edit(Blog $blog)
    {
        return view('cms.blog.edit.edit')
            ->with('blog',$blog);
    }

    //update note
    public function update(Request $request)
    {
        $input = $request->all();
        $blog = (new BlogRepository())->find($input['blog_id']);
        $blog = $this->blogs->update($input,$blog);
        return response()->json($blog);

    }

    //delete note
    public function delete(Request $request)
    {
        $input = $request->all();
        $blog = $this->blogs->find($input['blog_id']);
        $this->blogs->delete($blog);
        return response()->json($blog);

    }

    //upload tempo pic file
    public function uploadTemporaryFiles()
    {

    }




}
