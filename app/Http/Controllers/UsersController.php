<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
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

    public function store(CreateUserRequest $request)
    {
        echo $request->nama;
    }
}
