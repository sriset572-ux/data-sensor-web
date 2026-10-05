<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SensorValue;
use App\Models\SensorS3;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AnalysisController extends Controller
{
    public function index()
    {
        return view('analysis');
    }

    public function getAnfisData(Request $request)
    {
        try {
            // Ambil pilihan sumbu dari request
            $xAxis = $request->query('xAxis', 'nitrogen'); // Default Nitrogen
            $yAxis = $request->query('yAxis', 'phosphorus'); // Default Phosphorus

            // Validasi pilihan sumbu
            $allowedAxes = ['nitrogen', 'phosphorus', 'potassium'];
            if (!in_array($xAxis, $allowedAxes) || !in_array($yAxis, $allowedAxes) || $xAxis === $yAxis) {
                 return response()->json(['error' => 'Pilihan sumbu tidak valid. Sumbu X dan Y harus berbeda dan merupakan Nitrogen, Phosphorus, atau Potassium.'], 400);
            }

            // Definisi rentang dan jumlah titik untuk grid simulasi (sesuaikan jika perlu)
            // Rentang ini idealnya didasarkan pada rentang nilai input ANFIS Anda yang sebenarnya
            $range = [
                'nitrogen' => ['min' => 0, 'max' => 12],
                'phosphorus' => ['min' => 80, 'max' => 110],
                'potassium' => ['min' => 0, 'max' => 30]
            ];

            $n_points = 100; // Jumlah titik pada setiap sumbu grid (meningkatkan kerapatan untuk visual yang lebih halus)

            $x_min = $range[$xAxis]['min'];
            $x_max = $range[$xAxis]['max'];
            $y_min = $range[$yAxis]['min'];
            $y_max = $range[$yAxis]['max'];

            $x_grid = [];
            $y_grid = [];
            $output_grid = []; // Matrix Z untuk surface plot

            // Buat grid nilai untuk sumbu X dan Y yang dipilih
            $x_step = ($x_max - $x_min) / ($n_points - 1);
            $y_step = ($y_max - $y_min) / ($n_points - 1);

            for ($i = 0; $i < $n_points; $i++) {
                $current_y_value = $y_min + $i * $y_step;
                $y_grid[] = $current_y_value;
                $row_output = [];
                for ($j = 0; $j < $n_points; $j++) {
                    $current_x_value = $x_min + $j * $x_step;
                    if ($i === 0) { // Hanya tambahkan nilai X sekali
                         $x_grid[] = $current_x_value;
                    }

                    // --- Logika Simulasi Output ANFIS (GANTI DENGAN LOGIKA SEBENARNYA) ---
                    // Logika simulasi sekarang harus menerima nilai untuk sumbu X dan Y yang dipilih
                    // dan parameter N, P, K lainnya (kita akan menggunakan nilai rata-rata jika tidak dipilih)

                    $n_value = 0; $p_value = 0; $k_value = 0;

                    // Tetapkan nilai berdasarkan sumbu X dan Y yang dipilih
                    if ($xAxis === 'nitrogen') $n_value = $current_x_value;
                    elseif ($xAxis === 'phosphorus') $p_value = $current_x_value;
                    elseif ($xAxis === 'potassium') $k_value = $current_x_value;

                    if ($yAxis === 'nitrogen') $n_value = $current_y_value;
                    elseif ($yAxis === 'phosphorus') $p_value = $current_y_value;
                    elseif ($yAxis === 'potassium') $k_value = $current_y_value;

                    // Tetapkan nilai default (rata-rata rentang) untuk parameter yang tidak dipilih sebagai sumbu X atau Y
                    if ($xAxis !== 'nitrogen' && $yAxis !== 'nitrogen') $n_value = ($range['nitrogen']['min'] + $range['nitrogen']['max']) / 2;
                    if ($xAxis !== 'phosphorus' && $yAxis !== 'phosphorus') $p_value = ($range['phosphorus']['min'] + $range['phosphorus']['max']) / 2;
                    if ($xAxis !== 'potassium' && $yAxis !== 'potassium') $k_value = ($range['potassium']['min'] + $range['potassium']['max']) / 2;

                    // --- Logika Simulasi (ANDA HARUS GANTI INI DENGAN MODEL ANFIS ASLI) ---
                    // Contoh simulasi sederhana yang mencoba meniru bentuk grafik N-P-Output
                    // Logika ini hanya bergantung pada N dan P, mengabaikan K untuk simulasi ini.
                    // Anda perlu menyesuaikan ini agar sesuai dengan model ANFIS 3-input (N, P, K) Anda.

                    $simulated_output = 0;
                    if ($n_value < 5 && $p_value < 95) {
                         $simulated_output = 20 + ($n_value * 3) + (($p_value - 80) * 2);
                    } elseif ($n_value >= 5 && $n_value < 10 && $p_value >= 95) {
                         $simulated_output = 60 + (($n_value - 5) * 4) - (($p_value - 95) * 1);
                    } elseif ($n_value >= 10 && $p_value >= 95) {
                         $simulated_output = 80 + (($n_value - 10) * 2) + (($p_value - 95) * 0.5);
                    } else {
                         $simulated_output = 40 + ($n_value * 2) + (($p_value - 80) * 1.5);
                    }
                    // Batasi output agar tidak terlalu tinggi atau rendah
                    $simulated_output = max(0, min(100, $simulated_output));
                    // --- Akhir Logika Simulasi ---

                    $row_output[] = $simulated_output;
                }
                $output_grid[] = $row_output;
            }

            // Siapkan data untuk surface plot
            $anfis_surface_data = [
                'type' => 'surface',
                'x' => $x_grid,
                'y' => $y_grid,
                'z' => $output_grid,
                'colorscale' => 'Jet',
                'showscale' => true,
                'colorbar' => ['title' => 'Output ANFIS']
            ];

            return response()->json([$anfis_surface_data]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
} 