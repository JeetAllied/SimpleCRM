@extends('layouts.main')

@section('title','Ticket')

@section('content')
    <div class="content">
        <!--datatable -->
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-dark card-dark d-flex justify-content-between">
                            <h3 class="align-self-center m-0">
                                Ticket
                            </h3>
                            <button class="btn btn-primary float-right" data-remote="{{ route('tickets.create') }}" data-request="ajaxModal" data-toggle="modal" data-reload="true">
                                <span class="btn-label">
                                    <i class="fa fa-plus"></i>
                                </span>
                                Add Ticket
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <table class="table table-bordered dataTable" id="ticketTable">
                                                <thead>
                                                <tr>
                                                    <th>Sr No</th>
                                                    <th>Customer Name</th>
                                                    <th>Subject</th>
                                                    <th>Description</th>
                                                    <th>Ticket Status Type</th>
                                                    <th>Status</th>
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
            let table = $('#ticketTable').DataTable({
                processing: true,
                serverSide: true,
                pagination: true,
                searchDelay: 500,
                ajax: {
                    url: "{{route('get-all-tickets')}}",
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
                    {data: 'customer.name', name:'customer.name'},
                    {data: 'subject', name:'subject'},
                    {data: 'description', name:'description'},
                    {data: 'ticket_status.ticket_status_name', name:'ticket_status.ticket_status_name'},
                    {data: 'status', name:'status'},
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

        function validateTicket()
        {
            let customer = document.getElementById("customer_id").value;
            let subject = document.getElementById("subject").value;
            let description = document.getElementById("description").value;
            let ticketStatus = document.getElementById("ticket_status_id").value;


            if(customer == "-1" || customer == -1 || customer == "" || customer == null || customer == undefined)
            {
                displayAlert("warning","Warning!","Please select customer.");
                return false;
            }
            if(subject == "" || subject == null || subject == undefined)
            {
                displayAlert("warning","Warning!","Please enter subject.");
                return false;
            }
            if(description == "" || description == null || description == undefined)
            {
                displayAlert("warning","Warning!","Please enter description.");
                return false;
            }
            if(ticketStatus == "-1" || ticketStatus == -1 || ticketStatus == "" || ticketStatus == null || ticketStatus == undefined)
            {
                displayAlert("warning","Warning!","Please select ticket status.");
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
