<?php

namespace App\Http\Controllers;

use App\Models\FormData;
use App\Models\DataStrategis;
use App\Enums\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class DashboardController extends Controller
{
    public function index()
    {
        // $user = auth()->user();
        // $email= $user->email;
        // $idRole = $user->id_role;

        // if ($idRole == 1) {
        //     $formPengajuan = FormPengajuan::where('nip_pengaju', $nipPengaju)->get();
        // } else {
        //     $formPengajuan = FormPengajuan::all();
        // }

        $formData = FormData::all();
        $dataStrategis = DataStrategis::all();

        $data = [
            'totalData' => $formData->count(),
            'totalIndikator' => $dataStrategis->where('flag', 1)->count()
        ];

        $chartData = [
            'labels' => ['Jumlah'],
            'totalData' => [$formData->count()],
            'totalIndikator' => [$dataStrategis->where('flag', 1)->count()],

        ];

        return view('dashboard', compact('data', 'chartData', 'formData'));
    }

}
