<?php

namespace App\Services;

use App\Models\UserHasRole;

class RoleService
{

    public function hasRole($id)
    {
        $userHasRole = UserHasRole::where('user_id', $id)->get();

        $hasRole = [];
        foreach ($userHasRole as $role) {
            $hasRole[] = $role->role_id;
        }

        return $hasRole;
    }
}
