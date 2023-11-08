<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rent;
use App\Models\Room;

class DaftarPinjamController extends Controller
{
    public function index()
    {
        return view('daftarpinjam', [
            'userRents' => Rent::where('user_id', auth()->user()->id)->latest()->paginate(5),
            'title' => "Daftar Pinjam",
            'rooms' => Room::all(),
        ]);
    }
}
