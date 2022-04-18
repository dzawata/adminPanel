<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserHasRole;
use Exception;
use Illuminate\Support\Facades\DB;

class UserService
{
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
}
