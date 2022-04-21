<?php

namespace App\Services;

use Exception;
use App\Models\User;
use App\Services\RoleService;
use Illuminate\Support\Facades\DB;

class UserService
{
    protected $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function list()
    {
        $users = User::orderBy('id')->get();

        return $users;
    }

    public function store($request)
    {
        try {

            DB::beginTransaction();

            $user = User::create([
                'name' => $request->nama,
                'email' => $request->email,
                'password' => password_hash($request->password, PASSWORD_BCRYPT)
            ]);

            foreach ($request->role as $role) {
                $this->roleService->create([
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
            $userHasRole = $this->roleService->hasRole($user->id);
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

                $this->roleService->deleteByUser($id);

                foreach ($request->role as $role) {
                    $this->roleService->create([
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

    public function delete($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
