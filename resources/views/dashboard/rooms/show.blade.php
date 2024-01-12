@extends('dashboard.layouts.main')

@section('container')
    <!-- Main Content -->
    {{-- @dd(request()->segment(count(request()->segments()))) --}}
    {{-- @dd(count(request()->segments())) --}}
    <div class="container blog-area pt-170 pb-140">

        <div>
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-6">
                    <div class="welcome-content">
                        <div class="content">
                            <table>
                                <tr>
                                    <td>
                                        <p class="wow fadeInUp" data-wow-delay=".4s">
                                            Gedung
                                        </p>
                                    </td>
                                    <td>
                                        <p class="wow fadeInUp" data-wow-delay=".4s">
                                            : {{ $room->building->name }}
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="wow fadeInUp" data-wow-delay=".4s">
                                            Lantai
                                        </p>
                                    </td>
                                    <td>
                                        <p class="wow fadeInUp" data-wow-delay=".4s">
                                            : {{ $room->floor }}
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="wow fadeInUp" data-wow-delay=".4s">
                                            Kapasitas
                                        </p>
                                    </td>
                                    <td>
                                        <p class="wow fadeInUp" data-wow-delay=".4s">
                                            : {{ $room->capacity }}
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="wow fadeInUp" data-wow-delay=".4s">
                                            Tipe Ruangan
                                        </p>
                                    </td>
                                    <td>
                                        <p class="wow fadeInUp" data-wow-delay=".4s">
                                            : {{ $room->type }}
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="wow fadeInUp" data-wow-delay=".4s">
                                            Deskripsi
                                        </p>
                                    </td>
                                    <td>
                                        <p class="wow fadeInUp" data-wow-delay=".4s">
                                            : {{ $room->description }}
                                        </p>
                                    </td>
                                </tr>
                            </table>
                            <button type="button" class="btn btn-primary read-more-btn wow fadeInUp mt-20"
                                data-bs-toggle="modal" data-bs-target="#pinjamRuangan" data-wow-delay=".5s">Pinjam <i
                                    class="lni lni-arrow-right"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    {{-- <div class="welcome-img">
                        <img style="width: 400px" src="{{ asset($room->img) }}" alt="">
                    </div> --}}

                    @if ($room->img && Storage::exists('public/' . $room->img))
                        <div class="welcome-img">
                            <img style="width: 400px" src="{{ asset('storage/' . $room->img) }}" alt="">
                        </div>
                    @else
                        @if ($room->img)
                            <div class="welcome-img">
                                <img style="width: 400px" src="{{ asset($room->img) }}" alt="">
                            </div>
                        @endif
                    @endif


                </div>
            </div>
        </div>


        <h2 class="content-title text-center" style="margin-top: 20px;">Daftar Peminjaman </h2>
        <!-- tambahkan content disini! -->
        <div class="card-body text-end me-3">
            <div class="table-responsive">
                <table class="table table-hover table-stripped table-bordered text-center dt-head-center" id="datatable">
                    <thead class="table-info">
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
                                    -- Belum Ada Daftar Peminjaman --
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @extends('dashboard.partials.rentModal')
@endsection
