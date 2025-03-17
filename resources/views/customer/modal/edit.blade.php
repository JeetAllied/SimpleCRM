<form class="form-horizontal ng-pristine ng-valid ajaxFormSubmit" action="{{ route('customers.update', $customer->id) }}" method="post">
    @csrf
    @method('PUT')
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Add Customer</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="customer_name" class="form-label">Customer Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Enter Customer Name" value="{{ isset($customer) ? $customer->name : '' }}">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter Customer Email" value="{{ isset($customer) ? $customer->email : '' }}">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Contact Number <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Contact Number" value="{{ isset($customer) ? $customer->phone : '' }}">
            </div>
            <div class="mb-3">
                <label for="company_name" class="form-label">Company Name</label>
                <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Enter Company Name" value="{{ isset($customer) && ($customer->company_name != "") ? $customer->company_name : '' }}">
            </div>
            <div class="mb-3">
                <label for="industry" class="form-label">Industry</label>
                <input type="text" class="form-control" id="industry" name="industry" placeholder="Enter Industry Name" value="{{ isset($customer) && ($customer->industry != "") ? $customer->industry : '' }}">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control" id="address" name="address" rows="5" placeholder="Enter Address">
                    {{isset($customer) && ($customer->address != "") ? $customer->address : ''}}
                </textarea>
            </div>
            <div class="mb-3">
                <label for="roles" class="form-label">Assigned To <span class="text-danger">*</span></label><br>
                <select name="assigned_to" class="form-control select2" id="assigned_to">
                    <option value="-1">Select User</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{($user->id == $customer->assigned_to) ? 'selected' : ''}}> {{ $user->name }} </option>
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
        $("#assigned_to").select2({ width: '100%', border:'0'});

    });
</script>

