<div class="modal fade" id="editRoom" tabindex="-1" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabel">Form Edit {{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="text-align: left;">
                <form action="/dashboard/rooms/{{ $room->code }}" method="post" enctype="multipart/form-data"
                    id="editform">
                    @method('put')
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="mb-3">
                        <label for="code" class="form-label">Kode Ruangan</label>
                        <input type="text" class="form-control  @error('code') is-invalid @enderror" id="code"
                            name="code" required value="{{ old('code', $room->code) }}">
                        @error('code')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Ruangan</label>
                        <input type="text" class="form-control" id="name" name="name" required
                            value="{{ old('name', $room->name) }}">
                    </div>
                    <div class='mb-3'>
                        <label for='img' class='form-label'>Foto Ruangan <span
                                class="text-danger fst-italic fw-lighter" style="font-size: 12px">
                                *Max 2 Mb</span></label>
                        <input class="form-control @error('img') is-invalid @enderror" type='file' id='img'
                            name='img' />
                        @error('img')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3 row">
                        <div class="col-6">
                            <label for="floor" class="form-label">Lantai</label>
                            <input type="number" class="form-control" id="floor" name="floor" required
                                value="{{ old('floor', $room->floor) }}">
                        </div>
                        <div class="col-6">
                            <label for="capacity" class="form-label">Kapasitas</label>
                            <input type="number" class="form-control" id="capacity" name="capacity" required
                                value="{{ old('capacity', $room->capacity) }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">Tipe Ruangan</label>
                        <select class="form-select" name="type" id="type" required>
                            <option disabled>Pilih Tipe Ruangan</option>
                            <option value="Laboratorium" {{ old('type') === 'Laboratorium' ? 'selected' : '' }}>
                                Laboratorium</option>
                            <option value="Ruang Kelas" {{ old('type') === 'Ruang Kelas' ? 'selected' : '' }}>Ruang
                                Kelas</option>
                            <option value="Ruang Dosen" {{ old('type') === 'Ruang Dosen' ? 'selected' : '' }}>Ruang
                                Dosen</option>
                            <option value="Ruang Umum" {{ old('type') === 'Ruang Umum' ? 'selected' : '' }}>Ruang Umum
                            </option>
                            <option value="Auditorium" {{ old('type') === 'Auditorium' ? 'selected' : '' }}>Auditorium
                            </option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi Ruangan</label>
                        <textarea name="description" id="description" cols="30" rows="5" class="form-control "
                            value="{{ old('description', $room->description) }}" required></textarea>
                    </div>
                    <a href="https://www.traveloka.com" class="btn btn-secondary">Add Item</a>
                    <div class="mb-3">
                        <label for="items" class="form-label">Items</label>
                        <div id="items-container">
                            @foreach (old('items', $room->items) as $index => $item)
                            <div class="item-group mb-2">
                                <input type="text" class="form-control mb-2 @error('items.' . $index . '.name') is-invalid @enderror" name="items[{{ $index }}][name]" placeholder="Item Name" value="{{ old('items.' . $index . '.name', $item->name) }}" required>
                                <button type="button" class="btn btn-danger remove-item">Remove</button>
                                @error('items.' . $index . '.name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-secondary mt-2" id="add-item">Add Item</button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="editbtn" name="editbtn">Simpan</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const itemsContainer = document.getElementById('items-container');
        const addItemButton = document.getElementById('add-item');

        addItemButton.addEventListener('click', function() {
            const index = itemsContainer.children.length;
            const itemGroup = document.createElement('div');
            itemGroup.classList.add('item-group', 'mb-2');
            itemGroup.innerHTML = `
                <input type="text" class="form-control mb-2" name="items[${index}][name]" placeholder="Item Name" required>
                <button type="button" class="btn btn-danger remove-item">Remove</button>
            `;
            itemsContainer.appendChild(itemGroup);
        });

        itemsContainer.addEventListener('click', function(event) {
            if (event.target.classList.contains('remove-item')) {
                event.target.closest('.item-group').remove();
            }
        });
    });
</script>