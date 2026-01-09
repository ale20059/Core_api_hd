<?php

namespace Database\Seeders;

use App\Models\Biography;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BiographySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Biography::firstOrCreate(
            ['name' => 'John Doe'],
            [
                'responsibility' => 'Founder',
                'description' => 'John Doe is the founder of HD Academy, with over 20 years of experience in the music industry.',
                'photo_url' => 'john_doe.png',
                'is_active' => false
            ]
        );

        Biography::firstOrCreate(
            ['name' => 'Efra Luna'],
            [
                'responsibility' => 'vocal coach',
                'description' => 'Efra Luna is the vocal coach of HD Academy, specializing in vocal training and performance.',
                'photo_url' => 'efra_luna.png',
                'is_active' => true
            ]
        );

        Biography::firstOrCreate(
            ['name' => 'Jane Smith'],
            [
                'responsibility' => 'Music Producer',
                'description' => 'Jane Smith is a renowned music producer with numerous awards and accolades in the industry.',
                'photo_url' => 'default_photo.png',
                'is_active' => false
            ]
        );

        Biography::firstOrCreate(
            ['name' => 'Kate Canel'],
            [
                'responsibility' => 'Licda. Bachelor of Laws',
                'description' => 'Attorney with extensive experience in the practice of law, specializing in legal advisory services, legal analysis, and professional representation, committed to ethics and excellence.',
                'photo_url' => 'kate_canel.png',
                'is_active' => true
            ]
        );

        Biography::firstOrCreate(
            ['name' => 'Chechin Coronado'],
            [
                'responsibility' => 'Live Audio Engineer',
                'description' => 'Live Sound Engineer with experience in concerts, events, and live productions, focused on delivering high-quality audio and reliable sound reinforcement.',
                'photo_url' => 'Chechin_coronado.png',
                'is_active' => true
            ]
        );

        Biography::firstOrCreate(
            ['name' => 'Chifu Lopez'],
            [
                'responsibility' => 'Audio Production Technician',
                'description' => 'Music Production Technician with experience in recording, editing, and audio production, focused on delivering high-quality sound and professional results.',
                'photo_url' => 'chifu_lopez.png',
                'is_active' => true
            ]
        );
    }
}
