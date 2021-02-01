<?php


namespace App\Repositories\Cms;


use App\Models\Cms\ModuleGroup;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class ModuleGroupRepository extends BaseRepository
{

    const MODEL = ModuleGroup::class;

    public function __construct()
    {

    }


    public function store(array $input)
    {
        DB::transaction(function ()use($input){
            $next_id = ModuleGroup::max('id') + 1;
            $module_group = $this->query()->create([
                'id' => $next_id,
               'name' => $input['name'],
               'description' => $input['description'],
               'isactive' => $input['isactive']
           ]);

           return $module_group;
        });
    }

    public function update(array $input,$module_group)
    {
        DB::transaction(function ()use($input,$module_group){
            $next_id = ModuleGroup::max('id') + 1;
            $module_group = $module_group->update([
                'id' => $next_id,
               'name' => $input['name'],
               'description' => $input['description'],
               'isactive' => $input['isactive']
           ]);

           return $module_group;
        });
    }

    //delete module group
    public function delete($module_group)
    {
         $module_group->delete();
    }
}
