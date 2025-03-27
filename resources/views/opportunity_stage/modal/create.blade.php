<form class="form-horizontal ng-pristine ng-valid" action="{{ route('opportunity-stages.store') }}" method="post" onsubmit="return validateOpportunityStage()">
    @csrf
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Add Opportunity Stage</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="opportunity_stage_name" class="form-label">Opportunity Stage Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="opportunity_stage_name" name="opportunity_stage_name" placeholder="Enter Opportunity Stage Name">
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
        </div>
    </div>
</form>


