@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Dashboard</h6>
                <p class="text-muted mb-3">Selamat datang di halaman dashboard SensorData.</p>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4 d-flex">
    @if(isset($latestSensor))
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title mb-4 text-center">Data Sensor V4 Terbaru</h5>
                <div class="row">
                    <div class="col-12 col-md-4 mb-3 text-center">
                        <i data-feather="droplet" class="icon-lg mb-1"></i>
                        <div class="fw-bold">Moisture 1</div>
                        <div class="fs-2 fw-bold py-1" id="dashboard-moisture1">{{ $latestSensor->moisture1 }}%</div>
                    </div>
                    <div class="col-12 col-md-4 mb-3 text-center">
                        <i data-feather="droplet" class="icon-lg mb-1"></i>
                        <div class="fw-bold">Moisture 2</div>
                        <div class="fs-2 fw-bold py-1" id="dashboard-moisture2">{{ $latestSensor->moisture2 }}%</div>
                    </div>
                    <div class="col-12 col-md-4 mb-3 text-center">
                        <i data-feather="thermometer" class="icon-lg mb-1 text-danger"></i>
                        <div class="fw-bold">Temperature</div>
                        <div class="fs-2 fw-bold py-1" id="dashboard-temperature">{{ $latestSensor->temperature }}&deg;C</div>
                    </div>
                    <div class="col-12 col-md-4 mb-3 text-center">
                        <i data-feather="cloud" class="icon-lg mb-1 text-success"></i>
                        <div class="fw-bold">Humidity</div>
                        <div class="fs-2 fw-bold py-1" id="dashboard-humidity">{{ $latestSensor->humidity }}%</div>
                    </div>
                    <div class="col-12 col-md-4 mb-3 text-center">
                        <i data-feather="sun" class="icon-lg mb-1 text-warning"></i>
                        <div class="fw-bold">Light intencity</div>
                        <div class="fs-2 fw-bold py-1" id="dashboard-lux">{{ $latestSensor->lux }} lux</div>
                    </div>
                    <div class="col-12 col-md-4 mb-3 text-center">
                        <i data-feather="cloud-rain" class="icon-lg mb-1 text-primary"></i>
                        <div class="fw-bold">Rain</div>
                        <div class="fs-2 fw-bold py-1" id="dashboard-rain">{{ $latestSensor->rain }}%</div>
                    </div>
                </div>
                <div class="text-muted mt-2 text-center" style="font-size: 0.9em;">
                    <i data-feather="clock" class="me-1"></i>
                    <span id="dashboard-timestamp">{{ $latestSensor->timestamp }}</span>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if(isset($latestSensorS3))
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-body">
                <h5 class="card-title mb-4 text-center">Data Sensor S3 Terbaru</h5>
                <div class="row">
                    <div class="col-12 col-md-4 mb-3 text-center">
                        <i data-feather="thermometer" class="icon-lg mb-1 text-danger"></i>
                        <div class="fw-bold">Temperature</div>
                        <div class="fs-2 fw-bold py-1" id="dashboard-s3-temperature">{{ $latestSensorS3->temperature }}&deg;C</div>
                    </div>
                    <div class="col-12 col-md-4 mb-3 text-center">
                        <i data-feather="droplet" class="icon-lg mb-1 text-info"></i>
                        <div class="fw-bold">Moisture</div>
                        <div class="fs-2 fw-bold py-1" id="dashboard-s3-moisture">{{ $latestSensorS3->moisture }}%</div>
                    </div>
                    <div class="col-12 col-md-4 mb-3 text-center">
                        <i data-feather="activity" class="icon-lg mb-1 text-success"></i>
                        <div class="fw-bold">pH</div>
                        <div class="fs-2 fw-bold py-1" id="dashboard-s3-ph">{{ $latestSensorS3->ph }} H⁺</div>
                    </div>
                    <div class="col-12 col-md-4 mb-3 text-center">
                        <i data-feather="zap" class="icon-lg mb-1 text-warning"></i>
                        <div class="fw-bold">Conductivity</div>
                        <div class="fs-2 fw-bold py-1" id="dashboard-s3-conductivity">{{ $latestSensorS3->conductivity }} s/m</div>
                    </div>
                    <div class="col-12 col-md-4 mb-3 text-center">
                        <i data-feather="droplet" class="icon-lg mb-1 text-primary"></i>
                        <div class="fw-bold">Nitrogen</div>
                        <div class="fs-2 fw-bold py-1" id="dashboard-s3-nitrogen">{{ $latestSensorS3->nitrogen }} mg/kg</div>
                    </div>
                    <div class="col-12 col-md-4 mb-3 text-center">
                        <i data-feather="droplet" class="icon-lg mb-1 text-secondary"></i>
                        <div class="fw-bold">Phosphorus</div>
                        <div class="fs-2 fw-bold py-1" id="dashboard-s3-phosphorus">{{ $latestSensorS3->phosphorus }} mg/kg</div>
                    </div>
                    <div class="col-12 col-md-4 mb-3 text-center">
                        <i data-feather="droplet" class="icon-lg mb-1 text-dark"></i>
                        <div class="fw-bold">Potassium</div>
                        <div class="fs-2 fw-bold py-1" id="dashboard-s3-potassium">{{ $latestSensorS3->potassium }} mg/kg</div>
                    </div>
                </div>
                <div class="text-muted mt-2 text-center" style="font-size: 0.9em;">
                    <i data-feather="clock" class="me-1"></i>
                    <span id="dashboard-s3-timestamp">{{ $latestSensorS3->timestamp }}</span>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">Data Sensor</h5>
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="d-flex align-items-center mb-2">
                            <i data-feather="droplet" class="icon-lg text-info me-2"></i>
                            <h6 class="mb-0">Grafik Moisture 1 (%)</h6>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label for="dataLimitMoisture1" class="me-2">Tampilkan</label>
                            <select id="dataLimitMoisture1" class="form-select d-inline-block w-auto">
                                <option value="5">5</option>
                                <option value="10" selected>10</option>
                                <option value="25">25</option>
                            </select>
                            <span>data terakhir</span>
                        </div>
                        <div id="moisture1Chart" style="height: 250px;"></div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="d-flex align-items-center mb-2">
                            <i data-feather="droplet" class="icon-lg text-info me-2"></i>
                            <h6 class="mb-0">Grafik Moisture 2 (%)</h6>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label for="dataLimitMoisture2" class="me-2">Tampilkan</label>
                            <select id="dataLimitMoisture2" class="form-select d-inline-block w-auto">
                                <option value="5">5</option>
                                <option value="10" selected>10</option>
                                <option value="25">25</option>
                            </select>
                            <span>data terakhir</span>
                        </div>
                        <div id="moisture2Chart" style="height: 250px;"></div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="d-flex align-items-center mb-2">
                            <i data-feather="thermometer" class="icon-lg text-danger me-2"></i>
                            <h6 class="mb-0">Grafik Temperature</h6>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label for="dataLimitTemperature" class="me-2">Tampilkan</label>
                            <select id="dataLimitTemperature" class="form-select d-inline-block w-auto">
                                <option value="5">5</option>
                                <option value="10" selected>10</option>
                                <option value="25">25</option>
                            </select>
                            <span>data terakhir</span>
                        </div>
                        <div id="temperatureChart" style="height: 250px;"></div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="d-flex align-items-center mb-2">
                            <i data-feather="cloud" class="icon-lg text-success me-2"></i>
                            <h6 class="mb-0">Grafik Humidity</h6>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label for="dataLimitHumidity" class="me-2">Tampilkan</label>
                            <select id="dataLimitHumidity" class="form-select d-inline-block w-auto">
                                <option value="5">5</option>
                                <option value="10" selected>10</option>
                                <option value="25">25</option>
                            </select>
                            <span>data terakhir</span>
                        </div>
                        <div id="humidityChart" style="height: 250px;"></div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="d-flex align-items-center mb-2">
                            <i data-feather="sun" class="icon-lg text-warning me-2"></i>
                            <h6 class="mb-0">Grafik Light intencity (lux)</h6>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label for="dataLimitLux" class="me-2">Tampilkan</label>
                            <select id="dataLimitLux" class="form-select d-inline-block w-auto">
                                <option value="5">5</option>
                                <option value="10" selected>10</option>
                                <option value="25">25</option>
                            </select>
                            <span>data terakhir</span>
                        </div>
                        <div id="luxChart" style="height: 250px;"></div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="d-flex align-items-center mb-2">
                            <i data-feather="cloud-rain" class="icon-lg text-primary me-2"></i>
                            <h6 class="mb-0">Grafik Rain (%)</h6>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label for="dataLimitRain" class="me-2">Tampilkan</label>
                            <select id="dataLimitRain" class="form-select d-inline-block w-auto">
                                <option value="5">5</option>
                                <option value="10" selected>10</option>
                                <option value="25">25</option>
                            </select>
                            <span>data terakhir</span>
                        </div>
                        <div id="rainChart" style="height: 250px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(isset($latestSensorS3))
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-4">Data Sensor S3</h5>
                <div class="row">
                    <div class="col-md-3 mb-4">
                        <div class="d-flex align-items-center mb-2">
                            <i data-feather="thermometer" class="icon-lg text-danger me-2"></i>
                            <h6 class="mb-0">Grafik Temperature</h6>
                        </div>
                        <select id="dataLimitS3Temperature" class="form-select d-inline-block w-auto mb-2">
                            <option value="5">5</option>
                            <option value="10" selected>10</option>
                            <option value="25">25</option>
                        </select>
                        <div id="s3TemperatureChart" style="height: 200px;"></div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="d-flex align-items-center mb-2">
                            <i data-feather="droplet" class="icon-lg text-info me-2"></i>
                            <h6 class="mb-0">Grafik Moisture (%)</h6>
                        </div>
                        <select id="dataLimitS3Moisture" class="form-select d-inline-block w-auto mb-2">
                            <option value="5">5</option>
                            <option value="10" selected>10</option>
                            <option value="25">25</option>
                        </select>
                        <div id="s3MoistureChart" style="height: 200px;"></div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="d-flex align-items-center mb-2">
                            <i data-feather="activity" class="icon-lg text-success me-2"></i>
                            <h6 class="mb-0">Grafik pH (H⁺)</h6>
                        </div>
                        <select id="dataLimitS3Ph" class="form-select d-inline-block w-auto mb-2">
                            <option value="5">5</option>
                            <option value="10" selected>10</option>
                            <option value="25">25</option>
                        </select>
                        <div id="s3PhChart" style="height: 200px;"></div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="d-flex align-items-center mb-2">
                            <i data-feather="zap" class="icon-lg text-warning me-2"></i>
                            <h6 class="mb-0">Grafik Conductivity (s/m)</h6>
                        </div>
                        <select id="dataLimitS3Conductivity" class="form-select d-inline-block w-auto mb-2">
                            <option value="5">5</option>
                            <option value="10" selected>10</option>
                            <option value="25">25</option>
                        </select>
                        <div id="s3ConductivityChart" style="height: 200px;"></div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="d-flex align-items-center mb-2">
                            <i data-feather="droplet" class="icon-lg text-primary me-2"></i>
                            <h6 class="mb-0">Grafik Nitrogen (mg/kg)</h6>
                        </div>
                        <select id="dataLimitS3Nitrogen" class="form-select d-inline-block w-auto mb-2">
                            <option value="5">5</option>
                            <option value="10" selected>10</option>
                            <option value="25">25</option>
                        </select>
                        <div id="s3NitrogenChart" style="height: 200px;"></div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="d-flex align-items-center mb-2">
                            <i data-feather="droplet" class="icon-lg text-secondary me-2"></i>
                            <h6 class="mb-0">Grafik Phosphorus (mg/kg)</h6>
                        </div>
                        <select id="dataLimitS3Phosphorus" class="form-select d-inline-block w-auto mb-2">
                            <option value="5">5</option>
                            <option value="10" selected>10</option>
                            <option value="25">25</option>
                        </select>
                        <div id="s3PhosphorusChart" style="height: 200px;"></div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="d-flex align-items-center mb-2">
                            <i data-feather="droplet" class="icon-lg text-dark me-2"></i>
                            <h6 class="mb-0">Grafik Potassium (mg/kg)</h6>
                        </div>
                        <select id="dataLimitS3Potassium" class="form-select d-inline-block w-auto mb-2">
                            <option value="5">5</option>
                            <option value="10" selected>10</option>
                            <option value="25">25</option>
                        </select>
                        <div id="s3PotassiumChart" style="height: 200px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@push('scripts')
