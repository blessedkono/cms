<?php


namespace App\Repositories\Cms;


use App\Models\Cms\Category;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BlogCategoryRepository extends BaseRepository
{
    const MODEL = Category::class;
    public function __construct()
    {

    }


    /*Insert/create PaylollCompliance*/
    public function store(array $input)
    {
        return DB::transaction(function() use($input){
            $blog_category = $this->query()->firstOrCreate([
                'name' => $input['name'],
                'short_name' => $input['short_name'],
                'isactive' => $input['status'],
            ]);
            return $blog_category;
        });
    }

    /*Modify PaylollCompliance*/
    public function update(Model $blog_category, array $input)
    {
        return DB::transaction(function() use($blog_category,$input){
            $blog_category->update([
                'name' => $input['name'],
                'short_name' => $input['short_name'],
                'isactive' => $input['status'],
            ]);
            return $blog_category;
        });
    }

    /*Destroy / remove PaylollCompliance*/
    public function delete(Model $blog_category)
    {
        $blog_category->delete();
    }

    public function getAllForDatatable()
    {
        $query = $this->query()->get()->sortByDesc('id');;
        return $query;
    }




}
