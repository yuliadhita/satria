<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormData;
use App\Models\DataStrategis;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FormDataExport;

class HomeDataController extends Controller
{
    public function index(Request $request)
    {
        // $user = auth()->user();
        // $nipPengaju = $user->nip_lama;
        // $idRole = $user->id_role;

        $dataStrategis = DataStrategis::where('flag', 1)->get();

        // Ambil parameter tanggal mulai dan tanggal akhir dari request
        $tanggalMulai = $request->input('tanggal_mulai');
        $tanggalAkhir = $request->input('tanggal_akhir');
        $dataStrategisFilter = $request->input('dataStrategis');

        $query = FormData::query();

        // Filter berdasarkan tanggal mulai
        if ($tanggalMulai) {
            $query->whereDate('tanggal_input', '>=', $tanggalMulai);
        }

        // Filter berdasarkan tanggal akhir
        if ($tanggalAkhir) {
            $query->whereDate('tanggal_input', '<=', $tanggalAkhir);
        }

        // Filter berdasarkan indikator (jika ada)
        // Filter berdasarkan indikator (jika ada) yang memiliki flag = 1
    if ($dataStrategisFilter) {
        $query->whereHas('dataStrategis', function($query) use ($dataStrategisFilter) {
            $query->where('nama', $dataStrategisFilter)
                  ->where('flag', 1); // Filter data strategis berdasarkan flag = 1
        });
    } else {
        // Filter default untuk indikator dengan flag = 1
        $query->whereHas('dataStrategis', function($query) {
            $query->where('flag', 1);
        });
    }

        
        $formData = $query->get();

        return view('data', [
            'formData' => $formData,
            'dataStrategis' => $dataStrategis,
        ]);
    }

    public function download(Request $request)
    {
        $selectedIds = $request->input('selected_ids');
        $format = $request->input('format', 'csv');
        $tanggalMulai = $request->input('tanggal_mulai');
        $tanggalAkhir = $request->input('tanggal_akhir');
        $dataStrategisFilter = $request->input('dataStrategis');


        if (!$selectedIds || empty($selectedIds)) {
            return back()->with('error', 'Pilih setidaknya satu data untuk diunduh.');
        }

        // Ambil data berdasarkan filter yang dipilih
        $query = FormData::with(['dataStrategis', 'user'])
                     ->whereIn('id', $selectedIds)
                     ->whereHas('dataStrategis', function($query) {
                         $query->where('flag', 1); // Tambahkan filter flag = 1
        });
        // Filter berdasarkan tanggal mulai
        if ($tanggalMulai) {
            $query->whereDate('tanggal_input', '>=', $tanggalMulai);
        }

        // Filter berdasarkan tanggal akhir
        if ($tanggalAkhir) {
            $query->whereDate('tanggal_input', '<=', $tanggalAkhir);
        }

        // Filter berdasarkan indikator
        if ($dataStrategisFilter) {
            $query->whereHas('dataStrategis', function($query) use ($dataStrategisFilter) {
                $query->where('nama', $dataStrategisFilter);
            });
        }

        // Ambil data yang sudah difilter
        $data = $query->get();

        $csvHeader = [
            'No','Indikator','Nilai','Satuan','Periode','Link Publikasi'
        ];

        $csvData = [];
        foreach ($data as $index => $item) {
        $dataStrategis = $item->dataStrategis;
        $csvData[] = [
            $index + 1, // Auto-incrementing number (starting from 1)
            $item->dataStrategis?->nama ?? '',
            $item->nilai,
            $item->satuan,
            $item->periode,
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
