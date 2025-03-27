<form class="form-horizontal ng-pristine ng-valid" action="{{ route('users.update',$user->id) }}" method="post" onsubmit="return validateUser()">
    @csrf
    @method('PUT')
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Role</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="user_name" class="form-label">User Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Enter User Name" value="{{ isset($user) ? $user->name : '' }}">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter User Email" value="{{ $user->email }}">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password only if you want to change">
            </div>
            <div class="mb-3">
                <label for="roles" class="form-label">Role <span class="text-danger">*</span></label><br>
                <select name="roles[]" class="form-control select2" id="role">
                    @foreach($roles as $role)
                        <option value="{{ $role }}" {{ in_array($role, $userRole) ? 'selected' : '' }}> {{ $role }} </option>
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
