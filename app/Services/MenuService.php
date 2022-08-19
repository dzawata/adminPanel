<?php

namespace App\Services;

use App\Models\Menu;
use Illuminate\Support\Facades\DB;

class MenuService
{
    public function list()
    {
        return DB::select("SELECT m.id, COALESCE((SELECT name FROM menus WHERE id=m.parent_id), '-') AS parent, m.name, m.url, m.icon FROM menus m ORDER BY id");
    }
}
