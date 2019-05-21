<?php

namespace Wink\Http\Controllers;

use Wink\WinkRole;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Wink\Http\Resources\RolesResource;

class RolesController
{
    /**
     * Return posts.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $entries = WinkRole::when(request()->has('search'), function ($q) {
            $q->where('name', 'LIKE', '%'.request('search').'%');
        })
            ->orderBy('created_at', 'DESC')
            ->withCount('authors')
            ->get();

        return RolesResource::collection($entries);
    }

    /**
     * Return a single post.
     *
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id = null)
    {
        $entry = WinkRole::findOrFail($id);

        return response()->json([
            'entry' => $entry,
        ]);
    }
}
