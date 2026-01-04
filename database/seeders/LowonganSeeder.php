<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lowongan;

class LowonganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Lowongan::create([
            'judul' => 'Software Engineer',
            'slug' => 'software-engineer',
            'perusahaan' => 'Tech Corp',
            'posisi' => 'Developer',
            'persyaratan' => 'Pengalaman 2 tahun, Laravel, PHP',
            'batas_waktu' => now()->addDays(30),
            'gambar' => 'public/storage/lowongan/Y0yUZnSqxcjb2bQg4DNiUwv2on8NzpWOlQ32Ctq4.jpg',
            'user_id' => 4,
        ]);

        Lowongan::create([
            'judul' => 'Marketing Specialist',
            'slug' => 'marketing-specialist',
            'perusahaan' => 'Market Inc',
            'posisi' => 'Marketing',
            'persyaratan' => 'Pengalaman di bidang marketing',
            'batas_waktu' => now()->addDays(20),
            'gambar' => 'public/storage/lowongan/Y0yUZnSqxcjb2bQg4DNiUwv2on8NzpWOlQ32Ctq4.jpg',
            'user_id' => 2,
        ]);

        Lowongan::create([
            'judul' => 'Data Analyst',
            'slug' => 'data-analyst',
            'perusahaan' => 'Data Solutions',
            'posisi' => 'Analyst',
            'persyaratan' => 'Kemampuan analisis data, SQL',
            'batas_waktu' => now()->addDays(15),
            'gambar' => 'public/storage/lowongan/Y0yUZnSqxcjb2bQg4DNiUwv2on8NzpWOlQ32Ctq4.jpg',
            'user_id' => 3,
        ]);
    }
}
