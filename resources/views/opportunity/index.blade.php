@extends('layouts.main')

@section('title','Opportunity')

@section('content')
    <div class="content">
        <div class="container-fluid d-flex bg-info">
        <h1 class="text-dark mt-2 mx-4 mr-auto" data-reload="true">Opportunity</h1>
        <button class="btn btn-primary mt-3 my-auto" data-remote="{{ route('opportunities.create') }}" data-request="ajaxModal" data-toggle="modal" data-reload="true">
            <span class="btn-label">
                <i class="fa fa-plus"></i>
            </span>
            Add Opportunity
        </button>
        </div>
        <!--datatable -->
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <h3 class="card-header bg-dark card-dark">
                            Customers
                        </h3>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <table class="table table-bordered dataTable" id="opportunityTable">
                                                <thead>
                                                <tr>
                                                    <th>Sr No</th>
                                                    <th>Lead Title</th>
                                                    <th>Customer Name</th>
                                                    <th>Opportunity Name</th>
                                                    <th>Expected Value</th>
                                                    <th>Opportunity Stage</th>
                                                    <th>Status</th>
                                                    <th>Expected Close Date</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>

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
        $(document).ready(function() {
            if ($.fn.dataTable.isDataTable(".table")) {
                $('.table').DataTable().clear().destroy();
            }
            let table = $('#opportunityTable').DataTable({
                processing: true,
                serverSide: true,
                pagination: true,
                searchDelay: 500,
                ajax: {
                    url: "{{route('get-all-opportunities')}}",
                    type: 'GET'
                },
                columns: [
                    {
                        data: null, // No data source, we will generate this
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1; // Serial number
                        },
                        title: 'Sr No', // Column title for serial number
                        orderable: false // Disable sorting for this column
                    },
                    {data: 'lead.lead_title', name:'lead.lead_title'},
                    {data: 'lead.customer.name', name:'lead.customer.name'},
                    {data: 'opportunity_name', name:'opportunity_name'},
                    {data: 'expected_value', name:'expected_value'},
                    {data: 'opportunity_stage.opportunity_stage_name', name:'opportunity_stage.opportunity_stage_name'},
                    {data: 'status', name:'status'},
                    {data: 'expected_close_date', name:'expected_close_date'},
                    {
                        data: 'action',
                        title: 'action',
                        searchable: false,
                        orderable: false,
                    },
                ],
                "pageLength": 10,
                "lengthMenu": [10, 25, 50, 100],
                "order": [[1, 'asc']]
            });

        });
    </script>
@endpush
