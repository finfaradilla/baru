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
                                            Kode Ruangan
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
                                        <p class="wow fadeInUp" data-wow-delay=".2s">
                                            Gedung
                                        </p>
                                    </td>
                                    <td>
                                        <p class="wow fadeInUp" data-wow-delay=".2s">
                                            : {{ $room->building->name }}
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="wow fadeInUp" data-wow-delay=".2s">
                                            Lantai
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
                                            Kapasitas
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
                                            Tipe Ruangan
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
                                            Deskripsi
                                        </p>
                                    </td>
                                    <td>
                                        <p class="wow fadeInUp" data-wow-delay=".2s">
                                            : {{ $room->description }}
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
                <h3 class="wow fadeInUp" data-wow-delay=".4s">Form Pinjam Ruang {{ $room->name }}</h3>
                <p class="wow fadeInUp" data-wow-delay=".4s">Isi form secara lengkap untuk meminjam ruangan</p>

                <form class="row g-3 mt-3 needs-validation wow fadeInUp" data-wow-delay=".4s" action="/daftarpinjam"
                    method="post">
                    @csrf
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="room_id" class="form-label d-block">Kode Ruangan</label>
                            <select class="form-select " aria-label="Default select example" name="room_id" id="room_id"
                                required>
                                <option selected disabled>Pilih Kode Ruangan</option>
                                @foreach ($rooms as $room)
                                    @if ($room->code == request()->segment(count(request()->segments())))
                                        <option value="{{ $room->id }}" selected> {{ $room->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="purpose" class="form-label">Tujuan</label>
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
                            <label for="time_start" class="form-label">Mulai Pinjam</label>
                            <input type="datetime-local" class="form-control" id="time_start_use" name="time_start_use"
                                value="{{ old('time_start_use') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="time_end" class="form-label">Selesai Pinjam</label>
                            <input type="datetime-local" class="form-control" id="time_end_use" name="time_end_use"
                                value="{{ old('time_end_use') }}" required>
                        </div>
                    </div>

                    <div class="col-12">
                        <button class="btn btn-warning rounded-pill btn-hover fw-semibold text-white" type="submit">Pinjam
                            Ruang</button>

                    </div>
                </form>

            </div>
        </div>

        <hr class="mt-75">
        <h3 class="mb-15 wow fadeInUp text-center" data-wow-delay=".4s">Daftar Peminjaman</h3>
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
                            <th scope="row">Nama Peminjam</th>
                            <th scope="row">Mulai Pinjam</th>
                            <th scope="row">Selesai Pinjam</th>
                            <th scope="row">Tujuan</th>
                            <th scope="row">Waktu Transaksi</th>
                            <th scope="row">Status Pinjam</th>
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
                                    -- Belum Ada Peminjaman --
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </section>

@endsection
