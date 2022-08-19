<?php

namespace App\Http\Controllers;

use App\Services\MenuService;
use Illuminate\Http\Request;

class MenusController extends Controller
{
    protected $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    public function index()
    {
        $menus = $this->menuService->list();

        return view('admin.pages.menus.index', [
            'title' => 'Menus',
            'menus' => $menus
        ]);
    }
}
