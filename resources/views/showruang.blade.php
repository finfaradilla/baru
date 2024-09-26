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
        <div class="container row align-items-center">
            <div class="col-xl-6 col-lg-6">
                <div class="welcome-content">
                    <div class="section-title">
                        <h3 class="mb-35 wow fadeInUp" data-wow-delay=".2s">{{ $room->name }}</h3>
                    </div>
                    <div class="content">
                        <table>
                            <tr>
                                <td>
                                    <p class="wow fadeInUp" data-wow-delay=".2s">Floor</p>
                                </td>
                                <td>
                                    <p class="wow fadeInUp" data-wow-delay=".2s">: {{ $room->floor }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="wow fadeInUp" data-wow-delay=".2s">Capacity</p>
                                </td>
                                <td>
                                    <p class="wow fadeInUp" data-wow-delay=".2s">: {{ $room->capacity }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="wow fadeInUp" data-wow-delay=".2s">Room type</p>
                                </td>
                                <td>
                                    <p class="wow fadeInUp" data-wow-delay=".2s">: {{ $room->type }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="wow fadeInUp" data-wow-delay=".2s">Description</p>
                                </td>
                                <td>
                                    <p class="wow fadeInUp" data-wow-delay=".2s">: {{ $room->description }}</p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6">
                @if ($room->img && Storage::exists('public/' . $room->img))
                <div class="welcome-img">
                    <img style="width: 400px; border-radius: 50px;" src="{{ asset('storage/' . $room->img) }}" alt="">
                </div>
                @elseif ($room->img)
                <div class="welcome-img">
                    <img style="width: 400px; border-radius: 50px;" src="{{ asset($room->img) }}" alt="">
                </div>
                @endif
            </div>
        </div>
    </div>

    <hr class="mt-75">
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h3 class="wow fadeInUp" data-wow-delay=".4s">Form Reservation Room {{ $room->name }}</h3>

            <form class="row g-3 mt-3 needs-validation wow fadeInUp" data-wow-delay=".4s" action="/daftarpinjam" method="post">
                @csrf
                <!-- Input fields -->
                <div class="row mt-3">
                    <div class="col-md-6" hidden>
                        <input type="hidden" name="room_id" id="room_id" value="{{ $room->id }}">
                        <label for="room_name" class="form-label d-block">Room Code</label>
                        <input type="text" class="form-control" id="room_name" value="{{ $room->name }}" readonly>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="time_start_date" class="form-label">Start Date</label>
                        <input type="date" class="form-control" id="time_start_date" name="time_start_date" value="{{ old('time_start_date') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="time_start_time" class="form-label">Start Time</label>
                        <div class="time-buttons" id="start-time-buttons">
                            @foreach (range(8, 16) as $hour)
                            @foreach ([0, 30] as $minute)
                            <button type="button" class="btn btn-outline-success time-button" data-time="{{ sprintf('%02d:%02d', $hour, $minute) }}">
                                {{ sprintf('%02d:%02d', $hour, $minute) }}
                            </button>
                            @endforeach
                            @if ($loop->iteration % 5 == 0)
                            <br>
                            @endif
                            @endforeach
                        </div>
                        <input type="hidden" id="time_start_time" name="time_start_time" value="{{ old('time_start_time') }}" required>
                    </div>
                </div>

                <!-- Add duration input -->
                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="duration" class="form-label">Duration</label>
                        <select class="form-select @error('duration') is-invalid @enderror" id="duration" name="duration" required>
                            <option value="30">30 minutes</option>
                            <option value="60">1 hour</option>
                            <option value="90">1 hour 30 minutes</option>
                            <option value="120">2 hours</option>
                            <option value="150">2 hours 30 minutes</option>
                            <option value="180">3 hours</option>
                            <option value="210">3 hours 30 minutes</option>
                            <option value="240">4 hours</option>
                            <option value="1440">Full day</option>
                        </select>
                        @error('duration')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="number_of_pax" class="form-label">Number of Pax</label>
                        <input type="number" class="form-control @error('number_of_pax') is-invalid @enderror" id="number_of_pax" name="number_of_pax" value="{{ old('number_of_pax') }}" required>
                        @error('number_of_pax')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="purpose" class="form-label">Purpose</label>
                        <input type="text" class="form-control @error('purpose') is-invalid @enderror" id="purpose" name="purpose" value="{{ old('purpose') }}" autocomplete="off" required>
                        @error('purpose')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Add additional request input -->
                <div class="row mt-3">
                    <div class="col-md-12">
                        <label for="additional_request" class="form-label">Additional Request</label>
                        <textarea class="form-control @error('additional_request') is-invalid @enderror" id="additional_request" name="additional_request">{{ old('additional_request') }}</textarea>
                        @error('additional_request')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <!-- Items selection -->
                <div class="row mt-3">
                    <div class="col-md-12">
                        <label for="items" class="form-label">Items</label>
                        @foreach ($items as $item)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="{{ $item->id }}" id="item{{ $item->id }}" name="items[]" {{ $item->available ? '' : 'disabled' }}>
                            <label class="form-check-label" for="item{{ $item->id }}">
                                {{ $item->name }} ({{ $item->available ? 'Available' : 'Not Available' }})
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Submit button -->
                <div class="col-12">
                    <button class="btn btn-success rounded-pill btn-hover fw-semibold text-white" type="submit">Booking Room</button>
                </div>
            </form>
        </div>
    </div>
</section>


<!-- Add the script at the end of the body -->
<!-- <script>
document.addEventListener('DOMContentLoaded', function() {
    const dateInput = document.getElementById('time_start_date');
    const timeButtons = document.querySelectorAll('.time-button');
    const startTimeInput = document.getElementById('time_start_time');
    const roomId = document.getElementById('room_id').value; // Get room_id from the form

    dateInput.addEventListener('change', function() {
        const selectedDate = this.value;
        fetch(`/get-bookings?date=${selectedDate}&room_id=${roomId}`) // Add room_id here
            .then(response => response.json())
            .then(bookings => {
                // Enable all buttons initially
                timeButtons.forEach(button => button.disabled = false);

                // Disable buttons based on bookings
                bookings.forEach(booking => {
                    const start = new Date(booking.time_start_use);
                    const end = new Date(booking.time_end_use);

                    timeButtons.forEach(button => {
                        const buttonTime = button.getAttribute('data-time');
                        const buttonDateTime = new Date(`${selectedDate}T${buttonTime}:00`);

                        if (buttonDateTime >= start && buttonDateTime < end) {
                            button.disabled = true;
                        }
                    });
                });
            });
    });

    timeButtons.forEach(button => {
        button.addEventListener('click', function() {
            timeButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            startTimeInput.value = this.getAttribute('data-time');
        });
    });
});
</script> -->
@endsection