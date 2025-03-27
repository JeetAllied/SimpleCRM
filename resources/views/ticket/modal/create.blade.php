<form class="form-horizontal ng-pristine ng-valid" action="{{ route('tickets.store') }}" method="post" onsubmit="return validateTicket()">
    @csrf
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Add Ticket</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

            <div class="mb-3">
                <label for="customer_id" class="form-label">Customer <span class="text-danger">*</span></label><br>
                <select name="customer_id" class="form-control select2" id="customer_id">
                    <option value="-1">Select Customer</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}"> {{ $customer->name }} </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="subject" class="form-label">Subject <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="subject" name="subject" placeholder="Enter Subject">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="5" placeholder="Enter Description"></textarea>
            </div>
            <div class="mb-3">
                <label for="ticket_status_id" class="form-label">Ticket Status Type <span class="text-danger">*</span></label><br>
                <select name="ticket_status_id" class="form-control select2" id="ticket_status_id">
                    <option value="-1">Select Ticket Status Type</option>
                    @foreach($ticketStatuses as $ticketStatus)
                        <option value="{{ $ticketStatus->id }}"> {{ $ticketStatus->ticket_status_name }} </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
        </div>
    </div>
</form>
<style>
    .select2-selection {
        border-color: #ebedf2 !important; /* example */
    }
</style>
<script>
    $(document).ready(function() {
        $("#customer_id,#ticket_status_id").select2({ width: '100%', border:'0'});
    });
</script>


