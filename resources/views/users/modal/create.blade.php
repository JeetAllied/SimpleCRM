<form class="form-horizontal ng-pristine ng-valid ajaxFormSubmit" action="{{ route('users.store') }}" method="post">
    @csrf
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Add User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="user_name" class="form-label">User Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Enter User Name">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter User Email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
            </div>
            <div class="mb-3">
                <label for="roles" class="form-label">Role <span class="text-danger">*</span></label><br>
                <select name="roles[]" class="form-control select2" id="role">
                    <option value="-1">Select Role</option>
                    @foreach($roles as $role)
                        @if($role != config('globals.super_admin_role'))
                            <option value="{{ $role }}"> {{ $role }} </option>
                        @endif
                    @endforeach
                </select>
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
        $("#role").select2({ width: '100%', border:'0'});

    });
</script>

