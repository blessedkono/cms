<?php
/**
 * Created by PhpStorm.
 * User: hamis
 * Date: 6/26/19
 * Time: 9:43 AM
 */

namespace App\Repositories\System\Traits;


use Illuminate\Support\Facades\DB;

trait DocumentResourceTrait
{
    public function getDocumentResourceInstance($pivot_id)
    {
        return DB::table('document_resource')->where("id", "=", $pivot_id)->first();
    }
}