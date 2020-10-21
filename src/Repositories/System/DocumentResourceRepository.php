<?php

namespace App\Repositories\System;


use App\Models\System\Document;
use App\Repositories\BaseRepository;
use App\Services\Storage\Traits\AttachmentHandler;
use App\Services\Storage\Traits\FileHandler;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DocumentResourceRepository extends BaseRepository
{

    use AttachmentHandler, FileHandler;



    /*Find document resource by Id*/
    public function findDocumentResource($doc_pivot_id)
    {
        return DB::table('document_resource')->where('id', $doc_pivot_id)->first();
    }

    /*Get document type*/
    public function getDocumentTypeFromPivotId($doc_pivot_id)
    {
        $document_resource = $this->findDocumentResource($doc_pivot_id);
        $document = (new DocumentRepository())->find($document_resource->document_id);
        return $document;
    }

    /*Get doc full path for review*/
    public function getDocFullPathUrl($doc_pivot_id)
    {
        $document_resource = $this->findDocumentResource($doc_pivot_id);
        $document = $this->getDocumentTypeFromPivotId($doc_pivot_id);
        $top_path = $document->documentGroup->top_path;
        $filename = $document_resource->id . '.' . $document_resource->ext;
        $full_url = base_doc_path() . $top_path  .  DIRECTORY_SEPARATOR . $document_resource->document_id . DIRECTORY_SEPARATOR .  $document_resource->resource_id  . DIRECTORY_SEPARATOR . $filename;
        return $full_url;
    }


    /*Get doc full path for saving to storage*/
    public function getDocFullDir($doc_pivot_id)
    {
        $document_resource = $this->findDocumentResource($doc_pivot_id);
        $document = $this->getDocumentTypeFromPivotId($doc_pivot_id);
        $top_path = $document->documentGroup->top_path;
        $filename = $document_resource->id . '.' . $document_resource->ext;
        $full_dir = base_doc_dir() . $top_path . DIRECTORY_SEPARATOR .   $document_resource->document_id . DIRECTORY_SEPARATOR . $document_resource->resource_id . DIRECTORY_SEPARATOR .  $filename;
        return $full_dir;
    }



    /**
     * @param array $input
     * @param
     *  * Save document - MAIN FUNCTION For saving document - Call this
     */
    public function saveDocument($resource_id, $document_id, $document_file_input_key,array $input)
    {
        return DB::transaction(function () use ($input, $resource_id, $document_id, $document_file_input_key) {
            $check_if_recurring = (new DocumentRepository())->checkIfDocumentIsRecurring($document_id);
            $resource = (new DocumentRepository())->getResourceInstance($document_id, $resource_id);
            $ext = $this->getDocExtension($document_file_input_key);

            if($check_if_recurring == false)
            {
                /*for non recurring document*/
                $check_if_exist = $this->checkIfDocumentExistForResource($resource->id, $document_id);
                if($check_if_exist == false){
                    /*if not exists - Attach new*/
                    $document_resource =   $this->savePivotDocument($resource,$document_id, $document_file_input_key, $input);
                }else{
//                    $uploaded_doc = $resource->documents()->where('document_id', $document_id)->orderBy('id', 'desc')->first();
                    $uploaded_doc = DB::table('document_resource')->where('resource_id', $resource->id)->where('document_id', $document_id)->orderBy('id', 'desc')->first();
                    $document_resource =  $this->updatePivotDocument($uploaded_doc->id, $document_file_input_key, $input);
                }

                /*Attach to storage*/
                $this->attachDocFileToStorage($document_resource->id, $document_file_input_key);
            }else{
                /*for recurring documents*/
                $check_if_exist = isset($input['doc_pivot_id']) ? true : false;

                if($check_if_exist){
                    /*Exist - update*/
                    $document_resource =   $this->updatePivotDocument($input['doc_pivot_id'],$document_file_input_key, $input);
                }else{

                    /*Does not exist - Add new*/
                    $document_resource =   $this->savePivotDocument($resource,$document_id, $document_file_input_key, $input);
                }

                if($document_resource){
                    /*Attach to storage*/
                    $this->attachDocFileToStorage($document_resource->id, $document_file_input_key);
                }

            }
        });
    }


    /*Save into pivot table of document*/
    public function savePivotDocument($resource,$document_id, $document_file_input_key, array $input)
    {
        $check_if_exist = $this->checkIfDocumentExistForResource($resource->id, $document_id);
        $file = request()->file($document_file_input_key);
        if($file->isValid()) {
            $resource->documents()->attach([$document_id => [
                'name' => $file->getClientOriginalName(),
                'description' =>  isset($input['document_title']) ? $input['document_title'] : $file->getClientOriginalName(),
                'size' => $file->getSize(),
                'mime' => $file->getMimeType(),
                'ext' => $file->getClientOriginalExtension(),
                'updated_at' => Carbon::now(),
                     'user_id' => access()->id(),
            ]]);
        }
        /*Return inserted document resource*/
//        $document_resource =  $resource->documents()->where('document_id', $document_id)->orderBy('id', 'desc')->first();
        $document_resource = DB::table('document_resource')->where('resource_id', $resource->id)->where('document_id', $document_id)->orderBy('id', 'desc')->first();

        return ($document_resource) ? $document_resource : null;

    }

    /*Update pivot table of document*/
    public function updatePivotDocument($doc_pivot_id,$document_file_input_key, array $input)
    {
        $file = request()->file($document_file_input_key);
        if($file->isValid()) {
            DB::table('document_resource')->where('id', $doc_pivot_id)->update([
                'name' => $file->getClientOriginalName(),
                'description' =>  isset($input['document_title']) ? $input['document_title'] : $file->getClientOriginalName(),
                'size' => $file->getSize(),
                'mime' => $file->getMimeType(),
                'ext' => $file->getClientOriginalExtension(),
                'updated_at' => Carbon::now()
            ]);
        }
        /*Document resource*/
        $document_resource =  $this->findDocumentResource($doc_pivot_id);
        return $document_resource;
    }


    /*Attach doc to server storage*/
    public function attachDocFileToStorage($doc_pivot_id, $document_file_input_key)
    {
        /*Attach document to server*/
        $document_resource = $this->findDocumentResource($doc_pivot_id);
        $document = $this->getDocumentTypeFromPivotId($doc_pivot_id);
        $document_group = $document->documentGroup;
        $path = base_doc_dir() . $document_group->top_path  . DIRECTORY_SEPARATOR .  $document_resource->document_id . DIRECTORY_SEPARATOR . $document_resource->resource_id . DIRECTORY_SEPARATOR ;
        $filename = $document_resource->id . '.' . $document_resource->ext;
        $this->makeDirectory($path);
        $this->saveDocumentBasic($document_file_input_key,$filename, $path );
    }


    /*Delete document*/
    public function deleteDocument($doc_pivot_id)
    {
        $document_resource = $this->findDocumentResource($doc_pivot_id);
        $document = $this->getDocumentTypeFromPivotId($doc_pivot_id);
        $document_group = $document->documentGroup;
        $path = base_doc_dir() . $document_group->top_path  . DIRECTORY_SEPARATOR .  $document_resource->document_id . DIRECTORY_SEPARATOR . $document_resource->resource_id . DIRECTORY_SEPARATOR;
        $filename = $document_resource->id . '.' . $document_resource->ext;
        $file_path = $path . $filename;
        if (file_exists($file_path)) {
            unlink($file_path);
        }
        /*delete*/
        DB::table('document_resource')->where('id', $doc_pivot_id)->delete();
    }


    /* Check if document exists for this resource */
    public function checkIfDocumentExistForResource($resource_id, $document_id)
    {
        $check = DB::table('document_resource')->where('resource_id', $resource_id)->where('document_id', $document_id)->count();
        if($check > 0)
        {
            return true;
        }else{
            return false;
        }
    }

    /* Check if document recurring exists for this resource */
    public function checkIfDocumentRecurringExistForResource($doc_pivot_id)
    {
        $check = DB::table('document_resource')->where('id', $doc_pivot_id)->count();
        if($check > 0)
        {
            return true;
        }else{
            return false;
        }
    }



    /*Get Document resource attached*/
    public function getDocumentTypesAttachedForResource($resource_id)
    {
        $doc_types_ids = DB::table('document_resource')->where('resource_id', $resource_id)->select('document_id')->distinct()->pluck('document_id');
        $docs = Document::query()->whereIn('id',  $doc_types_ids)->get();
        return $docs;
    }



    /**
     * @param Model $resource
     * @param $reference
     * @return bool
     */
    public function updateResourceType(Model $resource, $document_id)
    {
        $document = Document::query()->find($document_id);
        $resource->documents()->save($document);
    }

}
