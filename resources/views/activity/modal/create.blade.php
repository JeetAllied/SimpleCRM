<form class="form-horizontal ng-pristine ng-valid ajaxFormSubmit" action="{{ route('activities.store') }}" method="post">
    @csrf
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Add Activity</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="activity_name" class="form-label">Activity Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="activity_name" name="activity_name" placeholder="Enter Activity Name">
            </div>
            <div class="mb-3">
                <label for="user_id" class="form-label">Assign User <span class="text-danger">*</span></label><br>
                <select name="user_id" class="form-control select2" id="user_id">
                    <option value="-1">Select User</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}"> {{ $user->name }} </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="activity_type_id" class="form-label">Activity Type <span class="text-danger">*</span></label><br>
                <select name="activity_type_id" class="form-control select2" id="activity_type_id">
                    <option value="-1">Select Activity Type</option>
                    @foreach($activityTypes as $activityType)
                        <option value="{{ $activityType->id }}"> {{ $activityType->activity_type_name }} </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="activity_detail" class="form-label">Activity Detail <span class="text-danger">*</span></label>
                <textarea class="form-control" id="activity_detail" name="activity_detail" rows="5" placeholder="Enter Activity Detail"></textarea>
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
        $("#user_id,#activity_type_id").select2({ width: '100%', border:'0'});
    });
</script>


