<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category_type',
        'price',
        'original_price',
        'on_sale',
        'is_free',
        'description',
        'cover_image',
        'demo_audio_url',
        'download_path',
        'is_live',
        'event_date',
        'video_embed_code',
        'payment_url',
        'is_active',
    ];

    /**
     * Casting de atributos.
     * Transforma automáticamente los valores de la DB a tipos de datos de PHP.
     */
    protected $casts = [
        'price' => 'decimal:2',
        'original_price' => 'decimal:2',
        'on_sale' => 'boolean',
        'is_free' => 'boolean',
        'is_live' => 'boolean',
        'is_active' => 'boolean',
        'event_date' => 'datetime',
    ];

    /**
     * Scope para filtrar solo productos activos.
     * Uso: Product::active()->get();
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
