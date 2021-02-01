<?php

namespace App\Repositories;

use App\Exceptions\GeneralException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Class BaseRepository.
 */
class BaseRepository
{
    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->query()->get();
    }

    /**
     * @return mixed
     */
    public function getCount()
    {
        return $this->query()->count();
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function find($id)
    {
        return $this->query()->find($id);
    }

    /**
     * @return mixed
     */
    public function query()
    {
        return call_user_func(static::MODEL.'::query');
    }

    public function all()
    {
        return call_user_func(static::MODEL.'::all');
    }



    /**
     * Return Only Importer ID
     * @param $uuid
     * @return mixed
     */
    public function getByUuid($uuid)
    {
        return $this->query()->where('uuid', $uuid)->first();
    }

    /*Query only active resources*/
    public function queryActive()
    {
        return $this->query()->where('isactive', 1);
    }

    /*Find instance from where conditions*/
    public function findByWhere(array $where_inputs)
    {
        return $this->query()->where($where_inputs)->first();
    }


    /*General query to update using DB builder*/
    public function generalDbBuilderUpdateQuery($table_name, array $where_input, array $update_input){

        DB::table($table_name)->where($where_input)->update($update_input);
    }

    /**
     * @param $pivot_table_name
     * @param array $relation_where_input
     * @param array $attributes
     * Manual sync pivot for many to many
     */
    public function generalSyncPivot($pivot_table_name, array $relation_where_input, array $attributes = [])
    {
        $check_if_exists = DB::table($pivot_table_name)->where($relation_where_input)->count();

        if($check_if_exists > 0)
        {
            //exists
            if(isset($attributes))
            {
                DB::table($pivot_table_name)->where($relation_where_input)->update($attributes);
            }
        }else{
            //do not exists - Attach
            $insert_input = array_merge($relation_where_input, $attributes);
            DB::table($pivot_table_name)->insert($insert_input);
        }
    }


    /*Create using mass assign by filtering keys which are in table*/
    public function createMassAssign($table, array $input)
    {

        $input_common = $this->getCommonInputForMassAssign($table, $input);

        $this->query()->create($input_common);
    }

//    Create mass assign using DB builder
    public function createMassAssignDbBuilder($table, array $input)
    {

        $input_common = $this->getCommonInputForMassAssign($table, $input);

        DB::table($table)->insert($input_common);
    }

    /*update mass assign by filtering keys exists ib the table*/
    public function updateMassAssign($table,$resource_id, array $input)
    {
        $resource = $this->find($resource_id);
        $input_common = $this->getCommonInputForMassAssign($table, $input);
        $resource->update($input_common);
    }

    /*update mass assign by filtering keys exists ib the table by where input*/
    public function updateMassAssignByWhere($table,array $where_input, array $input)
    {
        $input_common = $this->getCommonInputForMassAssign($table, $input);
        DB::table($table)->where($where_input)->update($input_common);
    }


    /*Get Input with all keys exists in the table columns*/
    public function getCommonInputForMassAssign($table, array $input)
    {
        $columns = DB::getSchemaBuilder()->getColumnListing($table);

        $input_keys = array_keys($input);

        $keys_common = (array_intersect($columns, $input_keys));

        /*STart get values*/
        $values = [];
        foreach($keys_common as $key)
        {
            array_push($values, $input[$key]);
        }
        $array_combine = array_combine($keys_common, $values);
        return $array_combine;
    }

    /**
     * Check if phone number is unique
     * @param $phone_formatted
     * @param $phone_column_name
     * @param $action_type
     * @param null $object_id => primary key of the model
     * @throws GeneralException
     */
    public function checkIfPhoneIsUnique($phone_formatted,$phone_column_name, $action_type,$object_id = null)
    {
        $return = 0;
        if ($action_type == 1){
            /*on insert*/
            $return = $this->query()->where($phone_column_name, $phone_formatted)->count();
        }else{
            /*on edit*/
            $return = $this->query()->where('id','<>', $object_id)->where($phone_column_name, $phone_formatted)->count();
        }
        /*Check outcome */
        if ($return == 0)
        {
            //is unique
        }else{
            /*Phone is taken: throw exception*/
            throw new GeneralException(__('exceptions.general.taken', ['key' => __('label.phone') ]));
        }
    }



    /**
     * @param array $input is array of all where conditions
     * @param $action_type
     * @param null $resource_id
     * @throws GeneralException
     * Check if already exists
     */
    public function checkIfExistsGeneral($action_type, array $input, $resource_id = null)
    {
        if($action_type == 1){
            /*When adding*/
            $check = $this->query()->where($input)->count();
        }else{
            $check = $this->query()->where('id', '<>', $resource_id)->where($input)->count();
        }

        if($check > 0){
            throw new GeneralException(__('exceptions.general.already_exists'));
        }

    }



    /**
     * @param array $input
     * @return mixed
     * Regex column search
     */
    public function regexColumnSearch(array $input)
    {
        $return = $this->query();
        if (count($input)) {
            $sql = $this->regexFormatColumn($input)['sql'];
            $keyword = $this->regexFormatColumn($input)['keyword'];
            $return = $this->query()->whereRaw($sql, $keyword);
        }
        return $return;
    }

    /**
     * @param array $input
     * @return array
     * Regex format according to drive used
     */
    public function regexFormatColumn(array $input)
    {
        $keyword = [];
        $sql = "";
        if (count($input)) {
            switch (DB::getDriverName()) {
                case 'pgsql':
                    foreach ($input as $key => $value) {
                        $sql .= " cast({$key} as text) ~* ? or";
                        $keyword[] = $value;
                    }
                    break;
                default:
                    foreach ($input as $key => $value) {
                        $value = strtolower($value);
                        $sql .= " LOWER({$key}) REGEXP  ? or";
                        $keyword[] = $value;
                    }
            }
            $sql = substr($sql, 0, -2);
            $sql = "( {$sql} )";
        }
        return ['sql' => $sql, 'keyword' => $keyword];
    }


    /*Change status isactive of a model*/
    public function changeStatus($model,$status)
    {
        $model->isactive = $status;
        $model->save();
    }




}
