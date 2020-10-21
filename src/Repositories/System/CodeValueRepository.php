<?php

namespace App\Repositories\System;

use App\Models\System\CodeValue;
use App\Repositories\BaseRepository;
use App\Repositories\System\CountryRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\This;

/**
 * Class CodeValueRepository
 * @package App\Repositories\Sysdef
 * @description Use this class with care, could break the system.
 * Controls all the data dictionaries of the system.
 * @author Erick M. Chrysostom <e.chrysostom@nextbyte.co.tz>
 */
class CodeValueRepository extends BaseRepository
{

    const MODEL = CodeValue::class;
    protected $code_repo;

    /*
     * CodeValueRepository Constructor
     */
    public function __construct(){
        $this->code_repo = new CodeRepository();
    }

    /*
     * Translate CodeValues Entries using lang>code_value
     */
    public function mapIdsForLang($query)
    {
        $return = $query->map(function ($item, $key) {
            return ['id' => $item['id'], 'name' => __("code_value." . $item['id'])];
        });
        return $return;
    }

    /*Query active only*/
    public function queryActiveOnly()
    {
        return $this->query()->where('isactive', 1);
    }

    /**
     * Get code value name for translation
     * @param $id
     * @return array|null|string
     */
    public function name($id)
    {
        return __('code_value.'. $id);

    }

/*no transalation*/
    public function nameWithNoLang($id)
    {
        return $this->find($id)->name;
    }

    /*Get id by reference*/
    public function getIdByReference($reference){
        $cv = $this->getCodeValueByReference($reference);
        return $cv->id;
    }

    /*
     *
     */
    public function getUserLogTypeLogIn()
    {
        $return = $this->query()->select(['id'])->where("code_id", 1)->where("reference", "ULLGI")->first();
        return $return->id;
    }

    /*
     *
     */
    public function getUserLogTypeLogOut()
    {
        $return = $this->query()->select(['id'])->where("code_id", 1)->where("reference", "ULLGO")->first();
        return $return->id;
    }

    /*
     *
     */
    public function getUserLogTypeFailedLogin()
    {
        $return = $this->query()->select(['id'])->where("code_id", 1)->where("reference", "ULFLI")->first();
        return $return->id;
    }

    /*
     *
     */
    public function getUserLogTypePasswordReset()
    {
        $return = $this->query()->select(['id'])->where("code_id", 1)->where("reference", "ULPRS")->first();
        return $return->id;
    }

    /*
     *
     */
    public function getUserLogTypeUserLockout()
    {
        $return = $this->query()->select(['id'])->where("code_id", 1)->where("reference", "ULULC")->first();
        return $return->id;
    }


    /*
     *
     */
    public function getCodeForSelectFiltered($code_id, array $filter)
    {
        $query = $this->queryActiveOnly()->select(['id'])->where("code_id", $code_id)->whereIn("id", $filter)->get();
        $return = $this->mapIdsForLang($query)->pluck('name', 'id');
        return $return;
    }

    /*
     * Get all code values by code_id
     * For initiating chained selects
     */
    public function getAllByCode($code_id)
    {
        return $this->query()->select(['id', 'name', 'code_id'])->where("code_id", $code_id)->get();
    }


    /*Get code values for select */
    public function getCodeValuesForSelect($code_id)
    {
        $query = $this->queryActiveOnly()->select(['id'])
            ->where("code_id", $code_id)
            ->orderBy('id', 'asc')
            ->get();
        $return = $this->mapIdsForLang($query)->pluck('name', 'id');
        return $return;
    }

    /*Get code values for select with no lang*/
    public function getCodeValuesForSelectWithNoLang($code_id)
    {
        $query = $this->queryActiveOnly()
            ->where("code_id", $code_id)
            ->orderBy('id', 'asc')
            ->pluck('name','id');
        $return = $query;
        return $return;
    }

    /*Get code values by reference for select*/
    public function getCodeValuesReferenceForSelect($code_id)
    {
        $query = $this->queryActiveOnly()->select(['name', 'reference'])->where("code_id", $code_id)->get();
        $return = $query->pluck("name", "reference");
        return $return;
    }

    /**
     * Get CV by reference
     * @param $reference
     * @return mixed
     */
    public function getCodeValueByReference($reference){
        return $return = $this->query()->where("reference", $reference)->first();
    }

    /*
     * Get code values instances by code_id
     */
    public function getCodeValues($code_id)
    {
        return $this->query()->where("code_id", $code_id)->get();
    }

