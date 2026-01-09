<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();

            $table->enum('category_type', [
                'sequence',
                'preset',
                'sound_pack',
                'preset_pack',
                'chart',
                'plugin',
                'course',
                'live_event'
            ])->default('sequence');

            $table->decimal('price', 8, 2)->default(0);
            $table->decimal('original_price', 8, 2)->nullable();
            $table->boolean('on_sale')->default(false);

            $table->boolean('is_free')->default(false);

            $table->text('description');

            $table->string('cover_image');
            $table->string('demo_audio_url')->nullable();

            $table->string('download_path')->nullable();

            $table->boolean('is_live')->default(false);
            $table->dateTime('event_date')->nullable();
            $table->string('video_embed_code')->nullable();

            $table->string('payment_url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
