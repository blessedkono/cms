<?php


namespace App\Http\Controllers\Cms;


use App\Models\Cms\ModuleFunctionalPart;
use App\Repositories\BaseRepository;
use App\Repositories\System\DocumentResourceRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ModulefunctionalPartRepository extends BaseRepository
{

    const MODEL = ModuleFunctionalPart::class;
    /**
     * ModulefunctionalPartRepository constructor.
     */
    public function __construct()
    {
    }

    /*Insert/create ModulefunctionalPart*/
    public function store(array $input)
    {
        return DB::transaction(function() use($input){
            $module_functional_part = $this->query()->create([
                'isactive' => $input['isactive'],
                'description' => $input['description'],
                'module_id' => $input['module_id'],
                'title' => $input['title'],
                'navigation_link' => $input['navigation_link'],
                'medial_link' => $input['media_link'],
//                'user_id' => access()->id(),
            ]);
            /*Save document(s) attached*/
            $this->saveDocuments($module_functional_part->id,$input);
            return $module_functional_part;
        });
    }

    /*Modify ModulefunctionalPart*/
    public function update(Model $module_functional_part, array $input)
    {
        return DB::transaction(function() use($module_functional_part,$input){
            $module_functional_part->update([
                'isactive' => $input['isactive'],
                'description' => $input['description'],
                'module_id' => $input['module'],
                'title' => $input['title'],
                'navigation_link' => $input['navigation_link'],
                'medial_link' => $input['media_link'],
            ]);
            /*Save document(s) attached*/
            $this->saveDocuments($module_functional_part->id,$input);
            return $module_functional_part;
        });
    }

    /*Destroy / remove ModulefunctionalPart*/
    public function delete(Model $module_functional_part)
    {
        $module_functional_part->delete();
    }

    /*Get all for Datatable ModulefunctionalPart*/
    public function getAllForDt()
    {
        $query = $this->query();
        return $query;
    }

    /*Save document(s) attached on the form*/
    public function saveDocuments($module_functional_part_id, array $input)
    {
        foreach ($input as $key => $value) {
            if (strpos($key, 'document_file') !== false) {
                $file_id = substr($key, 13);
                $key_file_name = 'document_file'.$file_id;
                $document_id = 3;//task document id
                $document_title = $file_id;
//                $this->attachTaskDocuments($task, $document_id, $key_file_name,$document_title,$input);
                (new DocumentResourceRepository())->saveDocument($module_functional_part_id,$document_id,$key_file_name,$input);
            }
        };

    }


}
