@extends('layouts.main')

@section('title','Activity')

@section('content')
    <div class="content">
        <!--datatable -->
        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-dark card-dark d-flex justify-content-between">
                            <h3 class="align-self-center m-0">
                                Activity
                            </h3>
                            <button class="btn btn-primary mt-3 my-auto" data-remote="{{ route('activities.create') }}" data-request="ajaxModal" data-toggle="modal" data-reload="true">
                                <span class="btn-label">
                                    <i class="fa fa-plus"></i>
                                </span>
                                Add Activity
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <table class="table table-bordered dataTable" id="activityTable">
                                                <thead>
                                                <tr>
                                                    <th>Sr No</th>
                                                    <th>Activity Name</th>
                                                    <th>Assigned To</th>
                                                    <th>Activity Type</th>
                                                    <th>Activity Detail</th>
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
            let table = $('#activityTable').DataTable({
                processing: true,
                serverSide: true,
                pagination: true,
                searchDelay: 500,
                ajax: {
                    url: "{{route('get-all-activities')}}",
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
                    {data: 'activity_name', name:'activity_name'},
                    {data: 'user.name', name:'user.name'},
                    {data: 'activity_type.activity_type_name', name:'activity_type.activity_type_name'},
                    {data: 'activity_detail', name:'activity_detail'},
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
