@extends('layouts.main')

@section('title','Roles')

@section('content')
    <div class="content">
        <!--datatable -->
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-dark card-dark d-flex justify-content-between">
                            <h3 class="align-self-center m-0">
                                Roles
                            </h3>
                            <button class="btn btn-primary float-right" data-remote="{{ route('roles.create') }}" data-request="ajaxModal" data-toggle="modal" data-reload="true">
                                <span class="btn-label">
                                    <i class="fa fa-plus"></i>
                                </span>
                                Add Role
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
                                                    <th>Role</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($roles as $role)

                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ deSlugify($role->name) }}</td>
                                                        <td>

                                                            <button type="button" data-remote="{{ route('roles.edit', $role->id) }}" data-request="ajaxModal" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Role" data-reload="true"><i class="fas fa-pen"></i></button>

                                                            <a href="javascript:void(0)" class="btn btn-sm btn-danger delete-data" data-url="{{ route('roles.destroy',$role->id) }}" id="{{ $role->id }}" title="Delete Role"><i class="fas fa-trash"></i></a>

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
