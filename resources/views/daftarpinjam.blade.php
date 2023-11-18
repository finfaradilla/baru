@extends('layouts.main')

@section('container')
    <section id="blog" class="blog-area pt-170 pb-140">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-7">
                    <div class="section-title">
                        <h2 class="wow fadeInUp" data-wow-delay=".2s">{{ $title }} </h2>
                        <p class="wow fadeInUp" data-wow-delay=".4s">Pemberitahuan dari admin akan muncul di daftar
                            peminjaman ini. Silahkan tunggu sampai dapat persetujuan dari admin.</p>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-md-10 p-0">
                    <div class="card-body text-end">
                        @if (session()->has('rentSuccess'))
                            <div class="col-md-16 mx-auto alert alert-success text-center  alert-success alert-dismissible fade show"
                                style="margin-top: 50px" role="alert">
                                {{ session('rentSuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
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
                                        <th scope="row">Kode Ruangan</th>
                                        <th scope="row">Nama Peminjam</th>
                                        <th scope="row">Mulai Pinjam</th>
                                        <th scope="row">Selesai Pinjam</th>
                                        <th scope="row">Tujuan</th>
                                        <th scope="row">Waktu Transaksi</th>
                                        <th scope="row">Kembalikan</th>
                                        <th scope="row">Status Pinjam</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($userRents->count() > 0)
                                        @foreach ($userRents as $rent)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th scope="row">
                                                <td><a href="/showruang/{{ $rent->room->code }}"
                                                        class="text-decoration-none"
                                                        role="button">{{ $rent->room->code }}</a>
                                                </td>
                                                @if (auth()->user()->role_id <= 2)
                                                    <td>{{ $rent->user->name }}</td>
                                                @endif
                                                <td>{{ $rent->time_start_use }}</td>
                                                <td>{{ $rent->time_end_use }}</td>
                                                <td>{{ $rent->purpose }}</td>
                                                <td>{{ $rent->transaction_start }}</td>
                                                @if ($rent->status == 'dipinjam')
                                                    <td><a href="/daftarpinjam{{ $rent->id }}/endTransaction"
                                                            class="btn btn-success" type="submit"
                                                            style="padding: 2px 10px">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" fill="currentColor" class="bi bi-check-lg"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z" />
                                                            </svg>
                                                        </a>
                                                    </td>
                                                @else
                                                    @if (!is_null($rent->transaction_end))
                                                        <td>{{ $rent->transaction_end }}</td>
                                                    @else
                                                        <td>-</td>
                                                    @endif
                                                @endif
                                                <td>{{ $rent->status }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="8" class="text-center">
                                                -- Belum Ada Peminjaman --
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
