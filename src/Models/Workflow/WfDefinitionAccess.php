<?php

namespace App\Models\Workflow;

/**
 * Class WfDefinitionAccess
 * @package App\Models\Workflow
 */
trait WfDefinitionAccess
{

    /**
     * Save the inputted users.
     *
     * @param mixed $inputUsers
     *
     * @return void
     */
    public function saveUsers($inputUsers)
    {
        if (! empty($inputUsers)) {
            $this->users()->sync($inputUsers);
        } else {
            $this->users()->detach();
        }
    }

    /**
     * Attach User to current work flow definition.
     *
     * @param object|array $permission
     *
     * @return void
     */
    public function attachUser($user)
    {
        if (is_object($user)) {
            $user = $user->getKey();
        }

        if (is_array($user)) {
            $user = $user['id'];
        }

        $this->users()->attach($user);
    }

    /**
     * Detach user form current work flow definition.
     *
     * @param object|array $user
     *
     * @return void
     */
    public function detachPermission($user)
    {
        if (is_object($user)) {
            $user = $user->getKey();
        }

        if (is_array($user)) {
            $user = $user['id'];
        }

        $this->users()->detach($user);
    }

    /**
     * Attach multiple users to current workflow definitions.
     *
     * @param mixed $users
     *
     * @return void
     */
    public function attachUsers($users)
    {
        foreach ($users as $user) {
            $this->attachUser($user);
        }
    }

    /**
     * Detach multiple users from current workflow definition.
     *
     * @param mixed $users
     *
     * @return void
     */
    public function detachUsers($users)
    {
        foreach ($users as $user) {
            $this->detachUser($user);
        }
    }


    /**
     * @param $user_id
     * @return bool
     * Check if user as access to the definition
     */
    public function userHasAccessToThisLevel($user_id)
    {
        $check = $this->users()->where('user_id', $user_id)->count();

        if($check > 0){
            return true;
        }else{
            return false;
        }
    }


}