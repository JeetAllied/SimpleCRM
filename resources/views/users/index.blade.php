@extends('layouts.main')

@section('title','Users')

@section('content')
    <div class="content">
        <div class="container-fluid d-flex bg-info">
            <h1 class="text-dark mt-2 mx-4 mr-auto">Users</h1>
            <button class="btn btn-primary mt-3 my-auto" data-remote="{{ route('users.create') }}" data-request="ajaxModal" data-toggle="modal" data-reload="true">
            <span class="btn-label">
                <i class="fa fa-plus"></i>
            </span>
                Add User
            </button>
        </div>
        <!--datatable -->
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <h3 class="card-header bg-dark card-dark">
                            Users
                        </h3>
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

