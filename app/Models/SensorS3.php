<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SensorS3 extends Model
{
    use HasFactory;

    protected $table = 'sensor_s3';
    protected $fillable = [
        'timestamp', 'temperature', 'moisture', 'ph', 'conductivity', 'nitrogen', 'phosphorus', 'potassium'
    ];
    public $timestamps = false;
} 