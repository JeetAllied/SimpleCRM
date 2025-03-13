<form class="form-horizontal ng-pristine ng-valid ajaxFormSubmit" action="{{ route('marketing-campaign-types.update',$marketingCampaignType->id) }}" method="post">
    @csrf
    @method('PUT')
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Marketing Campaign Type</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="marketing_campaign_type_name" class="form-label">Marketing Campaign Type <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="marketing_campaign_type_name" name="marketing_campaign_type_name" placeholder="Enter Marketing Campaign Type" value="{{ isset($marketingCampaignType) ? $marketingCampaignType->marketing_campaign_type_name : '' }}">
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
        </div>
    </div>


</form>
