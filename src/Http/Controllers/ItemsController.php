<?php

namespace Larabit\Http\Controllers;

use Larabit\Models\Item;

class ItemsController
{
    public function index()
    {
        $items = Item::select(['name'])->get();

        return response()->json([
            'items' => $items,
        ]);
    }
}
