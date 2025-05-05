@extends('layouts.admin')

@section('content')
    <style>
        .card {
            border: none;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .chart-container {
            position: relative;
            min-height: 250px;
        }
    </style>

    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Revenue Analytics</h5>
            {{-- <div class="dropdown">
                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="analyticsPeriod"
                    data-bs-toggle="dropdown">
                    Last 30 Days
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item period-selector" href="#" data-days="7">Last 7 Days</a></li>
                    <li><a class="dropdown-item period-selector" href="#" data-days="30">Last 30 Days</a></li>
                    <li><a class="dropdown-item period-selector" href="#" data-days="90">Last 90 Days</a></li>
                </ul>
            </div> --}}
        </div>
        <div class="card-body">
            <div class="chart-container">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Initialize chart variable
        let revenueChart = null;

        // Load chart function with error handling
        async function loadRevenueChart(days = 30) {
            try {
                const response = await fetch(`/analytics/revenue?days=${days}`);

                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                const data = await response.json();
                const ctx = document.getElementById('revenueChart');

                // Format data
                const labels = data.map(item => {
                    const date = new Date(item.date);
                    return date.toLocaleDateString('en-US', {
                        month: 'short',
                        day: 'numeric'
                    });
                });

                const chartData = data.map(item => parseFloat(item.total));

                // Destroy previous chart if exists
                if (revenueChart) {
                    revenueChart.destroy();
                }

                // Create new chart
                revenueChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Daily Revenue ($)',
                            data: chartData,
                            borderColor: 'rgb(79, 70, 229)',
                            backgroundColor: 'rgba(79, 70, 229, 0.1)',
                            tension: 0.3,
                            fill: true,
                            borderWidth: 2,
                            pointBackgroundColor: 'white',
                            pointBorderWidth: 2,
                            pointRadius: 4,
                            pointHoverRadius: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return '$' + context.raw.toFixed(2);
                                    }
                                }
                            },
                            legend: {
                                position: 'top',
                                labels: {
                                    boxWidth: 12,
                                    padding: 20
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return '$' + value;
                                    }
                                },
                                grid: {
                                    drawBorder: false,
                                    color: 'rgba(0, 0, 0, 0.05)'
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                },
                                ticks: {
                                    autoSkip: true,
                                    maxRotation: 0
                                }
                            }
                        }
                    }
                });

            } catch (error) {
                console.error('Error loading revenue chart:', error);
                // You could show an error message to the user here
            }
        }

        // Initialize when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Load initial chart
            loadRevenueChart();

            // Set up period selector
            document.querySelectorAll('.period-selector').forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    const days = this.getAttribute('data-days');
                    document.getElementById('analyticsPeriod').textContent = this.textContent;
                    loadRevenueChart(days);
                });
            });
        });
    </script>
@endpush
