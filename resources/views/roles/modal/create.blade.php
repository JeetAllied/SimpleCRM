<form class="form-horizontal ng-pristine ng-valid ajaxFormSubmit" action="{{ route('roles.store') }}" method="post">
    @csrf
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Add Role</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="role_name" class="form-label">Role Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="role_name" name="role_name" placeholder="Enter Role Name">
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
        </div>
    </div>
</form>


