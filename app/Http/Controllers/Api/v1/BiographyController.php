<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Biography;
use Illuminate\Http\Request;

class BiographyController extends Controller
{
    public function index()
    {
        $biographies = Biography::where('is_active', true)->get();

        if ($biographies->isEmpty() && $biographies->count() == 0) {
            return response()->json(['message' => 'No biographies found'], 404);
        }

        return response()->json($biographies);
    }
}
