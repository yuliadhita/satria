<?php

namespace App\Http\Controllers;

use App\Models\FormData;
use App\Models\DataStrategis;
use App\Models\Pegawai;

use Illuminate\Http\Request;

class KelolaController extends Controller
{
    // Controller Akun Belanja
    public function dataStrategis()
    {
        $formData = FormData::all();
        $dataStrategis = DataStrategis::all();
        return view('kelola.indikator.index', [
            'dataStrategis' => $dataStrategis,
            'formData' => $formData
        ]);
    }

    public function createDataStrategis()
    {
        $formData = FormData::all();
        $dataStrategis = dataStrategis::get();
        return view('kelola.indikator.create', ['dataStrategis' => $dataStrategis, 'formData' => $formData]);
    }

    public function storeDataStrategis(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
        ]);

        $dataStrategis = DataStrategis::create([
            'nama' => $request->nama,
            'icon' => $request->icon,
            'flag' => $request->flag ?? 1,
        ]);

        return redirect()->route('kelola.indikator.index')->with('success', 'Indikator berhasil ditambahkan.');
    }

    public function editDataStrategis($id)
    {
        $formData = FormData::all();
        $dataStrategis = DataStrategis::findOrFail($id);
        
        return view('kelola.indikator.edit', [
            'dataStrategis' => $dataStrategis,
            'formData' => $formData,
        ]);
    }
    

    public function update(Request $request, $id)
    {
        $dataStrategis = dataStrategis::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
        ]);

        $data = [
            'nama' => $request->nama,
            'icon' => $request->icon,
            'flag' => $request->flag ?? 1,
        ];

        $dataStrategis ->update($data);

        return redirect()->route('kelola.indikator.index')->with('success', 'Indikator berhasil diedit.');
    }

    
    // Controller Update Flag
    public function updateFlagDataStrategis(Request $request, $id)
    {
        $request->validate([
            'flag' => 'required|boolean',
        ]);

        $dataStrategis = DataStrategis::findOrFail($id);
        $dataStrategis->flag = $request->flag;
        $dataStrategis->save();

        return redirect()->back()->with('success', 'Indikator berhasil diperbarui.');
    }

   
}
