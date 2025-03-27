<form class="form-horizontal ng-pristine ng-valid" action="{{ route('opportunities.update',$opportunity->id) }}" method="post" onsubmit="return validateOpportunity()">
    @csrf
    @method('PUT')
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Opportunity</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="opportunity_name" class="form-label">Opportunity Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="opportunity_name" name="opportunity_name" placeholder="Enter Opportunity Name" value="{{isset($opportunity) && ($opportunity->opportunity_name != '') ? $opportunity->opportunity_name : ''}}">
            </div>
            <div class="mb-3">
                <label for="lead_id" class="form-label">Lead Title <span class="text-danger">*</span></label><br>
                <select name="lead_id" class="form-control select2" id="lead_id">
                    <option value="-1">Select Lead</option>
                    @foreach($leads as $lead)
                        <option value="{{ $lead->id }}" {{($lead->id == $opportunity->lead_id) ? 'selected' : ''}}> {{ $lead->lead_title }} </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="expected_value" class="form-label">Expected Value <span class="text-danger">*</span></label>
                <input type="number" min="0" class="form-control" id="expected_value" name="expected_value" placeholder="Enter expected Value" value="{{isset($opportunity) && ($opportunity->expected_value != '') ? $opportunity->expected_value : ''}}">
            </div>
            <div class="mb-3">
                <label for="opportunity_stage_id" class="form-label">Opportunity Stage <span class="text-danger">*</span></label><br>
                <select name="opportunity_stage_id" class="form-control select2" id="opportunity_stage_id">
                    <option value="-1">Select Opportunity Stage</option>
                    @foreach($opportunityStages as $opportunityStage)
                        <option value="{{ $opportunityStage->id }}" {{($opportunityStage->id == $opportunity->opportunity_stage_id) ? 'selected' : ''}}> {{ $opportunityStage->opportunity_stage_name }} </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="expected_close_date" class="form-label">Expected Close Date <span class="text-danger">*</span></label><br>
                <input type="text" class="form-control" id="expected_close_date" name="expected_close_date" placeholder="Select Expected Close Date" value="{{isset($opportunity) && ($opportunity->expected_close_date != '') ? $opportunity->expected_close_date : ''}}">
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
        var now = moment();
        $("#lead_id,#opportunity_stage_id").select2({ width: '100%', border:'0'});
        $("#expected_close_date").daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            timePicker:true,
            startDate: now,
            locale: {
                format: 'YYYY-MM-DD hh:mm:ss'
            }
        });
    });
</script>


