<div class="modal fade" id="editRoomModal-{{ $room->id }}" tabindex="-1" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabel">Edit Room</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="text-align: left;">
                <form action="/dashboard/rooms/{{ $room->code }}" method="post" enctype="multipart/form-data">
                    @method('put')  
                    @csrf
                    <input type="hidden" name="code" value="{{ $room->code }}"> <!-- Hidden room code -->
                    <input type="hidden" name="id" id="id" value="{{ $room->id }}">
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Room Name</label>
                        <input type="text" class="form-control" id="name" name="name" required value="{{ old('name', $room->name) }}">
                    </div>
                    <div class='mb-3'>
                        <label for='img' class='form-label'>Room Picture<span class="text-danger fst-italic fw-lighter" style="font-size: 12px">*Max 2 Mb</span></label>
                        <input class="form-control @error('img') is-invalid @enderror" type='file' id='img' name='img' />
                        @error('img')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3 row">
                        <div class="col-6">
                            <label for="floor" class="form-label">Floor</label>
                            <input type="number" class="form-control" id="floor" name="floor" required value="{{ old('floor', $room->floor) }}">
                        </div>
                        <div class="col-6">
                            <label for="capacity" class="form-label">Capacity</label>
                            <input type="number" class="form-control" id="capacity" name="capacity" required value="{{ old('capacity', $room->capacity) }}">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Room Type</label>
                        <select class="form-select" name="type" id="type" required>
                            <option disabled>Choose Room Type</option>
                            <option value="Training" {{ old('type', $room->type) === 'Training' ? 'selected' : '' }}>Training</option>
                            <option value="Meeting" {{ old('type', $room->type) === 'Meeting' ? 'selected' : '' }}>Meeting</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Room Description</label>
                        <textarea name="description" id="description" cols="30" rows="5" class="form-control" required>{{ old('description', $room->description) }}</textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
