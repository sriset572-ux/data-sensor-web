<?php

namespace App\Http\Controllers;

use App\Models\SensorS3;
use Illuminate\Http\Request;

class SensorS3Controller extends Controller
{
    public function index()
    {
        $sensorValues = SensorS3::all();
        $lastSensor = SensorS3::orderBy('timestamp', 'desc')->first();
        return view('sensor_s3', compact('sensorValues', 'lastSensor'));
    }

    public function getLastSensor()
    {
        $lastSensor = SensorS3::latest('timestamp')->first();
        return response()->json($lastSensor);
    }

    public function getAllSensor()
    {
        $allSensor = SensorS3::orderBy('timestamp', 'desc')->get();
        return response()->json($allSensor);
    }
} 