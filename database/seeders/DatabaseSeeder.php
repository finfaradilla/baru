<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Faculty;
use App\Models\Building;
use App\Models\Room;
use App\Models\Admin;
use App\Models\Role;
use App\Models\Rent;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        { {
            }
        }
        // \Ap{{ p\Mo }}dels\User::factory()->create([
        //    {{  'na }}me' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Role::create([
            'name' => 'admin',
        ]);

        Role::create([
            'name' => 'mahasiswa',
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'nomor_induk' => '21312131',
            'role_id' => 1,
        ]);

        User::create([
            'name' => 'Mahasiswa',
            'email' => 'mahasiswa@gmail.com',
            'password' => bcrypt('mahasiswa'),
            'nomor_induk' => '21312109',
            'role_id' => 2,
        ]);

        Faculty::create([
            'code' => 'FTIK',
            'name' => 'Fakultas Teknik dan Ilmu Komputer',
        ]);
        Faculty::create([
            'code' => 'FEB',
            'name' => 'Fakultas Ekonomi Bisnis',
        ]);
        Faculty::create([
            'code' => 'FSIP',
            'name' => 'Fakultas Sastra dan Ilmu Pendidikan',
        ]);

        Building::create([
            'code' => 'ged-a',
            'name' => 'Gedung A',
            'faculty_id' => 2,
        ]);

        Building::create([
            'code' => 'ged-gsg',
            'name' => 'Gedung GSG',
            'faculty_id' => 1,
        ]);

        Building::create([
            'code' => 'ged-ict',
            'name' => 'Gedung ICT',
            'faculty_id' => 1,
        ]);

        Building::create([
            'code' => 'ged-b',
            'name' => 'Gedung B',
            'faculty_id' => 3,
        ]);

        Room::create([
            'code' => 'Lab 1 GSG',
            'name' => 'Lab 1 GSG',
            'img' => 'assets/images/ruang/Lab2A.jpeg',
            'floor' => 2,
            'status' => false,
            'capacity' => 50,
            'type' => 'Lab Komputer',
            'description' => 'Laboratorium kampus adalah fasilitas vital dalam lingkungan pendidikan tinggi, menyediakan lingkungan yang didedikasikan untuk eksperimen, riset, dan kegiatan praktis di berbagai bidang studi.',
            'building_id' => 2,
        ]);

        
        Room::create([
            'code' => 'Lab 2 GSG',
            'name' => 'Lab 2 GSG',
            'img' => 'assets/images/ruang/LabICT.jpeg',
            'floor' => 2,
            'status' => false,
            'capacity' => 50,
            'type' => 'Lab Komputer',
            'description' => 'Laboratorium kampus adalah fasilitas vital dalam lingkungan pendidikan tinggi, menyediakan lingkungan yang didedikasikan untuk eksperimen, riset, dan kegiatan praktis di berbagai bidang studi.',
            'building_id' => 2,
        ]);

        Room::create([
            'code' => 'Lab 3 GSG',
            'name' => 'Lab 3 GSG',
            'img' => 'assets/images/ruang/LabDigital.jpeg',
            'floor' => 3,
            'status' => false,
            'capacity' => 50,
            'type' => 'Lab Komputer',
            'description' => 'Laboratorium kampus adalah fasilitas vital dalam lingkungan pendidikan tinggi, menyediakan lingkungan yang didedikasikan untuk eksperimen, riset, dan kegiatan praktis di berbagai bidang studi.',
            'building_id' => 2,
        ]);
        
        Room::create([
            'code' => 'Lab 4 GSG',
            'name' => 'Lab 4 GSG',
            'img' => 'assets/images/ruang/LabICT.jpeg',
            'floor' => 3,
            'status' => false,
            'capacity' => 50,
            'type' => 'Lab Komputer',
            'description' => 'Laboratorium kampus adalah fasilitas vital dalam lingkungan pendidikan tinggi, menyediakan lingkungan yang didedikasikan untuk eksperimen, riset, dan kegiatan praktis di berbagai bidang studi.',
            'building_id' => 2,
        ]);

        Room::create([
            'code' => 'Lab 1 A',
            'name' => 'Lab 1 A',
            'img' => 'assets/images/ruang/Lab2A.jpeg',
            'floor' => 3,
            'status' => false,
            'capacity' => 50,
            'type' => 'Lab Komputer',
            'description' => 'Laboratorium kampus adalah fasilitas vital dalam lingkungan pendidikan tinggi, menyediakan lingkungan yang didedikasikan untuk eksperimen, riset, dan kegiatan praktis di berbagai bidang studi.',
            'building_id' => 1,
        ]);

        Room::create([
            'code' => 'Lab Bisnis Digital',
            'name' => 'Lab Bisnis Digital',
            'img' => 'assets/images/ruang/LabDigital.jpeg',
            'floor' => 3,
            'status' => false,
            'capacity' => 40,
            'type' => 'Lab Komputer',
            'description' => 'Laboratorium kampus adalah fasilitas vital dalam lingkungan pendidikan tinggi, menyediakan lingkungan yang didedikasikan untuk eksperimen, riset, dan kegiatan praktis di berbagai bidang studi.',
            'building_id' => 1,
        ]);
        
        Room::create([
            'code' => 'Lab 2 A',
            'name' => 'Lab 2 A',
            'img' => 'assets/images/ruang/Lab2A.jpeg',
            'floor' => 3,
            'status' => false,
            'capacity' => 40,
            'type' => 'Lab Komputer',
            'description' => 'Laboratorium kampus adalah fasilitas vital dalam lingkungan pendidikan tinggi, menyediakan lingkungan yang didedikasikan untuk eksperimen, riset, dan kegiatan praktis di berbagai bidang studi.',
            'building_id' => 1,
        ]);

        Room::create([
            'code' => 'Lab Bahasa',
            'name' => 'Lab Bahasa',
            'img' => 'assets/images/ruang/Lab2A.jpeg',
            'floor' => 2,
            'status' => false,
            'capacity' => 40,
            'type' => 'Lab Komputer',
            'description' => 'Laboratorium kampus adalah fasilitas vital dalam lingkungan pendidikan tinggi, menyediakan lingkungan yang didedikasikan untuk eksperimen, riset, dan kegiatan praktis di berbagai bidang studi.',
            'building_id' => 1,
        ]);

         Room::create([
            'code' => 'Aula A',
            'name' => 'Aula A',
            'img' => 'assets/images/ruang/Lab2A.jpeg',
            'floor' => 4,
            'status' => false,
            'capacity' => 100,
            'type' => 'Aula',
            'description' => 'Laboratorium kampus adalah fasilitas vital dalam lingkungan pendidikan tinggi, menyediakan lingkungan yang didedikasikan untuk eksperimen, riset, dan kegiatan praktis di berbagai bidang studi.',
            'building_id' => 1,
        ]);

        Room::create([
            'code' => '401 A',
            'name' => '401 A',
            'img' => 'assets/images/ruang/LabDigital.jpeg',
            'floor' => 4,
            'status' => false,
            'capacity' => 80,
            'type' => 'Ruang Kelas',
            'description' => 'Laboratorium kampus adalah fasilitas vital dalam lingkungan pendidikan tinggi, menyediakan lingkungan yang didedikasikan untuk eksperimen, riset, dan kegiatan praktis di berbagai bidang studi.',
            'building_id' => 1,
        ]);

        Room::create([
            'code' => '402 A',
            'name' => '402 A',
            'img' => 'assets/images/ruang/LabDigital.jpeg',
            'floor' => 4,
            'status' => false,
            'capacity' => 80,
            'type' => 'Ruang Kelas',
            'description' => 'Laboratorium kampus adalah fasilitas vital dalam lingkungan pendidikan tinggi, menyediakan lingkungan yang didedikasikan untuk eksperimen, riset, dan kegiatan praktis di berbagai bidang studi.',
            'building_id' => 1,
        ]);

        Room::create([
            'code' => '209',
            'name' => '209',
            'img' => 'assets/images/ruang/Lab2A.jpeg',
            'floor' => 2,
            'status' => false,
            'capacity' => 45,
            'type' => 'Ruang Kelas',
            'description' => 'Laboratorium kampus adalah fasilitas vital dalam lingkungan pendidikan tinggi, menyediakan lingkungan yang didedikasikan untuk eksperimen, riset, dan kegiatan praktis di berbagai bidang studi.',
            'building_id' => 1,
        ]);

        Room::create([
            'code' => '201 B',
            'name' => '201 B',
            'img' => 'assets/images/ruang/201b.jpeg',
            'floor' => 2,
            'status' => false,
            'capacity' => 50,
            'type' => 'Ruang Kelas',
            'description' => 'Laboratorium kampus adalah fasilitas vital dalam lingkungan pendidikan tinggi, menyediakan lingkungan yang didedikasikan untuk eksperimen, riset, dan kegiatan praktis di berbagai bidang studi.',
            'building_id' => 4,
        ]);

        Room::create([
            'code' => '202 B',
            'name' => '202 B',
            'img' => 'assets/images/ruang/202b.jpeg',
            'floor' => 2,
            'status' => false,
            'capacity' => 50,
            'type' => 'Ruang Kelas',
            'description' => 'Laboratorium kampus adalah fasilitas vital dalam lingkungan pendidikan tinggi, menyediakan lingkungan yang didedikasikan untuk eksperimen, riset, dan kegiatan praktis di berbagai bidang studi.',
            'building_id' => 4,
        ]);

        Room::create([
            'code' => '203 B',
            'name' => '203 B',
            'img' => 'assets/images/ruang/201b.jpeg',
            'floor' => 2,
            'status' => false,
            'capacity' => 40,
            'type' => 'Ruang Kelas',
            'description' => 'Laboratorium kampus adalah fasilitas vital dalam lingkungan pendidikan tinggi, menyediakan lingkungan yang didedikasikan untuk eksperimen, riset, dan kegiatan praktis di berbagai bidang studi.',
            'building_id' => 4,
        ]);

        Room::create([
            'code' => '204 B',
            'name' => '204 B',
            'img' => 'assets/images/ruang/203b.jpeg',
            'floor' => 2,
            'status' => false,
            'capacity' => 50,
            'type' => 'Ruang Kelas',
            'description' => 'Laboratorium kampus adalah fasilitas vital dalam lingkungan pendidikan tinggi, menyediakan lingkungan yang didedikasikan untuk eksperimen, riset, dan kegiatan praktis di berbagai bidang studi.',
            'building_id' => 4,
        ]);

        Room::create([
            'code' => '301 B',
            'name' => '301 B',
            'img' => 'assets/images/ruang/301b.jpeg',
            'floor' => 3,
            'status' => false,
            'capacity' => 50,
            'type' => 'Ruang Kelas',
            'description' => 'Laboratorium kampus adalah fasilitas vital dalam lingkungan pendidikan tinggi, menyediakan lingkungan yang didedikasikan untuk eksperimen, riset, dan kegiatan praktis di berbagai bidang studi.',
            'building_id' => 4,
        ]);

        Room::create([
            'code' => '302 B',
            'name' => '302 B',
            'img' => 'assets/images/ruang/201b.jpeg',
            'floor' => 3,
            'status' => false,
            'capacity' => 50,
            'type' => 'Ruang Kelas',
            'description' => 'Laboratorium kampus adalah fasilitas vital dalam lingkungan pendidikan tinggi, menyediakan lingkungan yang didedikasikan untuk eksperimen, riset, dan kegiatan praktis di berbagai bidang studi.',
            'building_id' => 4,
        ]);
        
        Room::create([
            'code' => '303 B',
            'name' => '303 B',
            'img' => 'assets/images/ruang/202b.jpeg',
            'floor' => 3,
            'status' => false,
            'capacity' => 50,
            'type' => 'Ruang Kelas',
            'description' => 'Laboratorium kampus adalah fasilitas vital dalam lingkungan pendidikan tinggi, menyediakan lingkungan yang didedikasikan untuk eksperimen, riset, dan kegiatan praktis di berbagai bidang studi.',
            'building_id' => 4,
        ]);

        Room::create([
            'code' => '304 B',
            'name' => '304 B',
            'img' => 'assets/images/ruang/203b.jpeg',
            'floor' => 3,
            'status' => false,
            'capacity' => 40,
            'type' => 'Ruang Kelas',
            'description' => 'Laboratorium kampus adalah fasilitas vital dalam lingkungan pendidikan tinggi, menyediakan lingkungan yang didedikasikan untuk eksperimen, riset, dan kegiatan praktis di berbagai bidang studi.',
            'building_id' => 4,
        ]);

        Room::create([
            'code' => 'Lab Software',
            'name' => 'Lab Software',
            'img' => 'assets/images/ruang/LabICT.jpeg',
            'floor' => 2,
            'status' => false,
            'capacity' => 50,
            'type' => 'Lab Komputer',
            'description' => 'Laboratorium kampus adalah fasilitas vital dalam lingkungan pendidikan tinggi, menyediakan lingkungan yang didedikasikan untuk eksperimen, riset, dan kegiatan praktis di berbagai bidang studi.',
            'building_id' => 3,
        ]);

        Room::create([
            'code' => 'Lab Gambar',
            'name' => 'Lab Gambar',
            'img' => 'assets/images/ruang/LabGambar.jpeg',
            'floor' => 1,
            'status' => false,
            'capacity' => 50,
            'type' => 'Ruang Kelas',
            'description' => 'Laboratorium kampus adalah fasilitas vital dalam lingkungan pendidikan tinggi, menyediakan lingkungan yang didedikasikan untuk eksperimen, riset, dan kegiatan praktis di berbagai bidang studi.',
            'building_id' => 3,
        ]);

        Room::create([
            'code' => '301 ICT B',
            'name' => '301 ICT B',
            'img' => 'assets/images/ruang/301ICT.jpeg',
            'floor' => 3,
            'status' => false,
            'capacity' => 100,
            'type' => 'Ruang Kelas',
            'description' => 'Laboratorium kampus adalah fasilitas vital dalam lingkungan pendidikan tinggi, menyediakan lingkungan yang didedikasikan untuk eksperimen, riset, dan kegiatan praktis di berbagai bidang studi.',
            'building_id' => 3,
        ]);

    }
}
