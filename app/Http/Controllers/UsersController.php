<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Services\UserService;
use Exception;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        return view('admin.pages.user.index');
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
                'message' => $user
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
