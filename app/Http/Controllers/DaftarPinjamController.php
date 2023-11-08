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
            'adminRents' => Rent::latest()->get(),
            'userRents' => Rent::where('user_id', auth()->user()->id)->get(),
            'title' => "Daftar Pinjam",
            'rooms' => Room::all(),
        ]);
    }
}
