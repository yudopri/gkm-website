@extends('layouts.dashboard')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <h5 class="card-header">Total Kinerja Keseluruhan</h5>
            <div class="card-body">
                <canvas id="totalPerMenuChart"></canvas>
            </div>
        </div>
    </div>
</div>

{{-- Data disimpan di HTML --}}
<div id="data-chart" style="display:none;">
    @foreach ($totals as $menu => $jumlah)
        <div class="item" data-label="{{ $menu }}" data-value="{{ $jumlah }}"></div>
    @endforeach
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const elements = document.querySelectorAll('#data-chart .item');

    const labels = [];
    const data = [];

    elements.forEach(el => {
        labels.push(el.dataset.label);
        data.push(Number(el.dataset.value));
    });

    const ctx = document.getElementById('totalPerMenuChart').getContext('2d');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Jumlah',
                data: data,
                backgroundColor: ['#4facfe', '#00f2fe', '#f7971e'],
                borderColor: '#333',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true },
                x: { ticks: { font: { weight: 'bold' } } }
            },
            plugins: {
                legend: { display: false }
            }
        }
    });
</script>

@endsection