    /*
     * Get instances of  code values not in specified ids
     */
    public function getCodeValuesNotIn($code_id, array $ids)
    {
        return $this->query()->where("code_id", $code_id)->whereNotIn('id', $ids)->get();
    }

    /*
     *
     */
    public function getCodeValuesPaginate($code_id, $count = 10)
    {
        return $this->query()->where("code_id", $code_id)->paginate($count);
    }

    /*
     *
     */
    public function getCurrencyForSelect(){
        $repo = new CurrencyRepository();
        $query = $repo->query()->select(['id', 'code'])->get();
        $return = $query->pluck("code", "id");
        return $return;
    }

    /*
     *
     */
    public function getCountryNameForSelect()
    {
        $repo = new CountryRepository();
        $query = $repo->query()->where('isactive', 1)->select(['name', 'code'])->get();
        $return = $query->pluck("name", "name");
        return $return;
    }

    /*
 *
 */
    public function getCountryCodeForSelect()
    {
        $repo = new CountryRepository();
        $query = $repo->query()->where('isactive', 1)->select(['code', 'name'])->orderBy('sort', 'asc')->orderBy('name', 'asc')->get();
        $return = $query->pluck("name", "code");
        return $return;
    }

    /*
     *
     */
    public function getCountryIdsForSelect()
    {
        $repo = new CountryRepository();
        $query = $repo->query()->where('isactive', 1)->select(['id', 'name'])->get();
        $return = $query->pluck("name", "id");
        return $return;
    }

    /*
     *
     */
    public function getRegionForSelect()
    {
        $repo = new RegionRepository();
        $query = $repo->query()->where('isactive', 1)->select(['id', 'name'])->get();
        $return = $query->pluck("name", "id");
        return $return;
    }


    public function getDistrictForSelect()
    {
        $repo = new DistrictRepository();
        $query = $repo->query()->select(['id', 'name'])->get();
        $return = $query->pluck("name", "id");
        return $return;
    }

    /*
     * Get Code instance from code_id
     */
    public function getCodeInstanceById($code_id)
    {
        return $this->code_repo->find($code_id);
    }

    /*
     * Get code values by code for data table
     */
    public function getCodeValuesByCodeForDataTable($code_id){
        return $this->query()->where('code_id', $code_id);
    }


    /**
     * get the maximum number of sort of a given code value
     * @param $code_id
     * @return mixed
     */
    public function getMaxSort($code_id){
        $code_values = $this->query()->select('sort')
            ->where('code_id', $code_id)
            ->orderBy('sort', 'desc')
            ->first();
        return $code_values->sort;
    }

    /**
     * generate references for CodeValue
     * @param $initials
     * @return string
     */
    public function generateReference($initials){
        do
        {
            $token = randomString();
            $reference = $initials.$token;
            $available = $this->query()
                ->select('reference')
                ->where('reference', $reference)->get();
        }
        while(!$available->isEmpty());
        return $reference;
    }


    /**
     * @param $cv_id
     * Get subcategory code of the code value
     */
    public function getCodeCategory($cv_id)
    {
        $code_value = $this->find($cv_id);
        $code_category = $code_value->codes()->where('iscategory', 1)->first();
        return $code_category;
    }



    /**
     * Store Code Value
     * @param array $input
     * @param $code_id
     */
    public function store(array $input, $code){

        $sort = $this->getMaxSort($code->id);
        DB::transaction(function () use ($input, $sort, $code) {
            $query = $this->query()->create([
                'name' => $input['code_name'],
                'description' => $input['description'],
                'code_id' => $code->id,
                'reference' => $this->generateReference('CV'),
                'isactive' => ($input['status'] == 'yes') ? 1 : 0,
                'sort' => ++$sort,
                'lang' =>  $input['code_name_sw']
            ]);
            return $query;
        });
    }

    /**
     * @param array $input
     * @param $reference
     */
    public function update(array $input,$code_value){
        DB::transaction(function () use ($input, $code_value) {
            $code_value->update([
                'code_name' => $input['code_name'],
                'description' => $input['description'],
                'isactive' => ($input['status'] == 'yes') ? 1 : 0,
                'lang' => $input['code_name_sw']
            ]);
        });

        return $code_value;
    }

    /*Activate / Deactivate i.e. status = 1 activate, = 0 Deactivate*/
    public function activateDeactivate($code_value, $status){
        $code_value->update([
            'isactive' => $status
        ]);
        return $code_value;
    }

}
