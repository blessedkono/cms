<?php
/**
 * Created by PhpStorm.
 * User: hamis
 * Date: 5/4/19
 * Time: 11:12 AM
 */

namespace Nextbyte\Cms\Models\BaseModel;


use Illuminate\Database\Eloquent\Model;
use Nextbyte\Cms\Models\BaseModel\Traits\Attribute\BaseModelAttribute;
use Nextbyte\Cms\Models\BaseModel\Traits\Relationship\BaseModelRelationship;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Ramsey\Uuid\Uuid;

class BaseModel extends Model
{
    use BaseModelAttribute, BaseModelRelationship;
    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }

    protected $auditableEvents = [
        'deleted',
        'updated',
        'restored',
        'created'
    ];

    /**
     *  Setup model event hooks
     */
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Uuid::generate(4);
        });
    }


}
