@extends('layouts.main')

@section('title','Lead Source')

@section('content')
    <div class="content">
        <!--datatable -->
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-dark card-dark d-flex justify-content-between">
                            <h3 class="align-self-center m-0">
                                Lead Sources
                            </h3>
                            <button class="btn btn-primary float-right" data-remote="{{ route('lead-sources.create') }}" data-request="ajaxModal" data-toggle="modal" data-reload="true">
                                <span class="btn-label">
                                    <i class="fa fa-plus"></i>
                                </span>
                                Add Lead Source
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
                                                    <th>Lead Source</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($leadSources as $leadSource)

                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $leadSource->lead_source_name }}</td>
                                                        <td>
                                                            @if($leadSource->status == '1')
                                                                <span class="badge rounded-pill bg-info text-dark">Active</span>
                                                            @else
                                                                <span class="badge rounded-pill bg-warning text-dark">InActive</span>
                                                            @endif
                                                        </td>
                                                        <td>

                                                                <button type="button" data-remote="{{ route('lead-sources.edit', $leadSource->id) }}" data-request="ajaxModal" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Lead Source" data-reload="true"><i class="fas fa-pen"></i></button>

                                                                <a href="javascript:void(0)" class="btn btn-sm btn-danger delete-data" data-url="{{ route('lead-sources.destroy',$leadSource->id) }}" id="{{ $leadSource->id }}" title="Delete Lead Source"><i class="fas fa-trash"></i></a>

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
