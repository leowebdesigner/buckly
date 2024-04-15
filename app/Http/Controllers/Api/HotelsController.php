<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HotelsResource;
use App\Models\Hotels;
use Illuminate\Http\Request;

class HotelsController extends Controller
{
    public function index()
    {
        $hotels = Hotels::get();
        
        return HotelsResource::collection($hotels);
    }

    public function show($id)
    {
        $hotels = Hotels::findOrFail($id);
        
        return new HotelsResource($hotels);
    }
}
