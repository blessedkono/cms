<?php

namespace App\Repositories\System;


use App\Models\Auth\User;
use App\Models\Cms\Blog;
use App\Models\Cms\Client;
use App\Models\System\Document;
use App\Repositories\BaseRepository;

class DocumentRepository extends BaseRepository
{
    const MODEL = Document::class;




    public function getDocumentsByGroupFilter(array $filter)
    {
        $documents = $this->query()
            ->where('isactive',1)
            ->whereHas('documentGroup', function ($query) use($filter){
                $query->whereIn('document_group_id', $filter);
            })->get();
        return $documents;
    }



    /**
     * @param $id
     * @return bool
     * Check if document is recurring
     */
    public function checkIfDocumentIsRecurring($id)
    {
        $document = $this->find($id);
        if($document->isrecurring == 1){
            return true;
        }else{
            return false;
        }
    }






    /*Get Resource from document id from definition for each document group*/
    public function getResourceInstance($document_id, $resource_id)
    {
        $document = (new DocumentRepository())->find($document_id);
        $document_group_id = $document->document_group_id;
        $resource = null;
        switch($document_id){
            case 1:

                $resource = Blog::query()->find($resource_id);
                break;
                case 2:
                    $resource = Client::query()->find($resource_id);
                break;


        }

        return $resource;
    }





}
