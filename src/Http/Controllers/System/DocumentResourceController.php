<?php

namespace nextbytetz\websitecms\Http\Controllers\System;


use App\DataTables\System\RetrieveSysdefGroupsDataTable;
use App\DataTables\System\RetrieveSysDefinitionsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\System\AttachDocResourceRequest;
use App\Models\System\Document;
use App\Repositories\System\DocumentRepository;
use App\Repositories\System\DocumentResourceRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use OwenIt\Auditing\Models\Audit;
use Yajra\Datatables\Datatables;

class DocumentResourceController extends Controller
{

    protected $doc_resource_repo;

    public function __construct()
    {

        $this->doc_resource_repo = new DocumentResourceRepository();
    }



    /*Attach document*/
    public function attachDocument($resource_id)
    {
        $return_url = request()->url();
        $document_types = Document::query()->pluck('name', 'id');
        $allowed_formats = ['pdf', 'image'];
            return view('system/document_resource/attach_doc')
            ->with('document_types', $document_types)
            ->with('return_url', $return_url)
            ->with('resource_id', $resource_id)
            ->with('allowed_formats', serialize($allowed_formats));
    }




    /*Store document*/
    public function storeDocument(AttachDocResourceRequest $request)
    {
        $input = $request->all();
        $return_page = isset($input['return_page']) ? 1 : 0;
        $return_url = $input['return_url'];
        $resource_id = $input['resource_id'];
        $document_id = $input['document_id'];

        /*Save document*/
        $this->doc_resource_repo->saveDocument($resource_id, $document_id,'document_file', $input);

        /*Store document*/
        if($return_page == 1)
        {
            return redirect()->back()->withFlashSuccess(__('alert.system.document.attached'));
        }else{
            return redirect($return_url)->withFlashSuccess(__('alert.system.document.attached'));
        }

    }


    /**
     * @param $doc_pivot_id
     * @return mixed
     * Edit document
     */
    public function editDocument($doc_pivot_id)
    {
        $uploaded_doc = DB::table('document_resource')->where('id', $doc_pivot_id)->first();
        $document = (new DocumentRepository())->find($uploaded_doc->document_id);
        $return_url = request()->url();
        $allowed_formats = ['pdf', 'image'];

             return view('system/document_resource/edit_doc')
            ->with('document',  $document)
            ->with('document_resource',  $uploaded_doc)
            ->with('return_url', $return_url)
            ->with('allowed_formats', serialize($allowed_formats));
    }



    /**
     * @return mixed
     * update document
     */
    public function updateDocument(AttachDocResourceRequest $request)
    {
        $input = $request->all();
        $return_url = $input['return_url'];
        $resource_id = $input['resource_id'];
        $document_id = $input['document_id'];
        $this->doc_resource_repo->saveDocument($resource_id, $document_id, 'document_file', $input);
        return redirect($return_url)->withFlashSuccess(__('alert.system.document.updated'));
    }


    /*Delete document*/
    public function deleteDocumentWithReturn($doc_pivot_id)
    {
        $this->doc_resource_repo->deleteDocument($doc_pivot_id);
        return redirect()->back()->withFlashSuccess(__('alert.system.document.removed'));
    }


    /*Preview document*/
    public function previewDocument($doc_pivot_id)
    {
        $uploaded_doc = DB::table('document_resource')->where('id', $doc_pivot_id)->first();
        $url = $this->doc_resource_repo->getDocFullPathUrl($doc_pivot_id);
        return response()->json(['success' => true, "url" => $url, "name" => $uploaded_doc->description, "id" => $doc_pivot_id]);

    }

    /*Open Document*/
    public function openDocument($doc_pivot_id)
    {
        $document =$this->doc_resource_repo->getDocFullDir($doc_pivot_id);
        return response()->file($document);

    }

}
