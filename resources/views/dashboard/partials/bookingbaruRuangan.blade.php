<!-- Modal -->
<div class="modal fade" id="bookingbaruRuangan" tabindex="-1" aria-labelledby="bookingbaruRuanganLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookingbaruRuanganLabel">Book a Room</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('dashboard.rents.store') }}" method="POST">
                    @csrf
                    <!-- Room selection -->
                    <div class="mb-3">
                        <label for="room_id" class="form-label">Room Code</label>
                        <select class="form-select" name="room_id" id="room_id" required>
                            <option selected disabled>Choose room code</option>
                            @foreach ($rooms as $room)
                            <option value="{{ $room->id }}">{{ $room->name }} ({{ $room->code }})</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Purpose -->
                    <div class="mb-3">
                        <label for="purpose" class="form-label">Purpose</label>
                        <input type="text" class="form-control @error('purpose') is-invalid @enderror" id="purpose" name="purpose" value="{{ old('purpose') }}" required>
                        @error('purpose')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Date and Time -->
                    <div class="row mb-3">
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

                    <!-- Duration -->
                    <div class="mb-3">
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

                    <!-- Number of Pax -->
                    <div class="mb-3">
                        <label for="number_of_pax" class="form-label">Number of Pax</label>
                        <input type="number" class="form-control @error('number_of_pax') is-invalid @enderror" id="number_of_pax" name="number_of_pax" value="{{ old('number_of_pax') }}" required>
                        @error('number_of_pax')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Additional Request -->
                    <div class="mb-3">
                        <label for="additional_request" class="form-label">Additional Request</label>
                        <textarea class="form-control @error('additional_request') is-invalid @enderror" id="additional_request" name="additional_request">{{ old('additional_request') }}</textarea>
                        @error('additional_request')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Items -->
                    <div class="mb-3">
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

                    <!-- Submit Button -->
                    <div class="text-end">
                        <button type="submit" class="btn btn-success">Book Room</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const dateInput = document.getElementById('time_start_date');
    const timeButtons = document.querySelectorAll('.time-button');
    const startTimeInput = document.getElementById('time_start_time');
    const roomSelect = document.getElementById('room_id');
    
    // Function to disable time slots for past times and based on existing bookings
    function disablePastTimesAndBookedSlots(selectedDate, roomId) {
        const today = new Date();
        const selectedDateObj = new Date(selectedDate);

        if (selectedDate && roomId) {
            fetch(`/get-bookings?date=${selectedDate}&room_id=${roomId}`)
                .then(response => response.json())
                .then(bookings => {
                    console.log(bookings); // Debug: Log the bookings data

                    // Enable all buttons initially
                    timeButtons.forEach(button => {
                        button.disabled = false;

                        const buttonTimeStr = button.getAttribute('data-time');
                        const buttonDateTime = new Date(`${selectedDate}T${buttonTimeStr}:00`);

                        // Disable if the button time is in the past for the current day
                        if (selectedDateObj.toDateString() === today.toDateString() && buttonDateTime < today) {
                            button.disabled = true;
                        }

                        // Disable buttons based on bookings
                        bookings.forEach(booking => {
                            const bookingStart = new Date(booking.time_start_use);
                            const bookingEnd = new Date(booking.time_end_use);

                            // Disable button if it falls within the booked time range
                            if (buttonDateTime >= bookingStart && buttonDateTime < bookingEnd) {
                                button.disabled = true;
                            }
                        });
                    });
                });
        }
    }

    // Event listener for date change
    dateInput.addEventListener('change', function() {
        const selectedDate = this.value;
        const roomId = roomSelect.value;
        disablePastTimesAndBookedSlots(selectedDate, roomId);
    });

    // Event listener for room selection change
    roomSelect.addEventListener('change', function() {
        const selectedDate = dateInput.value;
        const roomId = this.value;
        disablePastTimesAndBookedSlots(selectedDate, roomId);
    });

    // Event listener for time button selection
    timeButtons.forEach(button => {
        button.addEventListener('click', function() {
            timeButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            startTimeInput.value = this.getAttribute('data-time');
        });
    });
});

</script>