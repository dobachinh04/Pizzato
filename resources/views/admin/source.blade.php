@extends('admin.layouts.master')

@section('title')
    Doanh Thu Theo Danh Mục
@endsection

@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header d-flex align-items-center">
                                <h3 class="m-0">Thống Kê Doanh Thu Theo Danh Mục</h3>
                            </div>

                            <div class="card-body row">
                                <form method="GET" action="{{ route('admin.source') }}" class="col-3 d-flex">
                                    <input class="form-control me-2" type="month" name="date_range"
                                        value="{{ request('date_range') }}">
                                    <button class="btn btn-primary" type="submit">Lọc</button>
                                </form>
                                <canvas id="sourceChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('sourceChart').getContext('2d');
        const chartData = {
            labels: @json($sourceStats->pluck('category_name')),
            datasets: [{
                label: 'Doanh thu theo danh mục',
                data: @json($sourceStats->pluck('total_revenue')),
                backgroundColor: [
                    'rgb(255, 99, 132)', //màu hồng
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(153, 102, 255)',
                    'rgb(255, 159, 64)',
                    'rgb(201, 203, 207)'
                ],
            }]
        };

        new Chart(ctx, {
            type: 'doughnut',
            data: chartData,
            options: {
                plugins: {
                    title: {
                        display: true,
                        position: 'left',
                        text: 'Biểu đồ',
                        font: {
                            size: 15
                        }
                    },
                    legend: {
                        position: 'right',
                        align: 'center',
                        labels: {
                            font: {
                                size: 15
                            }
                        }
                    }
                },
                layout: {
                    padding: {
                        top: 30,
                        right: 200,
                        bottom: 600,
                        left: 200
                    }
                },
            }
        });
    </script>
@endsection
