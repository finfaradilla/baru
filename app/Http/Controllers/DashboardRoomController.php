<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Rent;
use App\Models\Building;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class DashboardRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.rooms.index', [
            'title' => "Daftar Ruangan",
            'rooms' => Room::orderBy('created_at', 'desc')->paginate(10),
            'buildings' => Building::all(),
        ]);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'code' => 'required|max:30|unique:rooms',
                'name' => 'required',
                'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'floor' => 'required',
                'capacity' => 'required',
                'building_id' => 'required',
                'type' => 'required',
                'description' => 'required|max:250',
            ]);

            if ($request->file('img')) {
                $validatedData['img'] = $this->uploadImage($request, $validatedData['code']);
            }

            $validatedData['status'] = false;

            Room::create($validatedData);

            return redirect('/dashboard/rooms')->with('roomSuccess', 'Data ruangan berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect('/dashboard/rooms')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    private function uploadImage($request, $code)
    {
        $imgPath = $request->file('img')->storeAs('public/assets/images/ruang/', $code . '.' . $request->file('img')->extension());
        return 'assets/images/ruang/' . basename($imgPath);
    }    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        $imageUrls = [
            asset('img/lab-komputer.jpeg'),
            asset('img/lab-praktikum.jpeg'),
            asset('img/ruang-kelas.jpeg'),
        ];
        $randomImage = $imageUrls[array_rand($imageUrls)];

        return view('dashboard.rooms.show', [
            'title' => $room->name,
            'room' => $room,
            'rooms' => Room::all(),
            'rents' => Rent::where('room_id', $room->id)->get(),
            'randomImage' => $randomImage, 
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        $buildings = Building::all();

        return view('dashboard.rooms.edit', [
            'title' => 'Edit Ruangan: ' . $room->name,
            'room' => $room,
            'buildings' => $buildings,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        try {
            $rules = [
                'name' => 'required',
                'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'floor' => 'required',
                'capacity' => 'required',
                'building_id' => 'required',
                'type' => 'required',
                'description' => 'required|max:250',
            ];
    
            if ($request->code != $room->code) {
                $rules['code'] = 'required|max:20|unique:rooms';
            }
    
            $validatedData = $request->validate($rules);
    
            if ($request->file('img')) {
                // Hapus gambar lama jika ada
                if ($room->img && Storage::exists($room->img)) {
                    Storage::delete($room->img);
                }
    
                // Unggah gambar baru
                $imgPath = $request->file('img')->storeAs('public/assets/images/ruang/', $validatedData['code'] . '.' . $request->file('img')->extension());
                $validatedData['img'] = 'assets/images/ruang/' . basename($imgPath);
            }
    
            $validatedData['status'] = false;
    
            $room->update($validatedData);
    
            return redirect('/dashboard/rooms')->with('roomSuccess', 'Data ruangan berhasil diubah');
        } catch (\Exception $e) {
            return redirect('/dashboard/rooms')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        Room::destroy($room->id);
        return redirect('/dashboard/rooms')->with('deleteRoom', 'Data ruangan berhasil dihapus');
    }
}
