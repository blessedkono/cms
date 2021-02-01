<?php


namespace App\Repositories\Cms;


use App\Models\Cms\Module;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class ModuleRepository extends BaseRepository
{

    const MODEL = Module::class;

    public function __construct()
    {

    }


    public function store(array $input)
    {
        DB::transaction(function ()use($input){
            $next_id = Module::max('id') + 1;
            $module = $this->query()->create([
                'id' => $next_id,
               'name' => $input['name'],
               'description' => $input['description'],
               'isactive' => $input['isactive'],
               'module_group_id' => $input['module_group_id']
           ]);

           return $module;
        });
    }

    public function update(array $input,$module)
    {
        DB::transaction(function ()use($input,$module){
            $next_id = Module::max('id') + 1;
            $module = $module->update([
                'id' => $next_id,
               'name' => $input['name'],
               'description' => $input['description'],
               'isactive' => $input['isactive'],
               'module_group_id' => $input['module_group_id']
           ]);

           return $module;
        });
    }

    public function delete($module)
    {
        $module->delete();
    }

}
