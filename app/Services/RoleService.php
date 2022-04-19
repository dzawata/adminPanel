<?php

namespace App\Services;

use App\Models\UserHasRole;
use Exception;

class RoleService
{

    public function create($request)
    {
        try {
            UserHasRole::create([
                'role_id' => $request['role_id'],
                'user_id' => $request['user_id']
            ]);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function hasRole($id)
    {
        $userHasRole = UserHasRole::where('user_id', $id)->get();

        $hasRole = [];
        foreach ($userHasRole as $role) {
            $hasRole[] = $role->role_id;
        }

        return $hasRole;
    }

    public function deleteByUser($id)
    {
        try {

            UserHasRole::where('user_id', $id)->delete();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
