<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormData;
use App\Models\DataStrategis;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FormDataExport;

class DownloadController extends Controller
{
    public function index(Request $request)
    {
        // $user = auth()->user();
        // $nipPengaju = $user->nip_lama;
        // $idRole = $user->id_role;

        $dataStrategis = DataStrategis::get();

        $tanggalInput = $request->input('tanggal_input');

        $query = FormData::query();

        if ($tanggalInput) {
            $query->whereDate('tanggal_input', $tanggalInput);
        }
        
        $formData = $query->get();

        return view('download.index', [
            'formData' => $formData,
            'dataStrategis' => $dataStrategis,
        ]);
    }

    public function download(Request $request)
    {
        $selectedIds = $request->input('selected_ids');
        $format = $request->input('format', 'csv');

        if (!$selectedIds || empty($selectedIds)) {
            return back()->with('error', 'Pilih setidaknya satu data untuk diunduh.');
        }

        $data = FormData::with(['dataStrategis', 'pegawai'])
            ->whereIn('id', $selectedIds)
            ->get();

        $csvHeader = [
            'No','Indikator','Nilai','Satuan','Periode','Tanggal Input','Link Publikasi'
        ];

        $csvData = [];
        foreach ($data as $item) {
            $dataStrategis = $item->dataStrategis;
            $csvData[] = [
                $item->dataStrategis?->nama ?? '',
                $item->nilai,
                $item->satuan,
                $item->periode,
                $item->tanggal_input,
                $item->link_publikasi,
            ];
              
        }

        $filenameBase = 'form_data_' . now()->format('YmdHis');

        if ($format === 'xlsx') {
            return Excel::download(new FormDataExport($csvData, $csvHeader), $filenameBase . '.xlsx');
        } else {
            $filename = $filenameBase . '.csv';
            $handle = fopen('php://temp', 'w');
            fputcsv($handle, $csvHeader);

            foreach ($csvData as $line) {
                fputcsv($handle, $line);
            }

            rewind($handle);
            $content = stream_get_contents($handle);
            fclose($handle);

            return Response::make($content, 200, [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => "attachment; filename=$filename",
            ]);
        }
    }
}
