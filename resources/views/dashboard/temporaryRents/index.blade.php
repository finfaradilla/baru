@extends('dashboard.layouts.main')

@section('container')
    <div class="col-md-10 p-0">
        <div class="card-body text-end">
            <div class="table-responsive">
                <div class="d-flex justify-content-start">
                    {{ $rents->links() }}
                </div>
                <table class="table table-hover table-stripped table-bordered text-center dt-head-center" id="datatable">
                    <thead class="table-info">
                        <tr>
                            <th scope="row">No.</th>
                            <th scope="row">Nama Ruangan</th>
                            <th scope="row">Nama Peminjam</th>
                            <th scope="row">Mulai Pinjam</th>
                            <th scope="row">Selesai Pinjam</th>
                            <th scope="row">Tujuan</th>
                            <th scope="row">Mulai Transaksi</th>
                            <th scope="row">Status Pinjam</th>
                            <th scope="row">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if ($rents->count() > 0)
                            @foreach ($rents as $rent)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th scope="row">
                                    <td><a href="/dashboard/rooms/{{ $rent->room->code }}"
                                            class="text-decoration-none">{{ $rent->room->code }}</a></td>
                                    <td>{{ $rent->user->name }}</td>
                                    <td>{{ $rent->time_start_use }}</td>
                                    <td>{{ $rent->time_end_use }}</td>
                                    <td>{{ $rent->purpose }}</td>
                                    <td>{{ $rent->transaction_start }}</td>
                                    <td>{{ $rent->status }}</td>

                                    @if (auth()->user()->role_id === 1)
                                        <td>
                                            <a href="/dashboard/temporaryRents/{{ $rent->id }}/acceptRents"
                                                class="btn btn-success mb-2" style="padding: 2px 10px"><i
                                                    class="bi bi-check-lg"></i></a>
                                            <a href="/dashboard/temporaryRents/{{ $rent->id }}/declineRents"
                                                class="btn btn-danger mb-2" style="padding: 2px 10px"><i
                                                    class="bi bi-x-lg"></i></a>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="9" class="text-center">
                                    -- Belum Ada Daftar Peminjam --
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
