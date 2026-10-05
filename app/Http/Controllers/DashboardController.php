<?php

namespace App\Http\Controllers;

use App\Models\SensorValue;
use App\Models\SensorS3;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $latestSensor = SensorValue::latest('timestamp')->first();
        $latestSensorS3 = SensorS3::latest('timestamp')->first();
        return view('index', compact('latestSensor', 'latestSensorS3'));
    }

    public function getSensorChartData(Request $request)
    {
        $limit = $request->query('limit', 10);
        $data = SensorValue::orderBy('timestamp', 'desc')->take($limit)
            ->get(['timestamp', 'moisture1', 'moisture2', 'temperature', 'humidity', 'lux', 'rain']);
        $data = $data->reverse()->values();
        return response()->json($data);
    }

    public function getSensorS3ChartData(Request $request)
    {
        $limit = $request->query('limit', 10);
        $data = SensorS3::orderBy('timestamp', 'desc')->take($limit)
            ->get(['timestamp', 'temperature', 'moisture', 'ph', 'conductivity', 'nitrogen', 'phosphorus', 'potassium']);
        $data = $data->reverse()->values();
        return response()->json($data);
    }
} 