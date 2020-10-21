<?php

namespace App\Repositories\System;

use App\Models\System\Country;
use App\Models\System\DocumentGroup;
use App\Repositories\BaseRepository;
use App\Services\Storage\Traits\AttachmentHandler;
use App\Services\Storage\Traits\FileHandler;

class DocumentGroupRepository extends BaseRepository
{

    const MODEL = DocumentGroup::class;

    use AttachmentHandler, FileHandler;

    /**
     * @param $id
     * @return mixed
     * Get documents belong to document group provided
     */
    public function getDocumentsByGroup($id)
    {
        $document_group = $this->find($id);
        $documents = $document_group->documents;
        return $documents;
    }




    /*Make directory for all top path*/
    public function makeDirectoryTopPath()
    {
        $doc_groups = $this->query()->get();
        foreach ($doc_groups as $doc_group){
            $top_path = $doc_group->top_path;
            if($top_path){
                $path = base_doc_dir() . $top_path;
                $this->makeDirectory($path);
            }
        }
    }



}