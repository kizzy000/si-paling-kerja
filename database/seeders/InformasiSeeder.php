<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Informasi;

class InformasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Informasi::create([
            'judul' => 'Tips Mencari Kerja',
            'slug' => 'tips-mencari-kerja',
            'deskripsi' => 'Panduan lengkap untuk mencari kerja di era digital.',
            'excerpt' => 'Panduan lengkap untuk mencari kerja di era digital.',
            'file' => 'public/storage/informasi/tips.jpg',
            'user_id' => 1,
        ]);

        Informasi::create([
            'judul' => 'CV yang Menarik',
            'slug' => 'cv-yang-menarik',
            'deskripsi' => 'Cara membuat CV yang menarik perhatian perusahaan.',
            'excerpt' => 'Cara membuat CV yang menarik perhatian perusahaan.',
            'file' => 'public/storage/informasi/cv-guide.jpg',
            'user_id' => 1,
        ]);

        Informasi::create([
            'judul' => 'Interview Tips',
            'slug' => 'interview-tips',
            'deskripsi' => 'Tips sukses dalam wawancara kerja.',
            'excerpt' => 'Tips sukses dalam wawancara kerja.',
            'file' => 'public/storage/informasi/interview.jpg',
            'user_id' => 1,
        ]);
    }
}