<script>
function renderSensorChart(chartId, selectId, dataKey, color, labelCfg) {
    labelCfg = labelCfg || {};
    const defaultName = dataKey.charAt(0).toUpperCase() + dataKey.slice(1);
    const seriesName = labelCfg.seriesName || defaultName;
    const yTitle = labelCfg.yTitle || seriesName;
    let chart;
    function loadChart(limit = 10) {
        fetch(`/dashboard/chart-data?limit=${limit}`)
            .then(response => response.json())
            .then(data => {
                const timestamps = data.map(item => item.timestamp);
                const values = data.map(item => item[dataKey]);
                var options = {
                    chart: {
                        type: 'line',
                        height: 250,
                        toolbar: { show: false }
                    },
                    series: [{
                        name: seriesName,
                        data: values
                    }],
                    xaxis: {
                        categories: timestamps,
                        title: { text: 'Timestamp' },
                        labels: { rotate: -45 }
                    },
                    yaxis: {
                        title: { text: yTitle }
                    },
                    colors: [color],
                    stroke: {
                        curve: 'smooth',
                        width: 2
                    },
                    markers: {
                        size: 4
                    },
                    legend: {
                        position: 'top',
                        horizontalAlign: 'center'
                    }
                };
                if (chart) {
                    chart.updateOptions(options);
                } else {
                    chart = new ApexCharts(document.querySelector(`#${chartId}`), options);
                    chart.render();
                }
            });
    }

    // Fungsi untuk update chart
    function updateChart() {
        const select = document.getElementById(selectId);
        loadChart(select.value);
    }

    document.addEventListener('DOMContentLoaded', function() {
        const select = document.getElementById(selectId);
        loadChart(select.value);
        select.addEventListener('change', function() {
            loadChart(this.value);
        });
    });

    return updateChart;
}

