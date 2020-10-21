<?php


namespace App\Repositories\Cms;



use App\Models\Cms\Testimonial;
use App\Repositories\BaseRepository;
use App\Repositories\System\DocumentResourceRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ClientTestimonialRepository extends BaseRepository
{

    const MODEL = Testimonial::class;
    /**
     * ClientDiscountRepository constructor.
     */
    public function __construct()
    {
    }

    /*Insert/create ClientDiscount*/
    public function store(array $input)
    {
        return DB::transaction(function() use($input){
            $client_testimonial = $this->query()->create([
                'client_id' => $input['client_id'],
                'designation_id' => $input['designation_id'],
                'company_name' => $input['company_name'],
                'content' =>$input['content'] ,
            ]);

            return $client_testimonial;
        });
    }

    /*Modify ClientDiscount*/
    public function update(Model $client_testimonial, array $input)
    {
        return DB::transaction(function() use($client_testimonial,$input){

            $client_testimonial->update([
                'client_id' => $input['client_id'],
                'designation_id' => $input['designation_id'],
                'company_name' => $input['company_name'],
                'content' =>$input['content'] ,
            ]);

            return $client_testimonial;
        });
    }

    /*Destroy / remove ClientDiscount*/
    public function delete(Model $client_testimonial)
    {
        $client_testimonial->delete();
    }

    /*Get all discount */
    public function getQueryAllClientTestimonials()
    {
        return $this->query()->select([
            DB::raw('testimonials.id as id' ),
            DB::raw('testimonials.client_id as client_id' ),
            DB::raw('testimonials.designation_id as designation_id' ),
            DB::raw('testimonials.uuid as uuid' ),
            DB::raw('testimonials.company_name as company_name' ),
            DB::raw('clients.name as client_name' ),

        ])
            ->join('clients','clients.id','=','testimonials.client_id')
            ->leftjoin('designations','designations.id','=','testimonials.designation_id');
    }
    /*Get all for Datatable ClientDiscount*/
    public function getAllForDt()
    {
        $query = $this->getQueryAllClientTestimonials();
        return $query;
    }


    /*Save document(s) attached on the form*/
    public function saveDocuments($client_testimonial_id, array $input)
    {

        $document_resource_repo = new DocumentResourceRepository();
        foreach ($input as $key => $value) {
            if (strpos($key, 'discount_attachment') !== false) {
                $file_id = substr($key, 19);
                $key_file_name = 'discount_attachment'.$file_id;
                $document_id = 6;//cargo supporting document id
                $document_title = $input['discount_attachment'.$file_id];
//                $this->attachTaskDocuments($task, $document_id, $key_file_name,$document_title,$input);
                $document_resource_repo->saveDocument($client_testimonial_id,$document_id,$key_file_name,$input);
            }
        };


    }

    public function getTestimonialByClient($client_id)
    {
        $query = $this->getQueryAllClientTestimonials()->where('client_id',$client_id);
        return $query;
    }


}
