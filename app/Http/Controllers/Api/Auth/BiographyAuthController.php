<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Biography;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BiographyAuthController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'responsibility' => 'nullable|string|max:255',
            'description' => 'required|string',
            'photo_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:512048',
            'is_active' => 'nullable|boolean',
        ]);

        $data = $request->only(['name', 'responsibility', 'description']);
        $data['is_active'] = $request->input('is_active', true);

        if ($request->hasFile('photo_url')) {
            $path = $request->file('photo_url')->store('biographies', 'public');
            $data['photo_url'] = $path;
        } else {
            $data['photo_url'] = 'default_photo.png';
        }

        $biography = Biography::create($data);

        return response()->json($biography, 201);
    }


    public function update(Request $request, $id)
    {
        $biography = Biography::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'responsibility' => 'nullable|string|max:255',
            'description' => 'required|string',
            'photo_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:512048',
            'is_active' => 'nullable|boolean',
        ]);

        $data = $request->only(['name', 'responsibility', 'description', 'is_active']);

        if ($request->hasFile('photo_url')) {
            if ($biography->photo_url && $biography->photo_url !== 'default_photo.png') {
                Storage::disk('public')->delete($biography->photo_url);
            }
            $data['photo_url'] = $request->file('photo_url')->store('biographies', 'public');
        }

        $biography->update($data);

        return response()->json([
            'message' => 'Biografía actualizada correctamente',
            'biography' => $biography
        ]);
    }

    public function destroy($id)
    {
        $biography = Biography::findOrFail($id);

        if ($biography->photo_url && $biography->photo_url !== 'default_photo.png') {
            Storage::disk('public')->delete($biography->photo_url);
        }

        $biography->delete();

        return response()->json(['message' => 'Biografía eliminada correctamente']);
    }
}
