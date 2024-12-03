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
                        <h2>Thống Kê Doanh Thu</h2>
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
            labels: [
                'Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9',
                'Tháng 10', 'Tháng 11', 'Tháng 12'
            ],
            datasets: [{
                label: 'Doanh thu',
                data: @json(array_column($revenueStats, 'total_revenue')),
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)', // Màu Tháng 1
                    'rgba(54, 162, 235, 0.6)', // Màu Tháng 2
                    'rgba(255, 206, 86, 0.6)', // Màu Tháng 3
                    'rgba(75, 192, 192, 0.6)', // Màu Tháng 4
                    'rgba(153, 102, 255, 0.6)', // Màu Tháng 5
                    'rgba(255, 159, 64, 0.6)', // Màu Tháng 6
                    'rgba(255, 99, 71, 0.6)', // Tháng 7
                    'rgba(135, 206, 250, 0.6)', // Tháng 8
                    'rgba(255, 215, 0, 0.6)', // Tháng 9
                    'rgba(0, 128, 0, 0.6)', // Tháng 10
                    'rgba(128, 0, 128, 0.6)', // Tháng 11
                    'rgba(255, 0, 255, 0.6)' // Tháng 12
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)', 
                    'rgba(54, 162, 235, 1)', 
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)', 
                    'rgba(153, 102, 255, 1)', 
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 99, 71, 1)', 
                    'rgba(135, 206, 250, 1)', 
                    'rgba(255, 215, 0, 1)',
                    'rgba(0, 128, 0, 1)', 
                    'rgba(128, 0, 128, 1)', 
                    'rgba(255, 0, 255, 1)'
                ],
                borderWidth: 1,
            }]
        };

        new Chart(ctx, {
            type: 'bar',
            data: chartData,
            
        });
</script>


@endsection