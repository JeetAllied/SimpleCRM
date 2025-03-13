@extends('layouts.main')

@section('title','Marketing Campaign Type')

@section('content')
    <div class="content">
        <div class="container-fluid d-flex bg-info">
            <h1 class="text-dark mt-2 mx-4 mr-auto">Marketing Campaign Type</h1>
            <button class="btn btn-primary mt-3 my-auto" data-remote="{{ route('marketing-campaign-types.create') }}" data-request="ajaxModal" data-toggle="modal" data-reload="true">
            <span class="btn-label">
                <i class="fa fa-plus"></i>
            </span>
                Add Marketing Campaign Type
            </button>
        </div>

        <!--datatable -->
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <h3 class="card-header bg-dark card-dark">
                            Marketing Campaign Type
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
                                                    <th>Marketing Campaign Type</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($marketingCampaignTypes as $marketingCampaignType)

                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $marketingCampaignType->marketing_campaign_type_name }}</td>
                                                        <td>
                                                            @if($marketingCampaignType->status == '1')
                                                                <span class="badge rounded-pill bg-info text-dark">Active</span>
                                                            @else
                                                                <span class="badge rounded-pill bg-warning text-dark">InActive</span>
                                                            @endif
                                                        </td>
                                                        <td>

                                                            <button type="button" data-remote="{{ route('marketing-campaign-types.edit', $marketingCampaignType->id) }}" data-request="ajaxModal" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Marketing Campaign Type" data-reload="true"><i class="fas fa-pen"></i></button>

                                                            <a href="javascript:void(0)" class="btn btn-sm btn-danger delete-data" data-url="{{ route('marketing-campaign-types.destroy',$marketingCampaignType->id) }}" id="{{ $marketingCampaignType->id }}" title="Delete Marketing Campaign Type"><i class="fas fa-trash"></i></a>

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
