<?php

namespace App\Http\Controllers;

use Exception;
use App\Http\Requests\CreateUserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    public function index(UserService $userService)
    {
        $users = $userService->list();

        return view('admin.pages.user.index', ['users' => $users]);
    }

    public function create()
    {
        return view('admin.pages.user.create');
    }

    public function store(
        CreateUserRequest $request,
        UserService $userService
    ) {
        try {

            $user = $userService->create($request);

            return response()->json([
                'status' => true,
                'data' => $user
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
