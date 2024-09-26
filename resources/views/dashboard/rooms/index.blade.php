@extends('dashboard.layouts.main')

@section('container')
<div class="col-md-10 p-0">
    <div class="card-body text-end">
        @if (session()->has('roomSuccess'))
            <div class="col-md-16 mx-auto alert alert-success text-center alert-dismissible fade show" style="margin-top: 50px" role="alert">
                {{ session('roomSuccess') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session()->has('deleteRoom'))
            <div class="col-md-16 mx-auto alert alert-success text-center alert-dismissible fade show" style="margin-top: 50px" role="alert">
                {{ session('deleteRoom') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (auth()->user()->role_id === 1)
            <button type="button" class="mb-3 btn button btn-success" data-bs-toggle="modal" data-bs-target="#addRoom">
                Add Room
            </button>
        @endif
        <div class="table-responsive">
            <table class="table table-hover table-stripped table-bordered text-center dt-head-center">
                <thead class="table-success">
                    <tr>
                        <th class="text-center" scope="row">No.</th>
                        <th class="text-center" scope="row">Room Name</th>
                        <th class="text-center" scope="row">Capacity</th>
                        <th class="text-center" scope="row">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($rooms->count() > 0)
                        @foreach ($rooms as $room)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $room->name }}</td>
                                <td>{{ $room->capacity }} chair</td>
                                @if (auth()->user()->role_id === 1)
                                    <td style="font-size: 22px;">
                                        <a href="#" class="bi bi-pencil-square text-warning border-0 editroom" data-bs-toggle="modal" data-bs-target="#editRoomModal-{{ $room->id }}"></a>
                                        &nbsp;
                                        <form action="/dashboard/rooms/{{ $room->code }}" method="post" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="bi bi-trash-fill text-danger border-0" onclick="return confirm('Delete room?')"></button>
                                        </form>
                                    </td>
                                @endif
                            </tr>

                            <!-- Include Edit Modal for this room -->
                            @include('dashboard.partials.editRoomModal', ['room' => $room])

                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" class="text-center">
                                -- No room yet --
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end">
            {{ $rooms->links() }}
        </div>
    </div>
</div>
@extends('dashboard.partials.rentModal')
@extends('dashboard.partials.addRoomModal')
@endsection
