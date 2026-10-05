<?php

namespace App\Http\Controllers;

use App\Models\SensorValue;
use Illuminate\Http\Request;

class SensorController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function sensor()
    {
        $sensorValues = SensorValue::all();
        $lastSensor = SensorValue::orderBy('timestamp', 'desc')->first();
        return view('sensor', compact('sensorValues', 'lastSensor'));
    }

    public function getSensorChartData(Request $request)
    {
        $limit = $request->query('limit', 10);
        $data = SensorValue::orderBy('timestamp', 'desc')->take($limit)
            ->get(['timestamp', 'moisture1', 'moisture2', 'temperature', 'humidity', 'lux', 'rain']);
        $data = $data->reverse()->values();
        return response()->json($data);
    }

    public function getLastSensor()
    {
        $lastSensor = \App\Models\SensorValue::latest('timestamp')->first();
        return response()->json($lastSensor);
    }

    public function getAllSensor()
    {
        $allSensor = \App\Models\SensorValue::orderBy('timestamp', 'desc')->get();
        return response()->json($allSensor);
    }
} 