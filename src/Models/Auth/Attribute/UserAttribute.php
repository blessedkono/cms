<?php

namespace App\Models\Auth\Attribute;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

trait UserAttribute
{
    /**
     * Set the user's email.
     *
     * @param  string  $value
     * @return void
     */
    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower(trim(preg_replace('/\s+/', '', $value)));
    }

    /**
     * Set the user's name.
     *
     * @param  string  $value
     * @return void
     */
    public function setFirstnameAttribute($value)
    {
        $this->attributes['firstname'] = ucwords(trim($value));
    }


    public function setMiddlenameAttribute($value)
    {
        $this->attributes['middlename'] = ucwords(trim($value));
    }

    public function setLastnameAttribute($value)
    {
        $this->attributes['lastname'] = ucwords(trim($value));
    }


    public function setFullnameAttribute()
    {
        return  ucfirst($this->firstname) . " " . ucfirst($this->middlename) . ' ' .  ucfirst($this->lastname);
    }

    public function getFullnameAttribute() {
        return ucfirst($this->firstname) . " " . ucfirst($this->middlename) . ' ' .  ucfirst($this->lastname);
    }

    public function getCreatedAtFormattedAttribute()
    {
        return  Carbon::parse($this->created_at)->format('d-M-Y');
    }

    public function getLastLoginFormattedAttribute()
    {
        return  Carbon::parse($this->last_login)->format('d-M-Y');
    }



    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->isactive == true;
    }

    /**
     * @return bool
     */
    public function isConfirmed()
    {
        return $this->confirmed == 1;
    }



    /* Active status label*/
    public function getActiveStatusLabelAttribute()
    {
        if ($this->isactive == 1) {
            return "<span class='badge badge-pill badge-success' data-toggle='tooltip' data-html='true' title='" . trans('label.active') . "'>" . trans('label.active') . "</span>";
        } else {
            return "<span class='badge badge-pill badge-warning' data-toggle='tooltip' data-html='true' title='" . trans('label.inactive') . "'>" . trans('label.inactive') . "</span>";
        }
    }

    /*Get Roles of the users*/

    public function getRoleLabelAttribute() {
        $roles = [];
        if ($this->roles()->count() > 0) {
            foreach ($this->roles as $role) {
                array_push($roles, $role->name);
            }
            return implode(", ", $roles);
        } else {
            return '<span class="tag tag-danger">'. trans('label.none') . '</span>';
        }
    }

    /*Workflow resource name*/
    public function getResourceNameAttribute()
    {
        return $this->getFullnameAttribute();
    }

    /*Auditable name for audit*/
    public function getAuditableNameAttribute()
    {
       return  $this->getFullnameAttribute();
    }

}
