<?php
/**
 * Created by PhpStorm.
 * User: hamis
 * Date: 8/30/19
 * Time: 11:38 AM
 */

namespace App\Repositories\System;


use App\Models\System\District;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Log;

class DistrictRepository extends BaseRepository
{
    const MODEL = District::class;

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
     * @param $q
     * @param $page
     * @return \Illuminate\Http\JsonResponse
     * Get registered companies for select
     */
    public function getForSelect($q, $page)
    {
        $resultCount = 15;
        $offset = ($page - 1) * $resultCount;
        $data['items'] = $this->regexColumnSearch(['name' => $q])->limit($resultCount)->offset($offset)->get()->toArray();
        $data['total_count'] = count($data['items']);
        return response()->json($data);
    }
}
