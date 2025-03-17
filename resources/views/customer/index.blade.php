@extends('layouts.main')

@section('title','Customers')

@section('content')
    <div class="content">
        <div class="container-fluid d-flex bg-info">
        <h1 class="text-dark mt-2 mx-4 mr-auto" data-reload="true">Customers</h1>
        <button class="btn btn-primary mt-3 my-auto" data-remote="{{ route('customers.create') }}" data-request="ajaxModal" data-toggle="modal" data-reload="true">
            <span class="btn-label">
                <i class="fa fa-plus"></i>
            </span>
            Add Customer
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
                                            <table class="table table-bordered dataTable" id="customerTable">
                                                <thead>
                                                <tr>
                                                    <th>Sr No</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Contact Number</th>
                                                    <th>Company Name</th>
                                                    <th>Industry</th>
                                                    <th>Address</th>
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
            let table = $('#customerTable').DataTable({
                processing: true,
                serverSide: true,
                pagination: true,
                searchDelay: 500,
                ajax: {
                    url: "{{route('get-all-customers')}}",
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
                    {data: 'name', name:'name'},
                    {data: 'email', name:'email'},
                    {data: 'phone', name:'phone'},
                    {data: 'company_name', name:'company_name'},
                    {data: 'industry', name:'industry'},
                    {data: 'address', name:'address'},
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
    </script>
@endpush
