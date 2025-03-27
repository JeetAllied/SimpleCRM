@extends('layouts.main')

@section('title','Opportunity')

@section('content')
    <div class="content">
        <!--datatable -->
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-dark card-dark d-flex justify-content-between">
                            <h3 class="align-self-center m-0">
                                Opportunity
                            </h3>
                            <button class="btn btn-primary float-right" data-remote="{{ route('opportunities.create') }}" data-request="ajaxModal" data-toggle="modal" data-reload="true">
                                <span class="btn-label">
                                    <i class="fa fa-plus"></i>
                                </span>
                                Add Opportunity
                            </button>
                        </div>
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

        function validateOpportunity()
        {
            let opportunityName = document.getElementById("opportunity_name").value;
            let lead = document.getElementById("lead_id").value;
            let expectedValue = document.getElementById("expected_value").value;
            let opportunityStage = document.getElementById("opportunity_stage_id").value;
            let expectedCloseDate = document.getElementById("expected_close_date").value;
            if(opportunityName == "" || opportunityName == null || opportunityName == undefined)
            {
                displayAlert("warning","Warning!","Please enter opportunity name.");
                return false;
            }
            if(lead == "-1" || lead == -1 || lead == "" || lead == null || lead == undefined)
            {
                displayAlert("warning","Warning!","Please select lead.");
                return false;
            }
            if(expectedValue == "" || expectedValue == null || expectedValue == undefined)
            {
                displayAlert("warning","Warning!","Please enter expected value.");
                return false;
            }
            if(opportunityStage == "-1" || opportunityStage == -1 || opportunityStage == "" || opportunityStage == null || opportunityStage == undefined)
            {
                displayAlert("warning","Warning!","Please select opportunity stage.");
                return false;
            }
            if(expectedCloseDate == "" || expectedCloseDate == null || expectedCloseDate == undefined)
            {
                displayAlert("warning","Warning!","Please select expected close date.");
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
