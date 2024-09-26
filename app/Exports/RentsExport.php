<?php

namespace App\Exports;

use App\Models\Rent;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RentsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Rent::with(['room', 'user'])->get()->map(function ($rent) {
            return [
                'Room Name' => $rent->room ? $rent->room->name : 'Room Deleted',
                'Name' => $rent->user->name,
                'Start Time' => $rent->time_start_use,
                'End Time' => $rent->time_end_use,
                'Purpose' => $rent->purpose,
                'Number of Pax' => $rent->number_of_pax,
                'Additional Request' => $rent->additional_request,
                'Booking Time' => $rent->transaction_start,
                'Status' => $rent->status,
                'Rejection Reason' => $rent->rejection_reason,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Room Name',
            'Name',
            'Start Time',
            'End Time',
            'Purpose',
            'Number of Pax',
            'Additional Request',
            'Booking Time',
            'Status',
            'Rejection Reason',
        ];
    }
}