// Simpan referensi fungsi update untuk setiap chart
const updateCharts = {
    moisture1: renderSensorChart('moisture1Chart', 'dataLimitMoisture1', 'moisture1', '#007bff', { seriesName: 'Moisture 1 (%)', yTitle: 'Moisture 1 (%)' }),
    moisture2: renderSensorChart('moisture2Chart', 'dataLimitMoisture2', 'moisture2', '#17a2b8', { seriesName: 'Moisture 2 (%)', yTitle: 'Moisture 2 (%)' }),
    temperature: renderSensorChart('temperatureChart', 'dataLimitTemperature', 'temperature', '#ff5733', { seriesName: 'Temperature (°C)', yTitle: '°C' }),
    humidity: renderSensorChart('humidityChart', 'dataLimitHumidity', 'humidity', '#28a745', { seriesName: 'Humidity (%)', yTitle: 'Humidity (%)' }),
    lux: renderSensorChart('luxChart', 'dataLimitLux', 'lux', '#ffc107', { seriesName: 'Light intencity (lux)', yTitle: 'lux' }),
    rain: renderSensorChart('rainChart', 'dataLimitRain', 'rain', '#6c757d', { seriesName: 'Rain (%)', yTitle: 'Rain (%)' })
};

function renderS3Chart(chartId, selectId, dataKey, color, labelCfg) {
    labelCfg = labelCfg || {};
    const seriesName = labelCfg.seriesName || dataKey;
    const yTitle = labelCfg.yTitle || seriesName;
    let chart;
    function loadChart(limit = 10) {
        fetch(`/dashboard/s3-chart-data?limit=${limit}`)
            .then(response => response.json())
            .then(data => {
                const timestamps = data.map(item => item.timestamp);
                const values = data.map(item => {
                    let val = item[dataKey];
                    if (val === null || val === undefined || val === '' || isNaN(val)) {
                        return null;
                    }
                    return Number(val);
                });
                var options = {
                    chart: { type: 'line', height: 200, toolbar: { show: false } },
                    series: [{ name: seriesName, data: values }],
                    xaxis: { categories: timestamps, title: { text: 'Timestamp' }, labels: { rotate: -45 } },
                    yaxis: { title: { text: yTitle } },
                    colors: [color],
                    stroke: { curve: 'smooth', width: 2 },
                    markers: { size: 4 },
                    legend: { position: 'top', horizontalAlign: 'center' }
                };
                if (chart) {
                    chart.updateOptions(options);
                } else {
                    chart = new ApexCharts(document.querySelector(`#${chartId}`), options);
                    chart.render();
                }
            });
    }

    // Fungsi untuk update chart
    function updateChart() {
        const select = document.getElementById(selectId);
        loadChart(select.value);
    }

    document.addEventListener('DOMContentLoaded', function() {
        const select = document.getElementById(selectId);
        loadChart(select.value);
        select.addEventListener('change', function() {
            loadChart(this.value);
        });
    });

    return updateChart;
}

