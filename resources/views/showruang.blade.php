@extends('layouts.main')

@section('container')
    <!--====== Show Ruang ======-->
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
    <section id="blog" class="container blog-area pt-170 pb-140">
        <div>
            <div class="container row align-items-center  ">
                <div class="col-xl-6 col-lg-6">
                    <div class="welcome-content">
                        <div class="section-title">
                            <h3 class="mb-35 wow fadeInUp" data-wow-delay=".2s"> {{ $room->name }}</h3>
                        </div>
                        <div class="content">
                            <table>
                                <tr>
                                    <td>
                                        <p class="wow fadeInUp" data-wow-delay=".2s">
                                            Room code
                                        </p>
                                    </td>
                                    <td>
                                        <p class="wow fadeInUp" data-wow-delay=".2s">
                                            : {{ $room->code }}
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="wow fadeInUp" data-wow-delay=".2s">
                                            Floor
                                        </p>
                                    </td>
                                    <td>
                                        <p class="wow fadeInUp" data-wow-delay=".2s">
                                            : {{ $room->floor }}
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="wow fadeInUp" data-wow-delay=".2s">
                                            Capacity
                                        </p>
                                    </td>
                                    <td>
                                        <p class="wow fadeInUp" data-wow-delay=".2s">
                                            : {{ $room->capacity }}
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="wow fadeInUp" data-wow-delay=".2s">
                                            Room type
                                        </p>
                                    </td>
                                    <td>
                                        <p class="wow fadeInUp" data-wow-delay=".2s">
                                            : {{ $room->type }}
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="wow fadeInUp" data-wow-delay=".2s">
                                            Description
                                        </p>
                                    </td>
                                    <td>
                                        <p class="wow fadeInUp" data-wow-delay=".2s">
                                            : {{ $room->description }}
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                <td><p class="wow fadeInUp" data-wow-delay=".2s">Items      </p></td>
                                <td>
                                <p class="wow fadeInUp" data-wow-delay=".2s">
                                        : {{ $room->items->pluck('name')->implode(', ') }}
                                    </p>
                                </td>
                            </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    @if ($room->img && Storage::exists('public/' . $room->img))
                        <div class="welcome-img">
                            <img style="width: 400px; border-radius: 50px 50px 50px 50px / 25px 25px 25px 25px;"
                                src="{{ asset('storage/' . $room->img) }}" alt="">
                        </div>
                    @else
                        @if ($room->img)
                            <div class="welcome-img">
                                <img style="width: 400px; border-radius: 50px 50px 50px 50px / 25px 25px 25px 25px;"
                                    src="{{ asset($room->img) }}" alt="">
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>

        <hr class="mt-75">
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h3 class="wow fadeInUp" data-wow-delay=".4s">Form Reservation Room {{ $room->name }}</h3>

                <form class="row g-3 mt-3 needs-validation wow fadeInUp" data-wow-delay=".4s" action="/daftarpinjam"
                    method="post">
                    @csrf
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="room_id" class="form-label d-block">Room code</label>
                            <select class="form-select " aria-label="Default select example" name="room_id" id="room_id"
                                required>
                                <option selected disabled>Choose room code</option>
                                @foreach ($rooms as $room)
                                    @if ($room->code == request()->segment(count(request()->segments())))
                                        <option value="{{ $room->id }}" selected> {{ $room->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="purpose" class="form-label">Purpose</label>
                            <input type="text" class="form-control  @error('capacity') is-invalid @enderror"
                                id="purpose" name="purpose" value="{{ old('purpose') }}" autocomplete="off" required>
                            @error('purpose')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="time_start" class="form-label">Start time</label>
                            <input type="datetime-local" class="form-control" id="time_start_use" name="time_start_use"
                                value="{{ old('time_start_use') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="time_end" class="form-label">End time</label>
                            <input type="datetime-local" class="form-control" id="time_end_use" name="time_end_use"
                                value="{{ old('time_end_use') }}" required>
                        </div>
                    </div>
                    <div class="row mt-3">
        <div class="col-md-12">
            <label for="items" class="form-label">Select Items</label>
            <div class="form-check">
                @foreach ($rooms as $room)
                    @foreach ($room->items as $item)
                        @if ($item->available)
                            <input class="form-check-input" type="checkbox" name="items[]" value="{{ $item->id }}" id="item{{ $item->id }}">
                            <label class="form-check-label" for="item{{ $item->id }}">
                                {{ $item->name }}
                            </label><br>
                        @endif
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
                    <div class="col-12">
                        <button class="btn btn-warning rounded-pill btn-hover fw-semibold text-white" type="submit">Booking Room</button>

                    </div>
                </form>

            </div>
        </div>

        <hr class="mt-75">
        <h3 class="mb-15 wow fadeInUp text-center" data-wow-delay=".4s">Booking List</h3>
        <!-- Table -->
        <div class="card-body text-end me-3 wow fadeInUp text-center" data-wow-delay=".4s">
            <div class="table-responsive justify-content-center">
                <div class="d-flex justify-content-start">
                    {{ $rents->links() }}
                </div>
                <table class="fl-table">
                    <thead>
                        <tr>
                            <th scope="row">No.</th>
                            <th scope="row">Name</th>
                            <th scope="row">Start time</th>
                            <th scope="row">End time</th>
                            <th scope="row">Purpose</th>
                            <th scope="row">Duration</th>
                            <th scope="row">Status</th>
                        </tr>
                    </thead>
                    <tbody class="rent-details">

                        @if ($rents->count() > 0)
                            @foreach ($rents as $rent)
                                <tr class="rent-detail">
                                    <th scope="row">{{ $loop->iteration }}</th scope="row">
                                    <td>{{ $rent->user->name }}</td>
                                    <td class="detail-rent-room_start-time">{{ $rent->time_start_use }}</td>
                                    <td>{{ $rent->time_end_use }}</td>
                                    <td>{{ $rent->purpose }}</td>
                                    <td>{{ $rent->transaction_start }}</td>
                                    <td>{{ $rent->status }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="text-center">
                                    -- No one has booked yet --
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </section>

@endsection
