@extends('layouts.app')

@section('title', 'Analisis Data ANFIS (N, P, K, Output) 3D')

@push('styles')
<style>
    .chart-container {
        position: relative;
        margin: auto;
        height: 600px;
        width: 100%;
    }
    .loading {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
    }
    .info-card {
        margin-bottom: 1rem;
    }
    .info-card .card-body {
        padding: 1rem;
    }
    .info-card h6 {
        margin-bottom: 0.5rem;
    }
    .info-card p {
        margin-bottom: 0;
        font-size: 0.9rem;
    }
    .controls {
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    .controls button {
        margin-right: 0.5rem;
    }
    .form-group {
        margin-bottom: 0;
    }
</style>
@endpush

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10 grid-margin">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Analisis ANFIS (Input Variabel & Output) 3D</h5>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">Surface Plot ANFIS</h6>
                                <div class="info-card">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6>Informasi Analisis</h6>
                                            <p>• Visualisasi 3D hubungan antara dua input (pilihan Anda) dan Output ANFIS</p>
                                            <p>• Grafik ini menampilkan surface plot simulasi</p>
                                            <p>• Warna surface menunjukkan nilai Output ANFIS</p>
                                            <p>• Klik dan drag untuk memutar grafik</p>
                                            <p>• Scroll untuk zoom in/out</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="controls">
                                    <div class="form-group">
                                        <label for="xAxisSelect">Sumbu X:</label>
                                        <select class="form-control form-control-sm" id="xAxisSelect">
                                            <option value="nitrogen">Nitrogen</option>
                                            <option value="phosphorus">Phosphorus</option>
                                            <option value="potassium">Potassium</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="yAxisSelect">Sumbu Y:</label>
                                        <select class="form-control form-control-sm" id="yAxisSelect">
                                            <option value="phosphorus">Phosphorus</option>
                                            <option value="nitrogen">Nitrogen</option>
                                            <option value="potassium">Potassium</option>
                                        </select>
                                    </div>
                                    <button class="btn btn-primary btn-sm" onclick="loadAnfisChart()">Perbarui Grafik</button>
                                    <button class="btn btn-secondary btn-sm" onclick="resetAnfisView()">Reset View</button>
                                </div>
                                <div class="chart-container">
                                    <div id="anfisChart" class="chart-container">
                                        <div class="loading">
                                            <div class="spinner-border text-primary" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                            <p class="mt-2">Memuat grafik ANFIS...</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
<script>
function loadAnfisChart() {
    const xAxis = document.getElementById('xAxisSelect').value;
    const yAxis = document.getElementById('yAxisSelect').value;

    if (xAxis === yAxis) {
        alert('Sumbu X dan Sumbu Y tidak boleh sama.');
        return;
    }

    document.getElementById('anfisChart').innerHTML = 
        '<div class="loading"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div><p class="mt-2">Memuat grafik ANFIS...</p></div>';

    fetch(`/api/analysis/anfis?xAxis=${xAxis}&yAxis=${yAxis}`)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                document.getElementById('anfisChart').innerHTML = 
                    '<div class="alert alert-danger">Gagal memuat grafik ANFIS: ' + data.error + '</div>';
                console.error('Error loading ANFIS chart:', data.error);
                return;
            }

            const layout = {
                title: `Surface Plot ANFIS (${xAxis.charAt(0).toUpperCase() + xAxis.slice(1)}, ${yAxis.charAt(0).toUpperCase() + yAxis.slice(1)}, Output) 3D`,
                scene: {
                    xaxis: { title: xAxis.charAt(0).toUpperCase() + xAxis.slice(1) },
                    yaxis: { title: yAxis.charAt(0).toUpperCase() + yAxis.slice(1) },
                    zaxis: { title: 'Output ANFIS' },
                    camera: {
                        eye: { x: 1.2, y: 1.2, z: 1.2 }
                    }
                },
                showlegend: false,
                margin: {
                    l: 50,
                    r: 20,
                    t: 50,
                    b: 50
                }
            };
            
            Plotly.newPlot('anfisChart', data, layout);
        })
        .catch(error => {
            console.error('Error loading ANFIS chart:', error);
            document.getElementById('anfisChart').innerHTML = 
                '<div class="alert alert-danger">Gagal memuat grafik ANFIS</div>';
        });
}

function resetAnfisView() {
    Plotly.relayout('anfisChart', {
        'scene.camera': {
            eye: { x: 1.2, y: 1.2, z: 1.2 }
        }
    });
}

document.addEventListener('DOMContentLoaded', function() {
    loadAnfisChart();
    
    setInterval(() => {
        loadAnfisChart();
    }, 300000);
});
</script>
@endpush 