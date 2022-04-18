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

            $user = [
                'nama' => 'Idhar Firmansyah',
                'email' => 'interisty91@gmail.com'
            ];

            // $user = $userService->create($request);

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
