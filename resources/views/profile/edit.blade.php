@extends('layouts.main')
@section('title','Profile')
@section('content')
    <div class="content">
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-dark card-dark">
                            <h3 class="align-self-center m-0">
                                Update Profile
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form method="post" action="{{route('profile.update')}}" onsubmit="return validateProfile()">
                                        @csrf
                                        @method('PATCH')
                                        <div class="mb-3">
                                            <label for="user_name" class="form-label">Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('user_name') is-invalid @enderror" id="user_name" name="user_name" placeholder="Enter Name" value="{{$user->name}}">
                                            @error('user_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="email" name="email" value="{{$user->email}}" disabled>
                                        </div>

                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-primary"> Save</button>
                                            <a href="#" class="btn btn-warning">Cancel</a>
                                        </div>
                                    </form>
                                </div> <!-- /.col -->

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-dark card-dark">
                            <h3 class="align-self-center m-0">
                                Update Password
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form method="post" action="{{route('password.update')}}" onsubmit="return validatePassword()">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="current_password" class="form-label">Current Password <span class="text-danger">*</span></label>
                                            <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password" placeholder="Enter Current Password">
                                            @error('current_password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="new_password" class="form-label">New Password <span class="text-danger">*</span></label>
                                            <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" name="new_password" placeholder="Enter New Password">
                                            @error('new_password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="new_password_confirmation" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                            <input type="password" class="form-control @error('new_password_confirmation') is-invalid @enderror" id="new_password_confirmation" name="new_password_confirmation" placeholder="Enter Confirm Password">
                                            @error('new_password_confirmation')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-primary"> Save</button>
                                            <a href="#" class="btn btn-warning">Cancel</a>
                                        </div>
                                    </form>
                                </div> <!-- /.col -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@push('js')
    <script>
        function validatePassword()
        {
            let currentPassword = document.getElementById("current_password").value;
            let newPassword = document.getElementById("new_password").value;
            let confirmPassword = document.getElementById("new_password_confirmation").value;
            if(currentPassword == "" || currentPassword == null || currentPassword == undefined)
            {
                displayAlert("warning","Warning!","Please enter current password.");
                return false;
            }
            if(newPassword == "" || newPassword == null || newPassword == undefined)
            {
                displayAlert("warning","Warning!","Please enter new password.");
                return false;
            }
            if(confirmPassword == "" || confirmPassword == null || confirmPassword == undefined)
            {
                displayAlert("warning","Warning!","Please enter confirm password.");
                return false;
            }
            if(newPassword !== confirmPassword)
            {
                displayAlert("warning","Warning!","New password and confirm password must be same.");
                return false;
            }
            else
            {
                return true;
            }
        }

        function validateProfile()
        {
            let userName = document.getElementById("user_name").value;
            if(userName == "" || userName == null || userName == undefined)
            {
                displayAlert("warning","Warning!","Please enter user name.");
                return false;
            }
            else
            {
                return true;
            }
        }

    </script>
@endpush
