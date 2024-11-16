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
                        <h1>Thống Kê Doanh Thu</h1>
                        <form method="GET" action="{{ route('admin.chart') }}">
                            <input type="month" name="date_range" value="{{ request('date_range') }}">
                            <button type="submit">Lọc</button>
                        </form>
                        <canvas id="revenueChart"></canvas>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('revenueChart').getContext('2d');
    const chartData = {
        labels: @json($revenueStats->pluck('month')),
        datasets: [{
            label: 'Doanh thu',
            data: @json($revenueStats->pluck('total_revenue')),
            borderColor: 'rgba(75, 192, 192, 1)',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
        }]
    };

    new Chart(ctx, {
        type: 'line',
        data: chartData,
    });
</script>


@endsection