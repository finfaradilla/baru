<div class="modal fade" id="addRoom" tabindex="-1" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabel">Form Tambah {{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="text-align: left;">
                <form action="/dashboard/rooms" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="room_id" id="room_id">
                    <div class="mb-3">
                        <label for="code" class="form-label">Kode Ruangan</label>
                        <input autocomplete="off" type="text"
                            class="form-control @error('code') is-invalid @enderror" id="code" name="code"
                            required value="{{ old('code') }}">
                        @error('code')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Ruangan</label>
                        <input autocomplete="off" type="text"
                            class="form-control  @error('name') is-invalid @enderror" id="name" name="name"
                            required value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
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
                            <input type="number" class="form-control @error('floor') is-invalid @enderror"
                                id="floor" name="floor" required value="{{ old('floor') }}">
                        </div>
                        <div class="col-6">
                            <label for="capacity" class="form-label">Kapasitas</label>
                            <input type="number" class="form-control @error('capacity') is-invalid @enderror"
                                id="capacity" name="capacity" required value="{{ old('capacity') }}">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Tipe Ruangan</label>
                        <select class="form-select" name="type" id="type" required value="{{ old('type') }}">
                            <option selected disabled>Pilih Tipe Ruangan</option>
                            <option value="Laboratorium">Laboratorium</option>
                            <option value="Ruang Kelas">Ruang Kelas</option>
                            <option value="Ruang Dosen">Ruang Dosen</option>
                            <option value="Ruang Umum">Ruang Umum</option>
                            <option value="Auditorium">Auditorium</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="description"
                            class="form-label  @error('description') is-invalid @enderror">deskripsi ruangan</label>
                        <textarea name="description" id="description" cols="30" rows="5" class="form-control" required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="items" class="form-label">Items</label>
                        <div id="items-container">
                            <div class="input-group mb-2">
                                <input type="text" class="form-control" name="items[]" placeholder="Item name">
                                <button class="btn btn-danger" type="button" onclick="removeItemField(this)">Remove</button>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="button" onclick="addItemField()">Add Item</button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function addItemField() {
    const container = document.getElementById('items-container');
    const div = document.createElement('div');
    div.classList.add('input-group', 'mb-2');
    div.innerHTML = `
        <input type="text" class="form-control" name="items[]" placeholder="Item name">
        <button class="btn btn-danger" type="button" onclick="removeItemField(this)">Remove</button>
    `;
    container.appendChild(div);
}

function removeItemField(button) {
    button.parentElement.remove();
}
</script>
