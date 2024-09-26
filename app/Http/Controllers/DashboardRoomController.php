<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Rent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


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
            'title' => "Room List",
            'rooms' => Room::orderBy('created_at', 'desc')->paginate(10),
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
                'name' => 'required',
                'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'floor' => 'required',
                'capacity' => 'required',
                'type' => 'required',
                'description' => 'required|max:250',
            ]);

            $validatedData['code'] = 'RM' . strtoupper(Str::random(6));

            if ($request->file('img')) {
                $validatedData['img'] = $this->uploadImage($request, $validatedData['code']);
            }

            $validatedData['status'] = false;

            $room = Room::create($validatedData);
            if ($request->has('items')) {
            foreach ($request->items as $item) {
                $room->items()->create(['name' => $item['name']]);
            }
        }

            return redirect('/dashboard/rooms')->with('roomSuccess', 'Room added');
        } catch (\Exception $e) {
            return redirect('/dashboard/rooms')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    private function uploadImage($request, $code)
    {
        if ($request->file('img')) {
            // Store the image in the public disk under 'assets/images/ruang'
            $imgPath = $request->file('img')->storeAs('assets/images/ruang', $code . '.' . $request->file('img')->extension(), 'public');
            return $imgPath;
        }
        return null;
    }
    
    
    /**
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
        return view('dashboard.rooms.edit', [
            'title' => 'Edit Ruangan: ' . $room->name,
            'room' => $room,
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
            // Validation rules
            $rules = [
                'name' => 'required',
                'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'floor' => 'required',
                'capacity' => 'required',
                'type' => 'required',
                'description' => 'required|max:250',
            ];
    
            // If the code is being changed, add the code validation rule
            if ($request->code != $room->code) {
                $rules['code'] = 'required|max:20|unique:rooms';
            }
    
            // Validate the request
            $validatedData = $request->validate($rules);
    
            // Handle file upload if a new image is uploaded
            if ($request->file('img')) {
                // Delete old image if it exists
                if ($room->img && Storage::exists($room->img)) {
                    Storage::delete($room->img);
                }
    
                // Upload the new image
                $imgPath = $request->file('img')->storeAs('public/assets/images/ruang/', $room->code . '.' . $request->file('img')->extension());
                $validatedData['img'] = 'assets/images/ruang/' . basename($imgPath);
            }
    
            // Update room data
            $room->update($validatedData);
    
            return redirect('/dashboard/rooms')->with('roomSuccess', 'Room changed successfully');
        } catch (\Exception $e) {
            return redirect('/dashboard/rooms')->with('error', 'An error occurred: ' . $e->getMessage());
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
        return redirect('/dashboard/rooms')->with('deleteRoom', 'Room deleted');
    }
}
