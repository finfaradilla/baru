@extends('dashboard.layouts.main')

@section('container')
    <div class="col-md-10 p-0">
        <div class="card-body text-end">
            @if (session()->has('userSuccess'))
                <div class="col-md-16 mx-auto alert alert-success text-center alert-success alert-dismissible fade show"
                    style="margin-top: 50px" role="alert">
                    {{ session('userSuccess') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session()->has('deleteUser'))
                <div class="col-md-16 mx-auto alert alert-success text-center alert-dismissible fade show"
                    style="margin-top: 50px" role="alert">
                    {{ session('deleteUser') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (auth()->user()->role_id === 1)
                <button type="button" class="mb-3 btn button btn-success" data-bs-toggle="modal" data-bs-target="#addUser">
                    Add User
                </button>
            @endif
            <div class="table-responsive">
                <div class="d-flex justify-content-start">
                    {{ $users->links() }}
                </div>

                <table class="table table-hover table-stripped table-bordered text-center">
                    <thead class="table-success">
                        <tr>
                            <th scope="row">No.</th>
                            <th scope="row">Username</th>
                            <th scope="row">Email</th>
                            <th scope="row">Role</th>
                            <th scope="row">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if ($users->count() > 0)
                            @foreach ($users as $user)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }} </th>
                                    <td>{{ $user->name }} </td>
                                    <td>{{ $user->email }} </td>
                                    <td>{{ $user->role->name }} </td>
                                    @if (auth()->user()->role_id === 1)
                                        <td style="font-size: 22px;">
                                             <a href="#" class="edituser"
                                                id="edituser" data-id="{{ $user->id }}" data-bs-toggle="modal"
                                                data-bs-target="#editUserModal-{{ $user->id }}"><i
                                                    class="bi bi-pencil-square text-warning"></i></a>&nbsp; 
                                            <a href="/dashboard/users/{{ $user->id }}/makeAdmin" class="makeadmin"
                                                id="makeadmin"><i class="bi bi-person-plus-fill"></i></a>&nbsp;
                                            <form action="/dashboard/users/{{ $user->id }}" method="post"
                                                class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="bi bi-trash-fill text-danger border-0"
                                                    onclick="return confirm('Delete user?')"></button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>

                                <!-- Include Edit Modal for each user -->
                                @include('dashboard.partials.editUserModal', ['user' => $user])

                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center">
                                    -- No users available --
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    @extends('dashboard.partials.addUserModal')
@endsection
