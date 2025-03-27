<form class="form-horizontal ng-pristine ng-valid" action="{{ route('sales-pipelines.update',$salesPipeline->id) }}" method="post" onsubmit="return validateSalesPipeline()">
    @csrf
    @method('PUT')
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Sales Pipeline</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="title" class="form-label">Sales Pipeline Title <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Enter Sales Pipeline Title" value="{{isset($salesPipeline) && ($salesPipeline->title != "") ? $salesPipeline->title : ''}}">
            </div>
            <div class="mb-3">
                <label for="opportunity_id" class="form-label">Opportunity <span class="text-danger">*</span></label><br>
                <select name="opportunity_id" class="form-control select2" id="opportunity_id">
                    <option value="-1">Select Opportunity</option>
                    @foreach($opportunities as $opportunity)
                        <option value="{{ $opportunity->id }}" {{($opportunity->id == $salesPipeline->opportunity_id) ? 'selected' : ''}}> {{ $opportunity->opportunity_name }} </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="sales_pipeline_stage_id" class="form-label">Sales Pipeline Stage <span class="text-danger">*</span></label><br>
                <select name="sales_pipeline_stage_id" class="form-control select2" id="sales_pipeline_stage_id">
                    <option value="-1">Select Sales Pipeline Stage</option>
                    @foreach($salesPipelineStages as $salesPipelineStage)
                        <option value="{{ $salesPipelineStage->id }}" {{($salesPipelineStage->id == $salesPipeline->sales_pipeline_stage_id) ? 'selected' : ''}}> {{ $salesPipelineStage->sales_pipeline_stage_name }} </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="probability" class="form-label">Probability <span class="text-danger">*</span></label>
                <input type="number" min="0" class="form-control" id="probability" name="probability" placeholder="Enter Probability Value" value="{{isset($salesPipeline) && ($salesPipeline->probability != "") ? $salesPipeline->probability : ''}}">
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
        $("#opportunity_id,#sales_pipeline_stage_id").select2({ width: '100%', border:'0'});
    });
</script>


