<form class="form-horizontal ng-pristine ng-valid" action="{{ route('activity-types.update',$activityType->id) }}" method="post" onsubmit="return validateActivityType()">
    @csrf
    @method('PUT')
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Activity Type</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="activity_type_name" class="form-label">Activity Type Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="activity_type_name" name="activity_type_name" placeholder="Enter Activity Type Name" value="{{ isset($activityType) ? $activityType->activity_type_name : '' }}">
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
        </div>
    </div>


</form>
