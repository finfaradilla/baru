@extends('dashboard.layouts.main')

@section('container')
<div class="col-md-10 p-0">
    <div class="card-body text-end">
        @if (session()->has('rentSuccess'))
        <div class="col-md-16 mx-auto alert alert-success text-center alert-dismissible fade show" style="margin-top: 50px" role="alert">
            {{ session('rentSuccess') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if (session()->has('deleteRent'))
        <div class="col-md-16 mx-auto alert alert-success text-center alert-dismissible fade show" style="margin-top: 50px" role="alert">
            {{ session('deleteRent') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if (auth()->user()->role_id === 1)
        <button type="button" class="mb-3 btn button btn-secondary" data-bs-toggle="modal" data-bs-target="#bookingbaruRuangan">
            Booking
        </button>
        <a href="{{ route('rents.export') }}" class="mb-3 btn button btn-success">Export to Excel</a>
        @endif

        @if (auth()->user()->role_id === 1)
        @endif
        <div class="table-responsive">
            <div class="d-flex justify-content-start">
                {{ $adminRents->links() }}
            </div>
            <table class="table table-hover table-stripped table-bordered text-center dt-head-center" id="datatable">
                <thead class="table-success">
                    <tr>
                        <th scope="row">No.</th>
                        <th scope="row">Room Code</th>
                        @if (auth()->user()->role_id <= 2) <th scope="row">Name</th>
                            @endif
                            <th scope="row">Start Time</th>
                            <th scope="row">End Time</th>
                            <th scope="row">Purpose</th>
                            <th scope="row">Items</th>
                            <th scope="row">Number of Pax</th>
                            <th scope="row">Additional Request</th>
                            <th scope="row">Booking Time</th>
                            <th scope="row">Return/Cancel</th>
                            <th scope="row">Status</th>
                            <th scope="row">Rejection Reason</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($adminRents->count() > 0)
                    @foreach ($adminRents as $rent)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>
                            @if($rent->room)
                            {{ $rent->room->name }}
                            @else
                            <span class="text-muted">Room Deleted</span>
                            @endif
                        </td>
                        <td>{{ $rent->user->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($rent->time_start_use)->format('d M Y H:i') }}</td>
                        <td>{{ \Carbon\Carbon::parse($rent->time_end_use)->format('d M Y H:i') }}</td>
                        <td>{{ $rent->purpose }}</td>
                        <td>
                            @foreach ($rent->items as $item)
                            {{ $item->name }}{{ $loop->last ? '' : ', ' }}
                            @endforeach
                        </td>
                        <td>{{ $rent->number_of_pax }}</td>
                        <td>{{ $rent->additional_request }}</td>
                        <td>{{ \Carbon\Carbon::parse($rent->transaction_start)->format('d M Y H:i') }}</td>
                        <td>
                            @if ($rent->status == 'booked')
                            <a href="/dashboard/rents/{{ $rent->id }}/endTransaction" class="btn btn-success" type="submit" style="padding: 2px 10px"><i class="bi bi-check fs-5"></i></a>
                            <button type="button" class="btn btn-danger ms-2" data-bs-toggle="modal" data-bs-target="#cancelRentModal-{{ $rent->id }}" style="padding: 2px 10px"><i class="bi bi-x fs-5"></i></button>
                            @else
                            {{ \Carbon\Carbon::parse($rent->transaction_end)->format('d M Y H:i') }}
                            @endif
                        </td>
                        <td>{{ $rent->status }}</td>
                        <td>{{ $rent->rejection_reason }}</td>

                    </tr>
                    @include('dashboard.partials.cancelRentModal', ['rent' => $rent])
                    @endforeach
                    @else
                    <tr>
                        <td colspan="10" class="text-center">
                            -- No one booked yet --
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-start">
            {{ $adminRents->links() }}
        </div>
    </div>
</div>
@include('dashboard.partials.bookingbaruRuangan')
@endsection