<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Rent;
use App\Models\Building;

class DaftarRuangController extends Controller
{
    public function index()
    {
        return view('daftarruang', [
            'title' => "Daftar Ruang",
            'rooms' => Room::latest()->paginate(6),
            'buildings' => Building::all(),
        ]);  
    }

    public function show(Room $room)
    {
        $imageUrls = [
            asset('img/lab-komputer.jpeg'),
            asset('img/lab-praktikum.jpeg'),
            asset('img/ruang-kelas.jpeg'),
        ];
        $randomImage = $imageUrls[array_rand($imageUrls)];
    
        return view('showruang', [
            'title' => $room->name,
            'room' => $room,
            'rooms' => Room::all(),
            'rents' => Rent::where('room_id', $room->id)->get(),
            'randomImage' => $randomImage, 
        ]);
    }
}
