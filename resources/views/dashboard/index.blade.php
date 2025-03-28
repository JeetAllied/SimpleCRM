@extends('layouts.main')
@section('title','Dashboard')
@section('content')
    <div class="content">
        <div class="container-fluid mt-5">
            <div class="row ">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-dark card-dark">
                            <h3 class="align-self-center m-0">
                                Lead Conversion Chart
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row d-flex justify-content-center">
                                <div class="col-md-8">

                                <canvas id="leadConversionChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header bg-dark card-dark">
                            <h3 class="align-self-center m-0">
                                Pipeline Chart
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row d-flex justify-content-center">
                                <div class="col-md-10">
                                    <canvas id="pipelineChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header bg-dark card-dark">
                            <h3 class="align-self-center m-0">
                                Activity Chart
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row d-flex justify-content-center">
                                <div class="col-md-10">
                                    <canvas id="activityChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header bg-dark card-dark">
                            <h3 class="align-self-center m-0">
                                Ticket Chart
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row d-flex justify-content-center">
                                <div class="col-md-10">
                                    <canvas id="ticketChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--<div class="col-md-3">
                    <canvas id="pipelineChart"></canvas>
                </div>
                <div class="col-md-3">
                    <canvas id="activityChart"></canvas>
                </div>
                <div class="col-md-3">
                    <canvas id="ticketChart"></canvas>
                </div>--}}
            </div>
            <div class="row mt-5">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-dark card-dark">
                            <h3 class="align-self-center m-0">
                                Marketing Campaign Chart
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row d-flex justify-content-center">
                                <div class="col-md-10">
                                    <canvas id="marketingChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            {{--<div class="row d-flex justify-content-center mt-5">
                <div class="col-md-3">
                    <canvas id="ticketChart"></canvas>
                </div>
            </div>--}}
        </div>
    </div>

    {{--<canvas id="pipelineChart"></canvas>
    <canvas id="activityChart"></canvas>
    <canvas id="marketingChart"></canvas>
    <canvas id="ticketChart"></canvas>--}}


@endsection
@push('js')
    <script>
        const leadConversionCtx = document.getElementById('leadConversionChart').getContext('2d');
        new Chart(leadConversionCtx, {
            type: 'bar',
            data: {
                labels: ['Leads', 'Opportunities'],
                datasets: [{
                    label: 'Conversion Rate',
                    data: [{{ $leadConversion['leads'] }}, {{ $leadConversion['opportunities'] }}],
                    backgroundColor: ['blue', 'green'],
                    borderWidth: 1
                }]
            },
            options: {
            responsive: true, // Chart adapts to screen size
                scales: {
                y: {
                    beginAtZero: true // Start Y-axis from 0
                }
            },
            plugins: {
                legend: {
                    position: 'bottom' // Moves legend to bottom
                }
            }
        }
        });

        const pipelineCtx = document.getElementById('pipelineChart').getContext('2d');
        new Chart(pipelineCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($pipelineData->keys()) !!},
                datasets: [{
                    data: {!! json_encode($pipelineData->values()) !!},
                    backgroundColor: ['red', 'yellow', 'blue', 'green']
                }]
            },
            options: {
            responsive: true,
                plugins: {
                legend: {
                    position: 'bottom' // Moves legend to bottom
                }
            }
        }
        });

        const activityCtx = document.getElementById('activityChart').getContext('2d');
        new Chart(activityCtx, {
            type: 'pie',
            data: {
                labels: {!! json_encode($activityData->keys()) !!},
                datasets: [{
                    data: {!! json_encode($activityData->values()) !!},
                    backgroundColor: ['purple', 'orange', 'cyan']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom' // Moves legend to bottom
                    }
                }
            }
        });

        const marketingCtx = document.getElementById('marketingChart').getContext('2d');
        new Chart(marketingCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($marketingData->keys()) !!},
                datasets: [{
                    label: 'Marketing Channel',
                    data: {!! json_encode($marketingData->values()) !!},
                    backgroundColor: ['pink', 'green', 'blue']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom' // Moves legend to bottom
                    }
                }
            }
        });

        const ticketCtx = document.getElementById('ticketChart').getContext('2d');
        new Chart(ticketCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($ticketStatus->keys()) !!},
                datasets: [{
                    data: {!! json_encode($ticketStatus->values()) !!},
                    backgroundColor: ['red', 'yellow', 'green']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom' // Moves legend to bottom
                    }
                }
            }
        });

    </script>
@endpush
