@extends('layouts.main')

@section('title','Lead Status')

@section('content')
    <div class="content">
        <div class="container-fluid d-flex bg-info">
        <h1 class="text-dark mt-2 mx-4 mr-auto">Lead Status</h1>
        <button class="btn btn-primary mt-3 my-auto" data-remote="{{ route('lead-statuses.create') }}" data-request="ajaxModal" data-toggle="modal" data-reload="true">
            <span class="btn-label">
                <i class="fa fa-plus"></i>
            </span>
            Add Lead Status
        </button>
        </div>

        <!--datatable -->
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <h3 class="card-header bg-dark card-dark">
                            Lead Status
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
                                                    <th>Lead Status</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($leadStatuses as $leadStatus)

                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $leadStatus->lead_status_name }}</td>
                                                        <td>
                                                            @if($leadStatus->status == '1')
                                                                <span class="badge rounded-pill bg-info text-dark">Active</span>
                                                            @else
                                                                <span class="badge rounded-pill bg-warning text-dark">InActive</span>
                                                            @endif
                                                        </td>
                                                        <td>

                                                            <button type="button" data-remote="{{ route('lead-statuses.edit', $leadStatus->id) }}" data-request="ajaxModal" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Lead Status" data-reload="true"><i class="fas fa-pen"></i></button>

                                                            <a href="javascript:void(0)" class="btn btn-sm btn-danger delete-data" data-url="{{ route('lead-statuses.destroy',$leadStatus->id) }}" id="{{ $leadStatus->id }}" title="Delete Lead Status"><i class="fas fa-trash"></i></a>

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
