<form class="form-horizontal ng-pristine ng-valid ajaxFormSubmit" action="{{ route('leads.update',$lead->id) }}" method="post">
    @csrf
    @method('PUT')
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Lead</h5>
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
                        <option value="{{ $customer->id }}" {{($customer->id == $lead->customer_id) ? 'selected' : ''}}> {{ $customer->name }} </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="lead_source_id" class="form-label">Lead Source <span class="text-danger">*</span></label><br>
                <select name="lead_source_id" class="form-control select2" id="lead_source_id">
                    <option value="-1">Select Lead Source</option>
                    @foreach($leadSources as $leadSource)
                        <option value="{{ $leadSource->id }}" {{($leadSource->id == $lead->lead_source_id) ? 'selected' : ''}}> {{ $leadSource->lead_source_name }} </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="lead_status_id" class="form-label">Lead Status <span class="text-danger">*</span></label><br>
                <select name="lead_status_id" class="form-control select2" id="lead_status_id">
                    <option value="-1">Select Lead Status</option>
                    @foreach($leadStatuses as $leadStatus)
                        <option value="{{ $leadStatus->id }}" {{($leadStatus->id == $lead->lead_status_id) ? 'selected' : ''}}> {{ $leadStatus->lead_status_name }} </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="assigned_to" class="form-label">Assigned To <span class="text-danger">*</span></label><br>
                <select name="assigned_to" class="form-control select2" id="assigned_to">
                    <option value="-1">Select User</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{($user->id == $lead->assigned_to) ? 'selected' : ''}}> {{ $user->name }} </option>
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
        $("#customer_id,#lead_source_id,#lead_status_id,#assigned_to").select2({ width: '100%', border:'0'});

    });
</script>


