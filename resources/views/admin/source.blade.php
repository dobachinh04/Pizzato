@extends('admin.layouts.master')

@section('title')
Doanh Thu - Pizzato
@endsection

@section('content')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col">

                    <div class="container">
                        <h1>Thống Kê Nguồn Doanh Thu</h1>
                        <form method="GET" action="{{ route('admin.source') }}">
                            <input type="month" name="date_range" value="{{ request('date_range') }}">
                            <button type="submit">Lọc</button>
                        </form>
                        <canvas id="sourceChart"></canvas>
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
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
            ],
        }]
    };

    new Chart(ctx, {
        type: 'doughnut',
        data: chartData,
    });
</script>
@endsection