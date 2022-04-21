<?php

namespace App\Services;

use Exception;
use Spatie\Permission\Models\Permission;

class PermissionService
{

    public function list()
    {
        return Permission::all();
    }


    public function store($request)
    {
        try {
            $permission = Permission::create([
                'name' => $request->permission,
                'guard_name' => 'web'
            ]);

            return $permission;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function delete($id)
    {
        $permissions = Permission::findOrFail($id);

        $permissions->delete();
    }
}
