@extends('dashboard.layouts.main')

@section('container')
<div class="col-md-10 p-0">
    <div class="card-body text-end">
        @if (session()->has('itemSuccess'))
            <div class="col-md-16 mx-auto alert alert-success text-center alert-success alert-dismissible fade show">
                {{ session('itemSuccess') }}
            </div>
        @endif
        @if (session()->has('deleteItem'))
            <div class="col-md-16 mx-auto alert alert-success text-center alert-success alert-dismissible fade show">
                {{ session('deleteItem') }}
            </div>
        @endif

        <button type="button" class="mb-3 btn btn-success" data-bs-toggle="modal" data-bs-target="#addItemModal">
            Add Item
        </button>

        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered text-center">
                <thead class="table-success">
                    <tr>
                        <th>No.</th>
                        <th>Item Name</th>
                        <th>Available</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->available ? 'Yes' : 'No' }}</td>
                            <td>
                                @if (auth()->user()->role_id === 1)
                                    <a href="#" class="bi bi-pencil-square text-warning border-0" data-bs-toggle="modal" data-bs-target="#editItemModal-{{ $item->id }}"></a>
                                    <form action="/dashboard/items/{{ $item->id }}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="bi bi-trash-fill text-danger border-0" onclick="return confirm('Delete item?')"></button>
                                    </form>
                                @endif
                            </td>
                        </tr>

                        <!-- Include Edit Modal for this item -->
                        @include('dashboard.partials.editItemModal', ['item' => $item])

                    @empty
                        <tr>
                            <td colspan="4" class="text-center">
                                -- No Items Available --
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @include('dashboard.partials.addItemModal')
    </div>
</div>
@endsection
