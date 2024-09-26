@extends('layouts.main')

@section('container')
<div class="preloader">
    <div class="loader">
        <div class="ytp-spinner">
            <div class="ytp-spinner-container">
                <div class="ytp-spinner-rotator">
                    <div class="ytp-spinner-left">
                        <div class="ytp-spinner-circle"></div>
                    </div>
                    <div class="ytp-spinner-right">
                        <div class="ytp-spinner-circle"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<section id="blog" class="blog-area pt-170 pb-140">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-7">
                <div class="section-title">
                    <h2 class="wow fadeInUp" data-wow-delay=".2s">Booking List</h2>

                </div>
            </div>
        </div>
        <div class="row">

            <div class="p-0">
                <div class="card-body text-end">
                    @if (session()->has('rentSuccess'))
                    <div class="col-md-16 mx-auto alert alert-success text-center  alert-success alert-dismissible fade show" style="margin-top: 50px" role="alert">
                        {{ session('rentSuccess') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <div class="table-responsive justify-content-center">
                        <div class="d-flex justify-content-end">
                            {{ $userRents->links() }}
                        </div>

                        <table class="fl-table">
                            <thead>
                                <tr>
                                    <th scope="row">No.</th>
                                    <th scope="row">Room Name</th>
                                    <th scope="row">User Name</th>
                                    <th scope="row">Start Time</th>
                                    <th scope="row">End Time</th>
                                    <th scope="row">Item</th>
                                    <th scope="row">Purpose</th>
                                    <th scope="row">Number of Pax</th>
                                    <th scope="row">Booking Time</th>
                                    <th scope="row">Return</th>
                                    <th scope="row">Additional Request</th>
                                    <th scope="row">Status</th>
                                    <th scope="row">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($userRents->count() > 0)
                                @foreach ($userRents as $rent)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th scope="row">
                                    <td>
                                        @if($rent->room)
                                        {{ $rent->room->name }}
                                        @else
                                        <span class="text-muted">Room Deleted</span>
                                        @endif
                                    </td>
                                    </td>
                                    @if (auth()->user()->role_id <= 2) <td>{{ $rent->user->name }}</td>
                                        @endif
                                        <td>{{ \Carbon\Carbon::parse($rent->time_start_use)->format('d M Y H:i') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($rent->time_end_use)->format('d M Y H:i') }}</td>
                                        <td>
                                            @foreach ($rent->items as $item)
                                            {{ $item->name }}{{ $loop->last ? '' : ', ' }}
                                            @endforeach
                                        </td>
                                        <td>{{ $rent->purpose }}</td>
                                        <td>{{ $rent->number_of_pax }}</td>
                                        <td>{{ \Carbon\Carbon::parse($rent->transaction_start)->format('d M Y H:i') }}</td>
                                        @if ($rent->status == 'booked')
                                        <td>-</td>
                                        @else
                                        @if (!is_null($rent->transaction_end))
                                        <td>{{ \Carbon\Carbon::parse($rent->transaction_end)->format('d M Y H:i') }}</td>
                                        @else
                                        <td>-</td>
                                        @endif
                                        @endif
                                        <td>{{ $rent->additional_request }}</td>
                                        <td>{{ $rent->status }}</td>
                                        <td>
                                            @if (auth()->user()->id === $rent->user_id && !in_array($rent->status, ['returned', 'rejected']))
                                            <a href="{{ url('/editshowruang/' . $rent->id) }}" class="btn btn-warning btn-sm rounded-pill btn-hover fw-semibold text-white" style="font-size: 12px; padding: 5px 8px;">Edit</a>
                                            <form action="{{ url('/deleterent/' . $rent->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm rounded-pill btn-hover fw-semibold text-white" style="font-size: 12px; padding: 5px 8px;" onclick="return confirm('Are you sure you want to delete this reservation?');">Delete</button>
                                            </form>
                                            @endif
                                        </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="9" class="text-center">
                                        -- No room has booked yet --
                                    </td>
                                </tr>
                                @endif
                            <tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection