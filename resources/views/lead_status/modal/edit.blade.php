<form class="form-horizontal ng-pristine ng-valid ajaxFormSubmit" action="{{ route('lead-statuses.update',$leadStatus->id) }}" method="post">
    @csrf
    @method('PUT')
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Lead Source</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="lead_status_name" class="form-label">Lead Status <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="lead_status_name" name="lead_status_name" placeholder="Enter Lead Status" value="{{ isset($leadStatus) ? $leadStatus->lead_status_name : '' }}">
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
        </div>
    </div>


</form>
