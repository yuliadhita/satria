<?php

namespace App\Http\Controllers;

use App\Models\FormData;
use App\Models\DataStrategis;

class HomeController extends Controller
{
    public function index()
    {
        $indikator = DataStrategis::where('flag', 1)
            ->whereHas('formData') // hanya yang punya data di form_data
            ->with(['latestFormData' => function($q) {
                $q->orderBy('tanggal_input', 'desc');
            }])
            ->get();

        return view('home', compact('indikator'));
    }
}
