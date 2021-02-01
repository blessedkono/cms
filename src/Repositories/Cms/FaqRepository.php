<?php

namespace App\Repositories\Cms;

use App\Models\Cms\Faq;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FaqRepository extends BaseRepository
{
    const MODEL = Faq::class;


    public function __construct()
    {

    }

    /**
     * update FAQ
     * @return mixed
     */
    public function getAll(){
    $query = $this->query()
        ->orderBy('id', 'desc')
        ->paginate(sysdef()->name('pagination_low'));
    return $query;
}

    /**
     * Get FAQ for admin datatable
     * @return mixed
     */
    public function getForAdminDataTable(){
        return $this->query();
    }

    /**
     * Store FAQ
     * @param array $input
     * @return mixed
     */
    public  function store(array $input){
        return DB::transaction(function () use($input){
//            $user = access()->user();
            $faq = $this->query()->create([
                'user_id' =>access()->user()->id,
                'title'=>$input['title'],
                'content'=>$input['content'],
                'isactive'=>array_key_exists('status', $input) ? $input['status'] : 0 ,
                'rank'=>$input['rank'],
            ]);
            return $faq;
        });
    }

    /**
     * @param FAQs
     * @param array $input
     * Update existing FAQ information
     */
    public function update(Faq $faq, array $input)
    {
        return  DB :: transaction(function() use ($input, $faq){
            $faq->update([
                'user_id' =>access()->user()->id,
                'title'=>$input['title'],
                'content'=>$input['content'],
                'isactive'=>array_key_exists('status', $input) ? $input['status'] : 0 ,
                'rank'=>$input['rank'],
            ]);
            return $faq;
        });
    }

    /*Rank new inserted faq per category specified*/
    public function rank(array $input)
    {
        $issystem = array_key_exists('issystem', $input) ? 1 : 0;
        $service_type = array_key_exists('service_type', $input) ? $input['service_type'] : null;
        $sub_service_type = array_key_exists('sub_service_type', $input) ?  $input['sub_service_type'] : null;
        //count number of existing faq on this category
        $count = $this->query()->where('issystem', $issystem)->where('logistic_service_cv_id', $service_type)->where('logistic_service_sub_cv_id', $sub_service_type)->count();
        return $count + 1;
    }

    /**
     * @param Model $faq
     * @param array $input
     * Refresh ranks when updating rank of faq
     */
    public function refreshRanks(Model $faq, array $input)
    {
        $issystem = array_key_exists('issystem', $input) ? 1 : 0;
        $service_type = array_key_exists('service_type', $input) ? $input['service_type'] : null;
        $sub_service_type = array_key_exists('sub_service_type', $input) ?  $input['sub_service_type'] : null;
        $new_rank = ($this->rank($input) - 1) < $input['rank'] ? $this->rank($input) : $input['rank'];

        //update this faq to new rank
        $faq->update(['rank' => $new_rank]);
        //get of existing faq on this category
        $faqs =  $this->query()->where('issystem', $issystem)->where('logistic_service_cv_id', $service_type)->where('logistic_service_sub_cv_id', $sub_service_type)->where('id','<>', $faq->id)->orderBy('rank')->get();
        $count = 1;
        foreach($faqs as $faq_exist){
                       //check if rank is new rank and skip
            if ($count == $new_rank){
                $count = $count + 1;
            }
            $faq_exist->update(['rank' => $count]);
            $count = $count + 1;
        }
    }

    public function checkRankOptionWhenUpdate(Model $faq, array $input)
    {
        //old
        $old_issystem = $faq->isssytem;
        $old_service_type = $faq->logistic_service_cv_id;
        $old_sub_service_type = $faq->logistic_service_sub_cv_id;
        $old_rank = $faq->rank;
        //new
        $issystem = array_key_exists('issystem', $input) ? 1 : 0;
        $service_type = array_key_exists('service_type', $input) ? $input['service_type'] : null;
        $sub_service_type = array_key_exists('sub_service_type', $input) ? $input['sub_service_type'] : null;
        $new_rank = $input['rank'];

        /*If there is any modification on category refresh ranks on old category*/
        if ($old_issystem != $issystem || $old_service_type != $service_type || $old_sub_service_type != $sub_service_type) {
            $old_input = ['service_type' => $old_issystem,
                'sub_service_type' => $old_service_type,
                'issystem' => $old_sub_service_type,
                'rank' => 0,
            ];
            //refresh old
            $this->refreshRanks($faq, $old_input);
            //refresh new
            $this->refreshRanks($faq, $input);
        } elseif ($old_issystem == $issystem && $old_service_type == $service_type && $old_sub_service_type == $sub_service_type && $new_rank != $old_rank) {
            //refresh new
            $this->refreshRanks($faq, $input);
        };

    }
    /**
     * @param FAQs
     * @param array $input
     * delete existing FAQ information
     */
    public function delete(Faq $faq)
    {
        $faq->delete();
    }

    /**
     * Get all FAQs by service
     * @param $logistic_service_cv_id
     * @return mixed
     */
    public function getAllByRank(){
        $query = $this->query()
            ->orderBy('rank', 'asc')
            ->paginate(20);
        return $query;
    }



    /**
     * Get all FAQs by sub service / category
     * @param $logistic_service_cv_id
     * @return mixed
     */
    public function getAllBySubService($logistic_service_sub_cv_id){
        $query = $this->query()
            ->where('logistic_service_sub_cv_id', $logistic_service_sub_cv_id)
            ->orderBy('rank', 'asc')
            ->paginate(20);
        return $query;
    }


    /**
     * Get all FAQs which are general
     * @param
     * @return mixed
     */
    public function getGeneralFaqs(){
        $query = $this->query()
            ->where('issystem', 1)
            ->orderBy('rank', 'asc')
            ->paginate(20);
        return $query;
    }


}
