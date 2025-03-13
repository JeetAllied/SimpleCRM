<form class="form-horizontal ng-pristine ng-valid ajaxFormSubmit" action="{{ route('ticket-statuses.update',$ticketStatus->id) }}" method="post">
    @csrf
    @method('PUT')
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Ticket Status</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="ticket_status_name" class="form-label">Ticket Status <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="ticket_status_name" name="ticket_status_name" placeholder="Enter Ticket Status" value="{{ isset($ticketStatus) ? $ticketStatus->ticket_status_name : '' }}">
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
        </div>
    </div>
</form>