// Simpan referensi fungsi update untuk setiap chart S3
const updateS3Charts = {
    temperature: renderS3Chart('s3TemperatureChart', 'dataLimitS3Temperature', 'temperature', '#ff5733', { seriesName: 'Temperature (°C)', yTitle: '°C' }),
    moisture: renderS3Chart('s3MoistureChart', 'dataLimitS3Moisture', 'moisture', '#17a2b8', { seriesName: 'Moisture (%)', yTitle: 'Moisture (%)' }),
    ph: renderS3Chart('s3PhChart', 'dataLimitS3Ph', 'ph', '#28a745', { seriesName: 'pH (H⁺)', yTitle: 'pH (H⁺)' }),
    conductivity: renderS3Chart('s3ConductivityChart', 'dataLimitS3Conductivity', 'conductivity', '#ffc107', { seriesName: 'Conductivity (s/m)', yTitle: 's/m' }),
    nitrogen: renderS3Chart('s3NitrogenChart', 'dataLimitS3Nitrogen', 'nitrogen', '#007bff', { seriesName: 'Nitrogen (mg/kg)', yTitle: 'mg/kg' }),
    phosphorus: renderS3Chart('s3PhosphorusChart', 'dataLimitS3Phosphorus', 'phosphorus', '#6c757d', { seriesName: 'Phosphorus (mg/kg)', yTitle: 'mg/kg' }),
    potassium: renderS3Chart('s3PotassiumChart', 'dataLimitS3Potassium', 'potassium', '#343a40', { seriesName: 'Potassium (mg/kg)', yTitle: 'mg/kg' })
};

