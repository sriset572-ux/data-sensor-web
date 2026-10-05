@extends('layouts.app')

@section('title', 'Sensor S3')

@push('styles')
    <link rel="stylesheet" href="{{ asset('../../../assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css') }}">
@endpush

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Data Sensor S3 Terakhir</h5>
                @if($lastSensor)
                <div class="row text-dark">
                    <div class="col-md-3 mb-3">
                        <div class="d-flex align-items-center bg-light rounded p-3 h-100">
                            <i data-feather="hash" class="icon-lg text-primary me-3"></i>
                            <div>
                                <div class="fw-bold">ID</div>
                                <div id="s3-sensor-id">{{ $lastSensor->id }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="d-flex align-items-center bg-light rounded p-3 h-100">
                            <i data-feather="clock" class="icon-lg text-primary me-3"></i>
                            <div>
                                <div class="fw-bold">Timestamp</div>
                                <div id="s3-sensor-timestamp">{{ $lastSensor->timestamp }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="d-flex align-items-center bg-light rounded p-3 h-100">
                            <i data-feather="thermometer" class="icon-lg text-danger me-3"></i>
                            <div>
                                <div class="fw-bold">Temperature</div>
                                <div id="s3-sensor-temperature">{{ $lastSensor->temperature }}&deg;C</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="d-flex align-items-center bg-light rounded p-3 h-100">
                            <i data-feather="droplet" class="icon-lg text-info me-3"></i>
                            <div>
                                <div class="fw-bold">Moisture</div>
                                <div id="s3-sensor-moisture">{{ $lastSensor->moisture }}%</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="d-flex align-items-center bg-light rounded p-3 h-100">
                            <i data-feather="activity" class="icon-lg text-success me-3"></i>
                            <div>
                                <div class="fw-bold">pH</div>
                                <div id="s3-sensor-ph">{{ $lastSensor->ph }} H⁺</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="d-flex align-items-center bg-light rounded p-3 h-100">
                            <i data-feather="zap" class="icon-lg text-warning me-3"></i>
                            <div>
                                <div class="fw-bold">Conductivity</div>
                                <div id="s3-sensor-conductivity">{{ $lastSensor->conductivity }} s/m</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="d-flex align-items-center bg-light rounded p-3 h-100">
                            <i data-feather="feather" class="icon-lg text-primary me-3"></i>
                            <div>
                                <div class="fw-bold">Nitrogen</div>
                                <div id="s3-sensor-nitrogen">{{ $lastSensor->nitrogen }} mg/kg</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="d-flex align-items-center bg-light rounded p-3 h-100">
                            <i data-feather="feather" class="icon-lg text-info me-3"></i>
                            <div>
                                <div class="fw-bold">Phosphorus</div>
                                <div id="s3-sensor-phosphorus">{{ $lastSensor->phosphorus }} mg/kg</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="d-flex align-items-center bg-light rounded p-3 h-100">
                            <i data-feather="feather" class="icon-lg text-success me-3"></i>
                            <div>
                                <div class="fw-bold">Potassium</div>
                                <div id="s3-sensor-potassium">{{ $lastSensor->potassium }} mg/kg</div>
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
                <h6 class="card-title">Data Sensor S3</h6>
                <div class="table-responsive">
                    <table id="sensorS3DataTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Timestamp</th>
                                <th>Temperature (&deg;C)</th>
                                <th>Moisture (%)</th>
                                <th>pH (H⁺)</th>
                                <th>Conductivity (s/m)</th>
                                <th>Nitrogen (mg/kg)</th>
                                <th>Phosphorus (mg/kg)</th>
                                <th>Potassium (mg/kg)</th>
                            </tr>
                        </thead>
                        <tbody>
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
function formatS3(val, suffix) {
    if (val === null || val === undefined || val === '') return '-';
    return String(val) + suffix;
}

function updateSensorS3Card() {
    fetch('/api/sensor-s3/last')
        .then(res => {
            if (!res.ok) {
                console.error('Failed to fetch last sensor S3 data:', res.status);
                return Promise.reject('Failed to fetch');
            }
            return res.json();
        })
        .then(data => {
            if (!data) {
                console.log('No last sensor S3 data received.');
                return;
            }
            console.log('Last sensor S3 data received:', data);
            document.getElementById('s3-sensor-id').innerText = data.id;
            document.getElementById('s3-sensor-timestamp').innerText = data.timestamp;
            document.getElementById('s3-sensor-temperature').innerText = (data.temperature != null && data.temperature !== '') ? data.temperature + '°C' : '-';
            document.getElementById('s3-sensor-moisture').innerText = formatS3(data.moisture, '%');
            document.getElementById('s3-sensor-ph').innerText = formatS3(data.ph, ' H⁺');
            document.getElementById('s3-sensor-conductivity').innerText = formatS3(data.conductivity, ' s/m');
            document.getElementById('s3-sensor-nitrogen').innerText = formatS3(data.nitrogen, ' mg/kg');
            document.getElementById('s3-sensor-phosphorus').innerText = formatS3(data.phosphorus, ' mg/kg');
            document.getElementById('s3-sensor-potassium').innerText = formatS3(data.potassium, ' mg/kg');
        })
        .catch(error => {
            console.error('Error updating sensor S3 card:', error);
        });
}

$(function() {
    // Inisialisasi DataTables
    var sensorS3Table = $('#sensorS3DataTable').DataTable({
        processing: true,
        serverSide: false, // False karena data diambil full oleh getAllSensor
        ajax: {
            url: '/api/sensor-s3/all',
            dataSrc: '' // Data dari API langsung berupa array
        },
        columns: [
            { data: 'id' },
            { data: 'timestamp' },
            { data: 'temperature', render: function(d) { return (d === null || d === undefined || d === '') ? '-' : d + '°C'; } },
            { data: 'moisture', render: function(d) { return (d === null || d === undefined || d === '') ? '-' : d + '%'; } },
            { data: 'ph', render: function(d) { return (d === null || d === undefined || d === '') ? '-' : d + ' H⁺'; } },
            { data: 'conductivity', render: function(d) { return (d === null || d === undefined || d === '') ? '-' : d + ' s/m'; } },
            { data: 'nitrogen', render: function(d) { return (d === null || d === undefined || d === '') ? '-' : d + ' mg/kg'; } },
            { data: 'phosphorus', render: function(d) { return (d === null || d === undefined || d === '') ? '-' : d + ' mg/kg'; } },
            { data: 'potassium', render: function(d) { return (d === null || d === undefined || d === '') ? '-' : d + ' mg/kg'; } }
        ]
    });

    // Panggil pertama kali saat DOM ready
    console.log('DOM Content Loaded, starting initial S3 data fetch for card and table.');
    updateSensorS3Card(); // Update card
    // DataTables akan otomatis fetch saat inisialisasi tabel

    // Mulai polling untuk CARD dan TABLE setiap 5 detik
    setInterval(() => {
        console.log('Fetching S3 data via polling...');
        updateSensorS3Card(); // Update card
        // Trigger DataTables reload setiap 5 detik untuk TABLE
        console.log('Reloading S3 table data via DataTables AJAX...');
        sensorS3Table.ajax.reload(null, false); // null: jangan reset paging, false: jangan reset ordering/filtering
    }, 5000);
});
</script>
@endpush 