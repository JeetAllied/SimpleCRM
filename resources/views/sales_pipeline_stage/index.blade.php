@extends('layouts.main')

@section('title','Sales Pipeline Stage')

@section('content')
    <div class="content">
        <div class="container-fluid d-flex bg-info">
        <h1 class="text-dark mt-2 mx-4 mr-auto">Sales Pipeline Stage</h1>
        <button class="btn btn-primary mt-3 my-auto" data-remote="{{ route('sales-pipeline-stages.create') }}" data-request="ajaxModal" data-toggle="modal" data-reload="true">
            <span class="btn-label">
                <i class="fa fa-plus"></i>
            </span>
            Add Sales Pipeline Stage
        </button>
        </div>
        <!--datatable -->
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <h3 class="card-header bg-dark card-dark">
                            Sales Pipeline Stage
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
                                                    <th>Sales Pipeline Stage</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($salesPipelineStages as $salesPipelineStage)

                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $salesPipelineStage->sales_pipeline_stage_name }}</td>
                                                        <td>
                                                            @if($salesPipelineStage->status == '1')
                                                                <span class="badge rounded-pill bg-info text-dark">Active</span>
                                                            @else
                                                                <span class="badge rounded-pill bg-warning text-dark">InActive</span>
                                                            @endif
                                                        </td>
                                                        <td>

                                                            <button type="button" data-remote="{{ route('sales-pipeline-stages.edit', $salesPipelineStage->id) }}" data-request="ajaxModal" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Sales Pipeline Stage" data-reload="true"><i class="fas fa-pen"></i></button>

                                                            <a href="javascript:void(0)" class="btn btn-sm btn-danger delete-data" data-url="{{ route('sales-pipeline-stages.destroy',$salesPipelineStage->id) }}" id="{{ $salesPipelineStage->id }}" title="Delete Sales Pipeline Stage"><i class="fas fa-trash"></i></a>

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
