@extends('layouts.app')

@section('title', 'Data Sensor')

@push('styles')
    <link rel="stylesheet" href="{{ asset('../../../assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css') }}">
@endpush

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Data Sensor V4 Terakhir</h5>
                @if($lastSensor)
                <div class="row text-dark">
                    <div class="col-md-3 mb-3">
                        <div class="d-flex align-items-center bg-light rounded p-3 h-100">
                            <i data-feather="hash" class="icon-lg text-primary me-3"></i>
                            <div>
                                <div class="fw-bold">ID</div>
                                <div id="sensor-id">{{ $lastSensor->id }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="d-flex align-items-center bg-light rounded p-3 h-100">
                            <i data-feather="clock" class="icon-lg text-primary me-3"></i>
                            <div>
                                <div class="fw-bold">Timestamp</div>
                                <div id="sensor-timestamp">{{ $lastSensor->timestamp }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="d-flex align-items-center bg-light rounded p-3 h-100">
                            <i data-feather="droplet" class="icon-lg text-info me-3"></i>
                            <div>
                                <div class="fw-bold">Moisture 1</div>
                                <div id="sensor-moisture1">{{ $lastSensor->moisture1 }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="d-flex align-items-center bg-light rounded p-3 h-100">
                            <i data-feather="droplet" class="icon-lg text-info me-3"></i>
                            <div>
                                <div class="fw-bold">Moisture 2</div>
                                <div id="sensor-moisture2">{{ $lastSensor->moisture2 }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="d-flex align-items-center bg-light rounded p-3 h-100">
                            <i data-feather="thermometer" class="icon-lg text-danger me-3"></i>
                            <div>
                                <div class="fw-bold">Temperature</div>
                                <div id="sensor-temperature">{{ $lastSensor->temperature }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="d-flex align-items-center bg-light rounded p-3 h-100">
                            <i data-feather="cloud" class="icon-lg text-success me-3"></i>
                            <div>
                                <div class="fw-bold">Humidity</div>
                                <div id="sensor-humidity">{{ $lastSensor->humidity }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="d-flex align-items-center bg-light rounded p-3 h-100">
                            <i data-feather="sun" class="icon-lg text-warning me-3"></i>
                            <div>
                                <div class="fw-bold">Lux</div>
                                <div id="sensor-lux">{{ $lastSensor->lux }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="d-flex align-items-center bg-light rounded p-3 h-100">
                            <i data-feather="cloud-rain" class="icon-lg text-primary me-3"></i>
                            <div>
                                <div class="fw-bold">Rain</div>
                                <div id="sensor-rain">{{ $lastSensor->rain }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <p class="text-muted">Tidak ada data sensor.</p>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Data Sensor V4</h6>
                <div class="table-responsive">
                    <table id="sensorDataTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Timestamp</th>
                                <th>Moisture 1</th>
                                <th>Moisture 2</th>
                                <th>Temperature</th>
                                <th>Humidity</th>
                                <th>Lux</th>
                                <th>Rain</th>
                            </tr>
                        </thead>
                        <tbody id="sensor-table-body">
                           {{-- DataTables akan mengisi tbody --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('../../../assets/vendors/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('../../../assets/vendors/datatables.net/dataTables.js') }}"></script>
<script src="{{ asset('../../../assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js') }}"></script>

<script>
function updateSensorCard() {
    fetch('/api/sensor/last')
        .then(res => {
            if (!res.ok) {
                console.error('Failed to fetch last sensor data:', res.status);
                return Promise.reject('Failed to fetch');
            }
            return res.json();
        })
        .then(data => {
            if (!data) {
                console.log('No last sensor data received.');
                return;
            }
            console.log('Last sensor data received:', data);
            document.getElementById('sensor-id').innerText = data.id;
            document.getElementById('sensor-timestamp').innerText = data.timestamp;
            document.getElementById('sensor-moisture1').innerText = data.moisture1;
            document.getElementById('sensor-moisture2').innerText = data.moisture2;
            document.getElementById('sensor-temperature').innerText = data.temperature;
            document.getElementById('sensor-humidity').innerText = data.humidity;
            document.getElementById('sensor-lux').innerText = data.lux;
            document.getElementById('sensor-rain').innerText = data.rain;
        })
        .catch(error => {
            console.error('Error updating sensor card:', error);
        });
}

function updateSensorTable() {
    // Fungsi ini tidak lagi digunakan untuk update tabel
    // DataTables akan menangani fetch dan rendering tabel
}

$(function() {
    // Inisialisasi DataTables
    var sensorTable = $('#sensorDataTable').DataTable({
        processing: true,
        serverSide: false, // Gunakan false karena data diambil full oleh getAllSensor
        ajax: {
            url: '/api/sensor/all',
            dataSrc: '' // Data dari API langsung berupa array
        },
        columns: [
            { data: 'id' },
            { data: 'timestamp' },
            { data: 'moisture1' },
            { data: 'moisture2' },
            { data: 'temperature' },
            { data: 'humidity' },
            { data: 'lux' },
            { data: 'rain' }
        ]
    });

    // Panggil pertama kali saat DOM ready
    console.log('DOM Content Loaded, starting initial data fetch for card.');
    updateSensorCard(); // Card masih diupdate terpisah
    // DataTables akan otomatis fetch saat inisialisasi

    // Mulai polling untuk CARD setiap 5 detik
    setInterval(() => {
        console.log('Fetching card data via polling...');
        updateSensorCard();
        // Trigger DataTables reload setiap 5 detik untuk TABLE
        console.log('Reloading table data via DataTables AJAX...');
        sensorTable.ajax.reload(null, false); // null: jangan reset paging, false: jangan reset ordering/filtering
    }, 5000);
});
</script>
@endpush 