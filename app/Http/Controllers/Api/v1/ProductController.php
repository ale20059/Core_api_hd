<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();


        //filtrar por tipo (sequence, preset, chart, course, etc.)
        if ($request->has('type')) {
            $query->where('category_type', $request->type);
        }

        //filtrar por gratis o de pago
        //ejemplo: /api/v1/productos?fre=1
        if ($request->has('free')) {
            $isFree = $request->boolean('free');
            $query->where('is_free', $isFree);
        }

        //filtra por eventos en vivo
        if ($request->has('live')) {
            $query->where('is_live', true);
        }

        //solo filtra productos activos
        $products = $query->where('is_active', true)->latest()->get(); //los mas nuevos primero

        if ($products->isEmpty() && $products->count() == 0) {
            return response()->json(['message' => 'No products found'], 200);
        }

        return response()->json($products);
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->where('is_active', true)->firstOrFail();
        return response()->json($product);
    }

    public function download($id)
    {
        $product = Product::findOrFail($id);

        if (!$product->download_path || !Storage::disk('local')->exists($product->download_path)) {
            return response()->json(['message' => 'File not found'], 404);
        }

        $extension = pathinfo($product->download_path, PATHINFO_EXTENSION);

        $friendlyname = $product->slug . '.' . $extension;

        return response()->download(
            Storage::disk('local')->path($product->download_path),
            $friendlyname
        );
    }
}
