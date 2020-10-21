<?php

namespace App\Repositories\Workflow;

use App\Repositories\BaseRepository;
use App\Models\Workflow\WfModuleGroup;

class WfModuleGroupRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = WfModuleGroup::class;




    public function queryActiveUserGroups()
    {
        $groups = $this->query()->select(['id', 'name'])->whereIn("id", function ($query) {
            $query->select("wf_module_group_id")->from("wf_modules")->whereIn("id", function($query) {
                $query->select("wf_module_id")->from("wf_definitions")->whereIn("id", function($query) {
                    $query->select("wf_definition_id")->from("wf_tracks")->where(['status' => 0])->whereIn("wf_definition_id", function($query) {
                        $query->select("wf_definition_id")->from("user_wf_definition")->whereIn("user_id", access()->allUsers());
                    });
                });
            });
        })->get();
        return $groups;
    }

    public function queryAttendedUserGroups()
    {
        $groups = $this->query()->select(['id', 'name'])->whereIn("id", function ($query) {
            $query->select("wf_module_group_id")->from("wf_modules")->whereIn("id", function($query) {
                $query->select("wf_module_id")->from("wf_definitions")->whereIn("id", function($query) {
                    $query->select("wf_definition_id")->from("wf_tracks")->where(['status' => 1])->whereIn("user_id", access()->allUsers());
                });
            });
        })->get();
        return $groups;
    }

    public function getActiveUserGroups()
    {
        $groups = $this->queryActiveUserGroups();
        $wfTracks = new WfTrackRepository();
        $groupSummary = [];
        foreach ($groups as $group) {
            $count = $wfTracks->getPendingGroupCount($group->id);
            $groupSummary[] = ['id' => $group->id, 'name' => $group->name, 'count' => number_format($count , 0 , '.' , ',' )];
        }
        return $groupSummary;
    }

    public function getMyAttendedActiveUserGroups()
    {
        $groups = $this->queryAttendedUserGroups();
        $wfTracks = new WfTrackRepository();
        $groupSummary = [];
        foreach ($groups as $group) {
            $count = $wfTracks->getMyAttendedGroupCount($group->id);
            $groupSummary[] = ['id' => $group->id, 'name' => $group->name, 'count' => number_format($count , 0 , '.' , ',' )];
        }
        return $groupSummary;
    }

    public function getAssignedActiveUserGroups()
    {
        $groups = $this->queryActiveUserGroups();
        $wfTracks = new WfTrackRepository();
        $groupSummary = [];
        foreach ($groups as $group) {
            $count = $wfTracks->getMyPendingGroupCount($group->id);
            $groupSummary[] = ['id' => $group->id, 'name' => $group->name, 'count' => number_format($count , 0 , '.' , ',' )];
        }
        return $groupSummary;
    }

    public function getWorkflowfGroup()
    {
        return $this->query()->get();
    }



}
