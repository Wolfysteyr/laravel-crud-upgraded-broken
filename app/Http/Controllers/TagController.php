<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function search(Request $request) {
        $query = $request->get('q', '');

        $tags = Tag::query()
            ->when($query !== '', function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%');
            })
            ->orderBy('name')
            ->limit(10)
            ->pluck('name');

        return response()->json($tags);
    }
}
