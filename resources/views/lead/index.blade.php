@extends('layouts.main')

@section('title','Lead')

@section('content')
    <div class="content">
        <!--datatable -->
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-dark card-dark d-flex justify-content-between">
                            <h3 class="align-self-center m-0">
                                Lead
                            </h3>
                            <button class="btn btn-primary float-right" data-remote="{{ route('leads.create') }}" data-request="ajaxModal" data-toggle="modal" data-reload="true">
                                <span class="btn-label">
                                    <i class="fa fa-plus"></i>
                                </span>
                                Add Lead
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <table class="table table-bordered dataTable" id="leadTable">
                                                <thead>
                                                <tr>
                                                    <th>Sr No</th>
                                                    <th>Lead Title</th>
                                                    <th>Customer Name</th>
                                                    <th>Lead Source</th>
                                                    <th>Lead Status</th>
                                                    <th>Status</th>
                                                    <th>Assigned To</th>
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
            let table = $('#leadTable').DataTable({
                processing: true,
                serverSide: true,
                pagination: true,
                searchDelay: 500,
                ajax: {
                    url: "{{route('get-all-leads')}}",
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
                    {data: 'lead_title', name:'lead_title'},
                    {data: 'customer.name', name:'customer.name'},
                    {data: 'lead_source.lead_source_name', name:'lead_source.lead_source_name'},
                    {data: 'lead_status.lead_status_name', name:'lead_status.lead_status_name'},
                    {data: 'status', name:'status'},
                    {data: 'user.name', name:'user.name'},
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

        function validateLead()
        {
            let leadTitle = document.getElementById("lead_title").value;
            let customer = document.getElementById("customer_id").value;
            let leadSource = document.getElementById("lead_source_id").value;
            let leadStatus = document.getElementById("lead_status_id").value;
            let assignedTo = document.getElementById("assigned_to").value;
            if(leadTitle == "" || leadTitle == null || leadTitle == undefined)
            {
                displayAlert("warning","Warning!","Please enter lead title.");
                return false;
            }
            if(customer == "-1" || customer == -1 || customer == "" || customer == null || customer == undefined)
            {
                displayAlert("warning","Warning!","Please select customer.");
                return false;
            }
            if(leadSource == "-1" || leadSource == -1 || leadSource == "" || leadSource == null || leadSource == undefined)
            {
                displayAlert("warning","Warning!","Please select lead source.");
                return false;
            }
            if(leadStatus == "-1" || leadStatus == -1 || leadStatus == "" || leadStatus == null || leadStatus == undefined)
            {
                displayAlert("warning","Warning!","Please select lead status.");
                return false;
            }
            if(assignedTo == "-1" || assignedTo == -1 || assignedTo == "" || assignedTo == null || assignedTo == undefined)
            {
                displayAlert("warning","Warning!","Please select user to assign.");
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
