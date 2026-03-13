<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductAuthController extends Controller
{

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_type' => 'required|in:sequence,preset,sound_pack,preset_pack,chart,plugin,course,live_event',
            'price' => 'required|numeric',
            'original_price' => 'nullable|numeric',
            'on_sale' => 'nullable|boolean',
            'is_free' => 'nullable|boolean',
            'description' => 'required|string',
            'cover_image' => 'required|image|max:10240', // 10MB para la portada
            'demo_audio' => 'nullable|file|max:51200',   // 50MB para el demo
            'main_file' => 'nullable|file|max:3048000',  // 2GB para el archivo real (ZIP/Video)
            'is_live' => 'nullable|boolean',
            'event_date' => 'nullable|date',
            'video_embed_code' => 'nullable|string',
            'payment_url' => 'nullable|string',
            'is_active' => 'required|boolean'
        ]);

        $validated['slug'] = Str::slug($request->name) . '-' . time();

        // 1. Cover Image (Público)
        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('products/covers', 'public');
        }

        // 2. Demo Audio (Público)
        if ($request->hasFile('demo_audio')) {
            $validated['demo_audio_url'] = $request->file('demo_audio')->store('products/audios', 'public');
        }

        // 3. Download Path (Privado - El archivo que vendes)
        if ($request->hasFile('main_file')) {
            // Se guarda en 'local' para que nadie lo descargue sin permiso
            $path = $request->file('main_file')->store('secure_content', 'local');
            $validated['download_path'] = $path;
        }

        $product = Product::create($validated);

        return response()->json(['message' => 'Producto creado', 'product' => $product], 201);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Opcional: Borrar archivos del servidor para no llenar espacio
        Storage::disk('public')->delete($product->cover_image);
        if ($product->demo_audio_url) {
            Storage::disk('public')->delete($product->demo_audio_url);
        }

        $product->delete();

        return response()->json(['message' => 'Producto eliminado']);
    }
}
