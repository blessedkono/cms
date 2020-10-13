<?php

namespace App\Models\Cms\Traits\Relationships;



use App\Models\Auth\User;

trait FaqRelationship
{

    /*Relation to user*/
    public function user(){
        return $this->belongsTo(User::class);
    }



}
