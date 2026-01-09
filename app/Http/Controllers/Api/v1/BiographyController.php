<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Biography;
use Illuminate\Http\Request;

class BiographyController extends Controller
{
    public function index(){
        $biographies = Biography::where('is_active', true)->get();
        return response()->json($biographies);
    }
}
