@extends('layouts.main')

@section('title','Users')

@section('content')
    <div class="content">
        <!--datatable -->
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-dark card-dark d-flex justify-content-between">
                            <h3 class="align-self-center m-0">
                                Users
                            </h3>
                            <button class="btn btn-primary float-right" data-remote="{{ route('users.create') }}" data-request="ajaxModal" data-toggle="modal" data-reload="true">
                                <span class="btn-label">
                                    <i class="fa fa-plus"></i>
                                </span>
                                Add User
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <table class="table table-bordered dataTable">
                                                <thead>
                                                <tr>
                                                    <th>Sr No</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Status</th>
                                                    <th>Roles</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($users as $user)

                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>
                                                            @if($user->status == '1')
                                                                <span class="badge rounded-pill bg-info text-dark">Active</span>
                                                            @else
                                                                <span class="badge rounded-pill bg-warning text-dark">InActive</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @php
                                                                $role = '';
                                                                    if(!empty($user->getRoleNames())) {
                                                                        foreach($user->getRoleNames() as $roleName) {
                                                                            $role = $roleName;
                                                                        }
                                                                    }
                                                            @endphp

                                                            <span class="badge bg-primary text-white">{{ deSlugify($role) }}</span>

                                                        </td>
                                                        <td>

                                                            <button type="button" data-remote="{{ route('users.edit', $user->id) }}" data-request="ajaxModal" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit User" data-reload="true"><i class="fas fa-pen"></i></button>

                                                            <a href="javascript:void(0)" class="btn btn-sm btn-danger delete-data" data-url="{{ route('users.destroy',$user->id) }}" id="{{ $user->id }}" title="Delete User"><i class="fas fa-trash"></i></a>

                                                        </td>
                                                    </tr>

                                                @endforeach

                                                </tbody>
                                            </table>
                                        </div>   <!-- /.card-body -->
                                    </div> <!-- /.card -->
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
        function validateUser()
        {
            let userName = document.getElementById("user_name").value;
            let email = document.getElementById("email").value;
            let password = document.getElementById("password").value;
            let role = document.getElementById("role").value;
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if(userName == "" || userName == null || userName == undefined)
            {
                displayAlert("warning","Warning!","Please enter user name.");
                return false;
            }
            if(email == "" || email == null || email == undefined)
            {
                displayAlert("warning","Warning!","Please enter email.");
                return false;
            }
            if(email != "" && email != null && email != undefined && !emailPattern.test(email))
            {
                displayAlert("warning","Warning!","Please enter valid email.");
                return false;
            }
            if(password == "" || password == null || password == undefined)
            {
                displayAlert("warning","Warning!","Please enter password.");
                return false;
            }
            if(role == "-1" || role == -1 || role == "" || role == null || role == undefined)
            {
                displayAlert("warning","Warning!","Please select role.");
                return false;
            }

            else
            {
                $("form").addClass("ajaxFormSubmit");
                return true;
            }
        }


    </script>


@endpush
