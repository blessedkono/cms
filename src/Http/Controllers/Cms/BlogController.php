<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Http\Requests\Resource\BlogRequest;
use App\Models\Cms\Blog;
use App\Repositories\Cms\BlogCategoryRepository;
use App\Repositories\Cms\BlogRepository;
use App\Repositories\System\DocumentResourceRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

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

        return redirect()->route('cms.blog.show',$blog->uuid);
//        return response()->json($blog,200);
    }

    //show the blog profile
    public function show(Blog $blog)
    {
        return view('cms.blog.show.show')
            ->with('blog',$blog);
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
        $categories = (new BlogCategoryRepository())->queryActive()->pluck('name','id');
        return view('cms.blog.edit.edit')
            ->with('categories',$categories)
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

    //publish blog
    public function publish(Blog $blog)
    {
        $this->blogs->publish($blog);
        return redirect()->back()->withFlashSuccess(trans('label.blog.published'));
    }

    //change status
    /*change the status of a client*/
    public function changeStatus(Blog $blog)
    {
        $status = $blog->isactive;
        switch ($status){
            case 1;
                $this->blogs->changeStatus($blog,0);
                return redirect()->back()->withFlashSuccess(trans('alert.general.deactivated'));
                break;

            case 0:
                $this->blogs->changeStatus($blog,1);
                return redirect()->back()->withFlashSuccess(trans('alert.general.activated'));
                break;
            default :
                return redirect()->back();

                break;

        }
    }

    //upload tempo pic file
    public function uploadTemporaryFiles(Request $request)
    {
        $input= $request->all();
        foreach ($input as $key => $value) {
            if (strpos($key, 'files') !== false) {
                (new DocumentResourceRepository())->saveDocument($input['blog_id'],1,'files',$input);
            }
        };
    }

    /*remove task document*/

    public function removeDocument($uploaded_doc_id)
    {

        $blog = $this->blogs->query()->whereHas('documents', function ($query) use ($uploaded_doc_id) {
            $query->where('document_resource.id', $uploaded_doc_id);
        })->first();

        $tender = $this->blogs->removeTaskDocument($uploaded_doc_id);

        return redirect()->route('cms.blog.show',$blog)->withFlashSuccess(__(''));
    }





    /**
     *list all blog
     */
    public function getAllForDt()
    {
        $result_list = $this->blogs->getAllForDt();
        return DataTables::of($result_list)
            ->addIndexColumn()
            ->addColumn('category', function ($blog) {
                return isset($blog->category_id) ? $blog->category_id : '';
            })  ->addColumn('publish_on', function ($blog) {
                return short_date_format($blog->publish_date);
            })  ->addColumn('status', function ($blog) {
                return ($blog->isactive == 1) ? trans('label.active') : trans('label.inactive');
            })
            ->rawColumns(['status',])
            ->make(true);


}


}
