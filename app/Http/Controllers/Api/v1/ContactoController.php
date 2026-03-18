<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\ContactoMessage;
use Illuminate\Http\Request;

class ContactoController extends Controller
{
    //
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|min:2',
        ]);

        ContactoMessage::create($validated);

        return response()->json(['message' => '¡Mensaje enviado con éxito!'], 201);
    }
}
