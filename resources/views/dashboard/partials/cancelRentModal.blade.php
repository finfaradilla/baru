<!-- cancelRentModal.blade.php -->
<div class="modal fade" id="cancelRentModal-{{ $rent->id }}" tabindex="-1" aria-labelledby="cancelRentModalLabel-{{ $rent->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelRentModalLabel-{{ $rent->id }}">Cancel Reservation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/dashboard/rents/{{ $rent->id }}/cancel" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="rejection_reason" class="form-label text-start d-block">Reason for Cancellation</label>
                        <textarea class="form-control" id="rejection_reason" name="rejection_reason" rows="3" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Cancel Reservation</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
