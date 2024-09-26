<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rent;
use App\Models\Room;
use Carbon\Carbon;

class DaftarPinjamController extends Controller
{
    public function index()
    {
        return view('daftarpinjam', [
            'userRents' => Rent::latest()->paginate(5),
            'title' => "Reservation List",
            'rooms' => Room::all(),
        ]);
    }
}
