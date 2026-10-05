<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SensorValue extends Model
{
    use HasFactory;

    protected $table = 'sensor_values';
    protected $fillable = ['*'];
    public $timestamps = false;
} 