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
            'rooms' => Room::orderBy('created_at', 'desc')->paginate(6),
            'buildings' => Building::all(),
        ]);  
    }

    public function show(Room $room)
    {
    
        return view('showruang', [
            'title' => $room->name,
            'room' => $room,
            'rooms' => Room::all(),
            'rents' => Rent::where('room_id', $room->id)->latest()->paginate(5), 
        ]);
    }
}
