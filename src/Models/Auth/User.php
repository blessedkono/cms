<?php

namespace App\Models\Auth;

use App\Models\Auth\Attribute\UserAttribute;
use App\Models\Auth\Relationship\UserRelationship;
use App\Models\System\Relationship\GeneralDocumentRelationship;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use OwenIt\Auditing\Auditable;
use Webpatser\Uuid\Uuid;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * @property mixed confirmation_code
 */
class User extends Authenticatable implements  AuditableContract
{
    use Notifiable, UserAttribute, UserRelationship, UserAccess, Auditable, GeneralDocumentRelationship;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['uuid'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * @var array
     */
    protected $auditableEvents = [
        'deleted',
        'updated',
        'restored',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }

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
