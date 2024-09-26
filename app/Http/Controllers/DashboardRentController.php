<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use App\Models\Room;
use App\Models\Item;
use App\Mail\RentConfirmationMail;
use App\Mail\RentCancellationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RentsExport;

class DashboardRentController extends Controller
{
    public function index()
    {
        $rents = Rent::with('room')->latest()->paginate(10);
        return view('dashboard.rents.index', [
            'adminRents' => Rent::latest()->paginate(10),
            'userRents' => Rent::where('user_id', auth()->user()->id)->get(),
            'title' => "Reservation",
            'rooms' => Room::all(),
            'items' => Item::all(),
            'rents' => $rents
        ]);
    }

    private function isTimeSlotAvailable($roomId, $startDateTime, $endDateTime)
    {
        return !Rent::where('room_id', $roomId)
            ->where(function ($query) use ($startDateTime, $endDateTime) {
                $query->where(function ($query) use ($startDateTime, $endDateTime) {
                    // Overlaps start or end
                    $query->where('time_start_use', '<', $endDateTime)
                          ->where('time_end_use', '>', $startDateTime);
                });
            })
            ->exists();
    }
    

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'room_id' => 'required',
            'time_start_date' => 'required|date',
            'time_start_time' => 'required|date_format:H:i',
            'duration' => 'required|integer|in:30,60,90,120,150,180,210,240,1440',
            'purpose' => 'required|max:250',
            'number_of_pax' => 'required|integer|min:1',
            'additional_request' => 'nullable|string|max:500',
            'items' => 'nullable|array',
            'items.*' => 'exists:items,id',
        ]);

        $room = Room::find($validatedData['room_id']);

        if ($validatedData['number_of_pax'] > $room->capacity) {
            return redirect()->back()->withErrors(['number_of_pax' => 'Your number of pax is more than the room capacity.'])->withInput();
        }

        if ($request->has('items') && is_array($request->items)) {
            foreach ($request->items as $itemId) {
                $item = Item::find($itemId);

                if (!$item->available) {
                    return redirect()->back()->withErrors(['items' => 'Some selected items are not available.']);
                }
            }
        }

        $startDate = Carbon::createFromFormat('Y-m-d', $validatedData['time_start_date']);
        $startTime = Carbon::createFromFormat('H:i', $validatedData['time_start_time']);
        $startDateTime = $startDate->setTime($startTime->hour, $startTime->minute);
        $endDateTime = $startDateTime->copy()->addMinutes($validatedData['duration']);

        if (!$this->isTimeSlotAvailable($validatedData['room_id'], $startDateTime, $endDateTime)) {
            return redirect()->back()->withErrors(['time_start_time' => 'This time slot is already booked. Please choose a different time.'])->withInput();
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['transaction_start'] = now();
        $validatedData['status'] = 'booked';
        $validatedData['time_start_use'] = $startDateTime;
        $validatedData['time_end_use'] = $endDateTime;

        $rent = Rent::create($validatedData);
        $rent->items()->sync($request->items);

        if (is_array($request->items) && !empty($request->items)) {
            foreach ($request->items as $itemId) {
                $item = Item::find($itemId);
                if ($item) {
                    $item->available = 0;
                    $item->save();
                }
            }
        }

        $adminEmail = 'it-ext@scorpapranedya.co.id';
        Mail::to($rent->user->email)->send(new RentConfirmationMail($rent));
        Mail::to($adminEmail)->send(new RentConfirmationMail($rent));

        if (auth()->user()->role_id === 1) {
            return redirect('/dashboard/rents')->with('rentSuccess', 'Reservation already booked.');
        } elseif (auth()->user()->role_id === 2) {
            return redirect('/daftarpinjam')->with('rentSuccess', 'Reservation already booked.');
        }
    }

    public function edit($id)
    {
        $rent = Rent::findOrFail($id);
        $room = Room::all();
        $roomByRent = Room::find($rent->room_id);
        $items = Item::all();
        $title = 'Reservation';

        // Convert time_start_use to date and time
        $time_start_date = $rent->time_start_use->format('Y-m-d');
        $time_start_time = $rent->time_start_use->format('H:i');

        return view('editshowruang', compact('rent', 'room', 'items', 'title', 'time_start_date', 'time_start_time', 'roomByRent'));
    }


    public function updateshowruang(Request $request, $id)
    {
        // Validasi input dari form
        $validatedData = $request->validate([
            // Gak perlu validasi room_id dari form, karena kita ambil dari database
            'time_start_date' => 'required|date',
            'time_start_time' => 'required|date_format:H:i',
            'duration' => 'required|integer|in:30,60,90,120,150,180,210,240,1440',
            'purpose' => 'required|max:250',
            'number_of_pax' => 'required|integer|min:1',
            'additional_request' => 'nullable|string|max:500',
            'items' => 'array',
            'items.*' => 'exists:items,id',
        ]);

        // Cari rent berdasarkan id
        $rent = Rent::findOrFail($id);

        // Ambil room_id dari rent yang ditemukan
        $validatedData['room_id'] = $rent->room_id;

        // Update item availability jika ada perubahan
        if ($request->has('items')) {
            // Reset all items availability before re-assigning
            $rent->items()->update(['available' => 1]);

            // Reassign selected items and mark them unavailable
            $rent->items()->sync($request->items);

            foreach ($request->items as $itemId) {
                $item = Item::find($itemId);
                $item->update(['available' => 0]);
            }
        }

        // Convert waktu mulai dan waktu selesai dari input form
        $startDate = Carbon::createFromFormat('Y-m-d', $validatedData['time_start_date']);
        $startTime = Carbon::createFromFormat('H:i', $validatedData['time_start_time']);
        $startDateTime = $startDate->setTime($startTime->hour, $startTime->minute);
        $endDateTime = $startDateTime->copy()->addMinutes($validatedData['duration']);

        // Update rent record
        $rent->update([
            'room_id' => $validatedData['room_id'],
            'time_start_use' => $startDateTime,
            'time_end_use' => $endDateTime,
            'purpose' => $validatedData['purpose'],
            'number_of_pax' => $validatedData['number_of_pax'],
            'additional_request' => $validatedData['additional_request'],
        ]);

        // Redirect setelah update berhasil
        return redirect('/daftarpinjam')->with('rentSuccess', 'Reservation updated.');
    }


    public function getBookings(Request $request)
    {
        $date = $request->date;
        $roomId = $request->room_id; // Get room_id from request
        $bookings = Rent::where('room_id', $roomId) // Filter by room_id
            ->whereDate('time_start_use', $date)
            ->get(['time_start_use', 'time_end_use']);

        return response()->json($bookings);
    }

    public function destroy($id)
    {
        $rent = Rent::findOrFail($id);

        if (auth()->user()->id !== $rent->user_id) {
            return redirect('/daftarpinjam')->with('rentError', 'You are not authorized to delete this reservation.');
        }

        // Make all items associated with the rent available again
        foreach ($rent->items as $item) {
            $item->available = true;
            $item->save();
        }

        $rent->delete();

        return redirect('/daftarpinjam')->with('rentSuccess', 'Reservation deleted successfully.');
    }


    public function endTransaction($id)
    {
        $rent = Rent::find($id);

        $rent->update([
            'transaction_end' => now(),
            'status' => 'returned',
        ]);

        foreach ($rent->items as $item) {
            $item->available = true;
            $item->save();
        }

        return redirect('/dashboard/rents');
    }

    public function export()
    {
        return Excel::download(new RentsExport, 'rents.xlsx');
    }

    public function cancelRent(Request $request, $id)
    {
        $rent = Rent::findOrFail($id);

        // Update the status and add the cancellation reason
        $rent->update([
            'status' => 'rejected',
            'transaction_end' => now(),
            'rejection_reason' => $request->input('rejection_reason'),
        ]);

        // Make all items associated with the rent available again
        foreach ($rent->items as $item) {
            $item->available = true;
            $item->save();
        }

        Mail::to($rent->user->email)->send(new RentCancellationMail($rent));
        Mail::to('it-ext@scorpapranedya.co.id')->send(new RentCancellationMail($rent));

        return redirect('/dashboard/rents')->with('rentSuccess', 'Reservation cancelled.');
    }
}