function updateDashboardCards() {
    // Fetch for SensorValue
    fetch('/api/sensor/last')
        .then(res => res.json())
        .then(data => {
            if (data) {
                document.getElementById('dashboard-moisture1').innerText = (data.moisture1 != null && data.moisture1 !== '') ? data.moisture1 + '%' : '-';
                document.getElementById('dashboard-moisture2').innerText = (data.moisture2 != null && data.moisture2 !== '') ? data.moisture2 + '%' : '-';
                document.getElementById('dashboard-temperature').innerText = data.temperature + '°C';
                document.getElementById('dashboard-humidity').innerText = data.humidity + '%';
                document.getElementById('dashboard-lux').innerText = (data.lux != null && data.lux !== '') ? data.lux + ' lux' : '-';
                document.getElementById('dashboard-rain').innerText = (data.rain != null && data.rain !== '') ? data.rain + '%' : '-';
                document.getElementById('dashboard-timestamp').innerText = data.timestamp;

                // Update semua grafik sensor
                Object.values(updateCharts).forEach(updateChart => updateChart());
            }
        }).catch(error => console.error('Error fetching sensor data:', error));

    // Fetch for SensorS3
    fetch('/api/sensor-s3/last')
        .then(res => res.json())
        .then(data => {
            if (data) {
                document.getElementById('dashboard-s3-temperature').innerText = data.temperature + '°C';
                document.getElementById('dashboard-s3-moisture').innerText = (data.moisture != null && data.moisture !== '') ? data.moisture + '%' : '-';
                document.getElementById('dashboard-s3-ph').innerText = (data.ph != null && data.ph !== '') ? data.ph + ' H⁺' : '-';
                document.getElementById('dashboard-s3-conductivity').innerText = (data.conductivity != null && data.conductivity !== '') ? data.conductivity + ' s/m' : '-';
                document.getElementById('dashboard-s3-nitrogen').innerText = (data.nitrogen != null && data.nitrogen !== '') ? data.nitrogen + ' mg/kg' : '-';
                document.getElementById('dashboard-s3-phosphorus').innerText = (data.phosphorus != null && data.phosphorus !== '') ? data.phosphorus + ' mg/kg' : '-';
                document.getElementById('dashboard-s3-potassium').innerText = (data.potassium != null && data.potassium !== '') ? data.potassium + ' mg/kg' : '-';
                document.getElementById('dashboard-s3-timestamp').innerText = data.timestamp;

                // Update semua grafik sensor S3
                Object.values(updateS3Charts).forEach(updateChart => updateChart());
            }
        }).catch(error => console.error('Error fetching sensor S3 data:', error));
}

document.addEventListener('DOMContentLoaded', function() {
    // Initial fetch
    updateDashboardCards();

    // Poll every 2 seconds
    setInterval(updateDashboardCards, 2000);

    feather.replace();
});
</script>
@endpush 