<form class="form-horizontal ng-pristine ng-valid ajaxFormSubmit" action="{{ route('sales-pipeline-stages.update',$salesPipelineStage->id) }}" method="post">
    @csrf
    @method('PUT')
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Opportunity Stage</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="sales_pipeline_stage_name" class="form-label">Opportunity Stage <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="sales_pipeline_stage_name" name="sales_pipeline_stage_name" placeholder="Enter Sales Pipeline Stage" value="{{ isset($salesPipelineStage) ? $salesPipelineStage->sales_pipeline_stage_name : '' }}">
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
        </div>
    </div>
</form>
