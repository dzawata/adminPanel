<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Services\PermissionService;
use App\Services\RoleService;
use Exception;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    protected $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function index()
    {
        $roles = $this->roleService->list();

        return view('admin.pages.role.index', [
            'title' => 'Roles',
            'roles' => $roles
        ]);
    }

    public function create(PermissionService $permissionService)
    {
        $permissions = $permissionService->list();

        return view('admin.pages.role.create', [
            'title' => 'Tambah Role',
            'permissions' => $permissions
        ]);
    }

    public function store(CreateRoleRequest $request)
    {
        try {
            $role = $this->roleService->store($request);

            return response()->json([
                'status' => true,
                'data' => $role
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function edit(PermissionService $permissionService, $id)
    {
        $role = $this->roleService->edit($id);
        return view('admin.pages.role.edit', [
            'title' => 'Edit Role',
            'role' => $role,
            'permissions' => $permissionService->list()
        ]);
    }

    public function update(UpdateRoleRequest $request, int $id)
    {
        try {
            $role = $this->roleService->update($request, $id);

            return response()->json([
                'status' => true,
                'data' => $role
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function delete($id)
    {
        try {

            $this->roleService->delete($id);

            return response()->json([
                'status' => true,
                'message' => 'Success hapus data'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
