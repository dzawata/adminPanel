<?php

namespace App\Services;

use Exception;
use App\Models\User;
use App\Models\UserHasRole;
use App\Services\RoleService;
use Illuminate\Support\Facades\DB;

class UserService
{
    public function list()
    {
        $users = User::orderBy('id')->get();

        return $users;
    }

    public function create($request)
    {
        try {

            DB::beginTransaction();

            $user = User::create([
                'name' => $request->nama,
                'email' => $request->email,
                'password' => password_hash($request->password, PASSWORD_BCRYPT)
            ]);

            foreach ($request->role as $role) {
                UserHasRole::create([
                    'role_id' => $role,
                    'user_id' => $user->id
                ]);
            }

            DB::commit();

            return $user;
        } catch (Exception $e) {

            DB::rollBack();

            throw $e;
        }
    }

    public function edit(int $id)
    {
        $user = User::findOrFail($id);
        if (!empty($user->id)) {
            $roleService = new RoleService;
            $userHasRole = $roleService->hasRole($user->id);
            $user->role = json_encode($userHasRole);
        }

        return $user;
    }

    public function update($request, $id)
    {
        try {
            DB::beginTransaction();

            $data = [
                'name' => $request->nama,
                'email' => $request->email
            ];

            if (!empty($request->password)) {
                $data['password'] = password_hash($request->password, PASSWORD_BCRYPT);
            }

            $user = User::where('id', $id)
                ->update($data);

            if (!empty($request->role)) {

                UserHasRole::where('user_id', $id)->delete();

                foreach ($request->role as $role) {
                    UserHasRole::create([
                        'role_id' => $role,
                        'user_id' => $id
                    ]);
                }
            }

            DB::commit();

            return $user;
        } catch (Exception $e) {

            DB::rollBack();

            throw $e;
        }
    }
}
