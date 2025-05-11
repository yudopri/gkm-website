@extends('layouts.dashboard')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <h5 class="card-header">Grafik Penelitian DTPS Dosen</h5>
            <hr class="my-0" />
            <div class="card-body">
                <div class="chart-wrapper">
                    <div class="chart-container">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="chart-data" style="display: none;">
    @foreach ($data as $item)
        <div class="data-item" 
            data-tahun="{{ $item->tahun_ajaran }}" 
            data-total="{{ $item->total_kerjasama }}">
        </div>
    @endforeach
</div>

<style>
    .chart-wrapper {
        display: flex;
        justify-content: center;
    }

    .chart-container {
        width: 80%;
        max-width: 1000px;
    }

    canvas {
        width: 100% !important;
        height: 400px !important;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const dataItems = document.querySelectorAll('#chart-data .data-item');

    const labels = [];
    const dataKerjasama = [];

    dataItems.forEach(item => {
        labels.push(item.getAttribute('data-tahun'));
        dataKerjasama.push(parseInt(item.getAttribute('data-total')));
    });

    const ctx = document.getElementById('myChart').getContext('2d');

    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, '#4facfe');
    gradient.addColorStop(1, '#00f2fe');

    const myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Penelitian DTPS Dosen',
                data: dataKerjasama,
                backgroundColor: gradient,
                borderColor: '#00c6ff',
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#fff',
                pointBorderColor: '#00c6ff',
                pointRadius: 5,
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    ticks: { color: '#333', font: { weight: 'bold' } },
                    grid: { display: false }
                },
                y: {
                    beginAtZero: true,
                    ticks: { color: '#333' },
                    grid: { color: '#eee' }
                }
            },
            plugins: {
                legend: {
                    labels: {
                        color: '#333',
                        font: { size: 14, weight: 'bold' }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return ` ${context.dataset.label}: ${context.parsed.y} kerjasama`;
                        }
                    }
                }
            },
            animation: {
                duration: 1000,
                easing: 'easeInOutCubic'
            }
        }
    });
</script>

@endsection
