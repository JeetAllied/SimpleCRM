@extends('layouts.main')

@section('title','Marketing Campaign')

@section('content')
    <div class="content">
            <!--datatable -->
            <div class="container-fluid mt-5">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-dark card-dark d-flex justify-content-between">
                                <h3 class="align-self-center m-0">
                                    Marketing Campaign
                                </h3>
                                <button class="btn btn-primary float-right" data-remote="{{ route('marketing-campaigns.create') }}" data-request="ajaxModal" data-toggle="modal" data-reload="true">
                                <span class="btn-label">
                                    <i class="fa fa-plus"></i>
                                </span>
                                    Add Marketing Campaign
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card mb-4">
                                            <div class="card-body">
                                                <table class="table table-bordered dataTable" id="marketingCampaignTable">
                                                    <thead>
                                                    <tr>
                                                        <th>Sr No</th>
                                                        <th>Name</th>
                                                        <th>Marketing Campaign Type</th>
                                                        <th>Start Date</th>
                                                        <th>End Date</th>
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
            let table = $('#marketingCampaignTable').DataTable({
                processing: true,
                serverSide: true,
                pagination: true,
                searchDelay: 500,
                ajax: {
                    url: "{{route('get-all-marketing-campaigns')}}",
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
                    {data: 'marketing_campaign_name', name:'marketing_campaign_name'},
                    {data: 'marketing_campaign_type.marketing_campaign_type_name', name:'marketing_campaign_name.marketing_campaign_type_name'},
                    {data: 'start_date', name:'start_date'},
                    {data: 'end_date', name:'end_date'},
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

        function validateMarketingCampaign()
        {
            let marketingCampaignName = document.getElementById("marketing_campaign_name").value;
            let marketingCampaignType = document.getElementById("marketing_campaign_type_id").value;
            let startDate = document.getElementById("start_date").value;
            let endDate = document.getElementById("end_date").value;
            if(marketingCampaignName == "" || marketingCampaignName == null || marketingCampaignName == undefined)
            {
                displayAlert("warning","Warning!","Please enter marketing campaign name.");
                return false;
            }
            if(marketingCampaignType == "-1" || marketingCampaignType == -1 || marketingCampaignType == "" || marketingCampaignType == null || marketingCampaignType == undefined)
            {
                displayAlert("warning","Warning!","Please select marketing campaign type.");
                return false;
            }
            if(startDate == "" || startDate == null || startDate == undefined)
            {
                displayAlert("warning","Warning!","Please select start date.");
                return false;
            }
            if(endDate == "" || endDate == null || endDate == undefined)
            {
                displayAlert("warning","Warning!","Please select end date.");
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
