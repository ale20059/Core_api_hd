<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Worship Multitrack - Oceans',
            'slug' => Str::slug('Worship Multitrack - Oceans'),
            'category_type' => 'sequence',
            'price' => 9.99,
            'original_price' => 15.00,
            'on_sale' => true,
            'description' => 'Secuencia completa con stems separados: Drums, Bass, Guitars y Pads.',
            'cover_image' => 'covers/oceans.jpg',
            'demo_audio_url' => 'demos/oceans-preview.mp3',
            'download_path' => 'sounds/oceans-stems.zip',
            'payment_url' => null,
        ]);

        Product::create([
            'name' => 'MainStage Ultimate Pads',
            'slug' => Str::slug('MainStage Ultimate Pads'),
            'category_type' => 'preset',
            'price' => 5.00,
            'description' => 'Pack de 10 presets ambientales para MainStage 3 y Logic Pro.',
            'cover_image' => 'covers/presets.jpg',
            'demo_audio_url' => 'demos/pads-preview.mp3',
            'payment_url' => null,
        ]);

        Product::create([
            'name' => 'Concierto En Vivo - Noche de Gala',
            'slug' => Str::slug('Concierto En Vivo - Noche de Gala'),
            'category_type' => 'live_event',
            'price' => 1.00,
            'description' => 'Acceso exclusivo al streaming del concierto este viernes.',
            'cover_image' => 'covers/live-event.jpg',
            'is_live' => true,
            'event_date' => '2026-01-15 20:00:00', // Fecha futura
            'video_embed_code' => 'embed/live_id_ejemplo',
            'payment_url' => null,
        ]);

        // 4. Un Curso (HD Academy)
        Product::create([
            'name' => 'Curso de Producción para Iglesias',
            'slug' => Str::slug('Curso de Producción para Iglesias'),
            'category_type' => 'course',
            'price' => 15.00,
            'description' => 'Aprende a armar tus propias secuencias desde cero.',
            'cover_image' => 'covers/curso-prod.jpg',
            'payment_url' => null,
        ]);

        Product::create([
            'name' => 'Worship Multitrack - Entre Las Llamas',
            'slug' => Str::slug('Worship Multitrack - Entre Las Llamas'),
            'category_type' => 'sequence',
            'price' => 9.99,
            'original_price' => null,
            'on_sale' => false,
            'description' => 'Secuencia completa con stems separados: Drums, Bass, Guitars y Pads.',
            'cover_image' => 'covers/entrellamas.jpg',
            'demo_audio_url' => 'demos/entrellamas-preview.mp3',
            'download_path' => 'sounds/entrellamas-stems.zip',
            'payment_url' => null,
        ]);

        Product::create([
            'name' => 'Worship Multitrack - Oceans',
            'slug' => Str::slug('Worship Multitrack - Forti'),
            'category_type' => 'preset',
            'price' => 0,
            'original_price' => null,
            'on_sale' => false,
            'is_free' => true,
            'description' => 'Secuencia completa con stems separados: Drums, Bass, Guitars y Pads.',
            'cover_image' => 'covers/oceans.jpg',
            'demo_audio_url' => 'demos/oceans-preview.mp3',
            'download_path' => 'sounds/oceans-stems.zip',
            'payment_url' => null,
        ]);
    }
}
