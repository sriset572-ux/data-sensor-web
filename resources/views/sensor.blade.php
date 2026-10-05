@extends('layouts.app')

@section('title', 'Data Sensor')

@push('styles')
    <link rel="stylesheet" href="{{ asset('../../../assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css') }}">
@endpush

@section('content')
<div id="node-cards-container">
    <!-- Card untuk setiap node akan ditambahkan di sini secara dinamis -->
</div>

<div id="node-tables-container">
    <!-- Tabel untuk setiap node akan ditambahkan di sini secara dinamis -->
</div>
@endsection

@push('scripts')
<script src="{{ asset('../../../assets/vendors/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('../../../assets/vendors/datatables.net/dataTables.js') }}"></script>
<script src="{{ asset('../../../assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js') }}"></script>

<script>
function createNodeCard(nodeId) {
    const cardId = `node-card-${nodeId}`;
    const container = document.createElement('div');
    container.className = 'row mb-4';
    container.id = cardId;
    
    container.innerHTML = `
        <div class="col-md-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="card-title mb-0">Data Sensor V4 Terakhir - Node ${nodeId}</h5>
                        <div id="node-status-${nodeId}">
                            <span class="badge bg-success">Node Aktif</span>
                        </div>
                    </div>
                    <div id="node-warning-${nodeId}" class="alert alert-warning d-none mb-3">
                        <i data-feather="alert-triangle" class="me-2"></i>
                        Node tidak aktif selama lebih dari 5 detik. Silakan periksa dan nyalakan kembali node.
                    </div>
                    <div class="row text-dark">
                        <div class="col-md-3 mb-3">
                            <div class="d-flex align-items-center bg-light rounded p-3 h-100">
                                <i data-feather="hash" class="icon-lg text-primary me-3"></i>
                                <div>
                                    <div class="fw-bold">ID</div>
                                    <div id="sensor-id-${nodeId}">-</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="d-flex align-items-center bg-light rounded p-3 h-100">
                                <i data-feather="clock" class="icon-lg text-primary me-3"></i>
                                <div>
                                    <div class="fw-bold">Timestamp</div>
                                    <div id="sensor-timestamp-${nodeId}">-</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="d-flex align-items-center bg-light rounded p-3 h-100">
                                <i data-feather="droplet" class="icon-lg text-info me-3"></i>
                                <div>
                                    <div class="fw-bold">Moisture 1</div>
                                    <div id="sensor-moisture1-${nodeId}">-</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="d-flex align-items-center bg-light rounded p-3 h-100">
                                <i data-feather="droplet" class="icon-lg text-info me-3"></i>
                                <div>
                                    <div class="fw-bold">Moisture 2</div>
                                    <div id="sensor-moisture2-${nodeId}">-</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="d-flex align-items-center bg-light rounded p-3 h-100">
                                <i data-feather="thermometer" class="icon-lg text-danger me-3"></i>
                                <div>
                                    <div class="fw-bold">Temperature</div>
                                    <div id="sensor-temperature-${nodeId}">-</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="d-flex align-items-center bg-light rounded p-3 h-100">
                                <i data-feather="cloud" class="icon-lg text-success me-3"></i>
                                <div>
                                    <div class="fw-bold">Humidity</div>
                                    <div id="sensor-humidity-${nodeId}">-</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="d-flex align-items-center bg-light rounded p-3 h-100">
                                <i data-feather="sun" class="icon-lg text-warning me-3"></i>
                                <div>
                                    <div class="fw-bold">Light intencity</div>
                                    <div id="sensor-lux-${nodeId}">-</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="d-flex align-items-center bg-light rounded p-3 h-100">
                                <i data-feather="cloud-rain" class="icon-lg text-primary me-3"></i>
                                <div>
                                    <div class="fw-bold">Rain</div>
                                    <div id="sensor-rain-${nodeId}">-</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    document.getElementById('node-cards-container').appendChild(container);
    feather.replace();
}

// Objek untuk menyimpan timestamp terakhir setiap node
const lastUpdateTime = {};

function formatSensorV4Value(val, suffix) {
    if (val === null || val === undefined || val === '') return '-';
    return String(val) + suffix;
}

function updateNodeCard(nodeId, data) {
    if (!data) return;
    
    // Update timestamp terakhir berdasarkan data yang diterima
    const dataTimestamp = new Date(data.timestamp).getTime();
    lastUpdateTime[nodeId] = dataTimestamp;
    
    document.getElementById(`sensor-id-${nodeId}`).innerText = data.id || '-';
    document.getElementById(`sensor-timestamp-${nodeId}`).innerText = data.timestamp || '-';
    document.getElementById(`sensor-moisture1-${nodeId}`).innerText = formatSensorV4Value(data.moisture1, '%');
    document.getElementById(`sensor-moisture2-${nodeId}`).innerText = formatSensorV4Value(data.moisture2, '%');
    document.getElementById(`sensor-temperature-${nodeId}`).innerText = data.temperature || '-';
    document.getElementById(`sensor-humidity-${nodeId}`).innerText = data.humidity || '-';
    document.getElementById(`sensor-lux-${nodeId}`).innerText = formatSensorV4Value(data.lux, ' lux');
    document.getElementById(`sensor-rain-${nodeId}`).innerText = formatSensorV4Value(data.rain, '%');
    
    // Update status node
    const statusElement = document.getElementById(`node-status-${nodeId}`);
    const warningElement = document.getElementById(`node-warning-${nodeId}`);
    
    statusElement.innerHTML = '<span class="badge bg-success">Node Aktif</span>';
    warningElement.classList.add('d-none');
}

function checkNodeStatus() {
    const currentTime = new Date().getTime();
    const inactiveThreshold = 60000; // 60 detik dalam milidetik
    
    Object.keys(lastUpdateTime).forEach(nodeId => {
        const timeSinceLastUpdate = currentTime - lastUpdateTime[nodeId];
        const statusElement = document.getElementById(`node-status-${nodeId}`);
        const warningElement = document.getElementById(`node-warning-${nodeId}`);
        
        if (timeSinceLastUpdate > inactiveThreshold) {
            statusElement.innerHTML = '<span class="badge bg-danger">Node Tidak Aktif</span>';
            warningElement.classList.remove('d-none');
        } else {
            statusElement.innerHTML = '<span class="badge bg-success">Node Aktif</span>';
            warningElement.classList.add('d-none');
        }
    });
}

function updateAllNodeCards() {
    fetch('/api/sensor/all')
        .then(res => res.json())
        .then(data => {
            // Kelompokkan data berdasarkan ID_Node
            const nodeData = {};
            data.forEach(item => {
                if (!nodeData[item.ID_Node] || new Date(item.timestamp) > new Date(nodeData[item.ID_Node].timestamp)) {
                    nodeData[item.ID_Node] = item;
                }
            });
            
            // Update card untuk setiap node
            Object.entries(nodeData).forEach(([nodeId, nodeData]) => {
                updateNodeCard(nodeId, nodeData);
            });
            
            // Periksa status node
            checkNodeStatus();
        })
        .catch(error => {
            console.error('Error updating node cards:', error);
        });
}

function createNodeTable(nodeId) {
    const tableId = `sensorDataTable-${nodeId}`;
    const containerId = `node-table-${nodeId}`;
    
    // Buat container untuk tabel node
    const container = document.createElement('div');
    container.className = 'row mb-4';
    container.id = containerId;
    
    // Buat card untuk tabel
    const card = document.createElement('div');
    card.className = 'col-md-12 grid-margin';
    card.innerHTML = `
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Data Sensor V4 - Node ${nodeId}</h6>
                <div class="table-responsive">
                    <table id="${tableId}" class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Timestamp</th>
                                <th>Moisture 1 (%)</th>
                                <th>Moisture 2 (%)</th>
                                <th>Temperature</th>
                                <th>Humidity</th>
                                <th>Light intencity (lux)</th>
                                <th>Rain (%)</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    `;
    
    container.appendChild(card);
    document.getElementById('node-tables-container').appendChild(container);
    
    // Inisialisasi DataTable untuk node ini
    return $(`#${tableId}`).DataTable({
        processing: true,
        serverSide: false,
        ajax: {
            url: '/api/sensor/all',
            dataSrc: function(json) {
                // Filter data untuk node ini
                return json.filter(item => item.ID_Node === nodeId);
            }
        },
        columns: [
            { data: 'id' },
            { data: 'timestamp' },
            { data: 'moisture1', render: function(d) { return (d === null || d === undefined || d === '') ? '-' : d + '%'; } },
            { data: 'moisture2', render: function(d) { return (d === null || d === undefined || d === '') ? '-' : d + '%'; } },
            { data: 'temperature' },
            { data: 'humidity' },
            { data: 'lux', render: function(d) { return (d === null || d === undefined || d === '') ? '-' : d + ' lux'; } },
            { data: 'rain', render: function(d) { return (d === null || d === undefined || d === '') ? '-' : d + '%'; } }
        ]
    });
}

$(function() {
    // Objek untuk menyimpan instance DataTable untuk setiap node
    const nodeTables = {};
    
    // Fungsi untuk mendapatkan daftar node unik
    function getUniqueNodes() {
        return fetch('/api/sensor/all')
            .then(res => res.json())
            .then(data => {
                const nodes = [...new Set(data.map(item => item.ID_Node))];
                return nodes;
            });
    }
    
    // Inisialisasi card dan tabel untuk setiap node
    getUniqueNodes().then(nodes => {
        nodes.forEach(nodeId => {
            createNodeCard(nodeId);
            nodeTables[nodeId] = createNodeTable(nodeId);
        });
        feather.replace();
        
        // Inisialisasi data pertama kali
        updateAllNodeCards();
    });
    
    // Mulai polling setiap 2 detik
    setInterval(() => {
        console.log('Fetching data via polling...');
        updateAllNodeCards();
        
        // Reload semua tabel node
        Object.values(nodeTables).forEach(table => {
            table.ajax.reload(null, false);
        });
    }, 2000);
});
</script>
@endpush 