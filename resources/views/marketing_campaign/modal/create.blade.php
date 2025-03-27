<form class="form-horizontal ng-pristine ng-valid" action="{{ route('marketing-campaigns.store') }}" method="post" onsubmit="return validateMarketingCampaign()">
    @csrf
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Add Marketing Campaign</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="marketing_campaign_name" class="form-label">Marketing Campaign Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="marketing_campaign_name" name="marketing_campaign_name" placeholder="Enter Marketing Campaign Name">
            </div>
            <div class="mb-3">
                <label for="marketing_campaign_type_id" class="form-label">Marketing Campaign Type <span class="text-danger">*</span></label><br>
                <select name="marketing_campaign_type_id" class="form-control select2" id="marketing_campaign_type_id">
                    <option value="-1">Select Marketing Campaign Type</option>
                    @foreach($marketingCampaignTypes as $marketingCampaignType)
                        <option value="{{ $marketingCampaignType->id }}"> {{ $marketingCampaignType->marketing_campaign_type_name }} </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="start_date" class="form-label">Start Date <span class="text-danger">*</span></label><br>
                <input type="text" class="form-control" id="start_date" name="start_date" placeholder="Select Start Date">
            </div>
            <div class="mb-3">
                <label for="end_date" class="form-label">End Date <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="end_date" name="end_date" placeholder="Select End Date">
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
        $("#marketing_campaign_type_id").select2({ width: '100%', border:'0'});
        $("#start_date,#end_date").daterangepicker({
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


