<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserHasRole;
use Exception;
use Illuminate\Support\Facades\DB;

class UserService
{
    public function list()
    {
        $users = User::get();

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

            UserHasRole::create([
                'role_id' => $request->role,
                'user_id' => $user->id
            ]);

            DB::commit();

            return $user;
        } catch (Exception $e) {

            DB::rollBack();

            throw $e;
        }
    }

    public function find(int $id)
    {
        $user = User::findOrFail($id);
        if (!empty($user->id)) {
            $userHasRole = UserHasRole::where('user_id', $id)->get();

            $hasRole = [];
            foreach ($userHasRole as $role) {
                $hasRole = $role->role_id;
            }

            $user->role = $hasRole;
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

            UserHasRole::where('user_id', $id)
                ->update(['role_id' => $request->role]);

            DB::commit();

            return $user;
        } catch (Exception $e) {

            DB::rollBack();

            throw $e;
        }
    }
}
