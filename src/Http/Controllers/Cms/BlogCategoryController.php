<?php


namespace App\Http\Controllers\Cms;


use App\Http\Controllers\Controller;
use App\Models\Cms\Category;
use App\Repositories\Cms\BlogCategoryRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BlogCategoryController extends Controller
{
    protected  $blog_categories;
    public function __construct()
    {
        $this->blog_categories = new BlogCategoryRepository();
    }

    public function index()
    {
        return view('cms.blog.categories.index');
    }


    public function create()
    {
        return view('cms.blog.categories.create');
    }

    public function edit(Category $blog_category)
    {
        return view('cms.blog.categories.edit')
            ->with('blog_category',$blog_category);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $blog_category = $this->blog_categories->store($input);
        return redirect()->route('cms.category.index')->withFlashSuccess(__('alert.general.created'));
    }

    public function update(Request $request,Category $blog_category)
    {
        $input = $request->all();
        $blog_category = $this->blog_categories->update($blog_category,$input);
        return redirect()->route('cms.category.index')->withFlashSuccess(__('alert.general.updated'));
    }

    public function delete(Category $blog_category)
    {
        $this->blog_categories->delete($blog_category);
        return redirect()->route('cms.category.index')->withFlashSuccess(__('alert.general.deleted'));
    }


    /*change status of employee allowance type*/
    public function changeStatus(Category $blog_category)
    {
        $status = $blog_category->isactive;
        switch ($status){
            case 1;
                $this->blog_categories->changeStatus($blog_category,0);
                return redirect()->back();
                break;

            case 0:
                $this->blog_categories->changeStatus($blog_category,1);
                return redirect()->back();
                break;
            default :
                return redirect()->back();
                break;

        }
    }
    /**
     *list all PayeRange
     */
    public function getAllForDt()
    {
        $result_list = $this->blog_categories->getAllForDatatable();
        return DataTables::of($result_list)
            ->addIndexColumn()
            ->addColumn('actions', function ($result_list)
            {
                return $result_list->edit_button .'  '  .'  ' .$result_list->change_status_button;
            })
            ->addColumn('status', function ($result_list)
            {
                return $result_list->blog_category_status_label ;
            })->rawColumns(['actions','status','name'])
            ->make(true);
    }



}
