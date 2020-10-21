<?php

namespace App\Models\Workflow\Attribute;



use App\Repositories\Workflow\WfDefinitionRepository;

trait WfDefinitionAttribute
{

    public function isMaximumLevel()
    {
        $wfDefinitionRepo = new WfDefinitionRepository();
        $maxLevel = $wfDefinitionRepo->query()->where('wf_module_id', $this->wfModule->id)->max("level");
        return $maxLevel == $this->level;
    }


    public function getLevelDescriptionAttribute()
    {
        return 'Level : ' . $this->level . ' - ' . $this->description;
    }

}