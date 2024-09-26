<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Rent;
use App\Models\Item;
use Carbon\Carbon;

class DaftarRuangController extends Controller
{
    public function index()
    {
        $rooms = Room::with(['rents' => function ($query) {
            $query->where('status', 'booked')
                ->whereDate('time_start_use', '>=', Carbon::now())
                ->whereDate('time_start_use', '<=', Carbon::tomorrow())                ->orderBy('time_start_use', 'asc');
        }])->orderBy('created_at', 'desc')->paginate(6);

        return view('daftarruang', [
            'title' => "Room List",
            'rooms' => Room::orderBy('created_at', 'desc')->paginate(6),
            'rooms' => $rooms,
        ]);
    }

    public function show(Room $room)
    {

        return view('showruang', [
            'title' => $room->name,
            'room' => $room,
            'rooms' => Room::all(),
            'rents' => Rent::where('room_id', $room->id)->latest()->paginate(5),
            'items' => Item::all(),
        ]);
    }
}
