<?php

namespace nextbytetz\websitecms\Http\Controllers\Resource;


use App\Http\Controllers\Controller;
use App\Http\Requests\Information\Announcement\CreateAnnouncementRequest;
use App\Http\Requests\Sysdef\ReportIssueRequest;
use App\Models\Cms\Blog;
use App\Models\Cms\Category;
use App\Models\Information\Announcement;
use App\Repositories\Cms\BlogCategoryRepository;
use App\Repositories\Cms\BlogRepository;
use App\Repositories\Information\AnnouncementRepository;
use App\Repositories\Sysdef\ReportIssueRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BlogController extends Controller
{

    protected $announcements;

    public function __construct(){


    }


    /**
     * Display a listing of the resource.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \App\Exceptions\GeneralException
     */
    public function index()
    {
        $blogs = (new BlogRepository())->queryActive()->where('status',1)->get();
        $latest_blogs = (new BlogRepository())->getLatestPost();
        $blog_categories = (new BlogCategoryRepository())->queryActive()->get();
        return view('system.blog.index')
            ->with('blogs',$blogs)
            ->with('latest_blogs',$latest_blogs)
            ->with('blog_categories',$blog_categories);
    }

    //show blog details
    public function show(Blog $blog)
    {

        $latest_blogs = (new BlogRepository())->getLatestPost();
        $blog_categories = (new BlogCategoryRepository())->queryActive()->get();

        return view('system.blog.show.show')
            ->with('blog',$blog)
            ->with('latest_blogs',$latest_blogs)
            ->with('blog_categories',$blog_categories);


    }

    public function getBlogByCategory($category_id)
    {
        $category = (new BlogCategoryRepository())->find($category_id);
        $blogs = $category->blogs()->where('isactive',1)->get();
        $latest_blogs = (new BlogRepository())->getLatestPost();
        $blog_categories = (new BlogCategoryRepository())->queryActive()->get();
        return view('system.blog.index')
            ->with('blogs',$blogs)
            ->with('latest_blogs',$latest_blogs)
            ->with('blog_categories',$blog_categories);
    }




}
