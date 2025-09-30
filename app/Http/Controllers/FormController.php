<?php

namespace App\Http\Controllers;

use App\Models\FormData;
use App\Models\DataStrategis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormController extends Controller
{
    public function index()
    {
        // Ambil semua form data dengan relasi data strategis & pegawai
        $formData = FormData::with(['dataStrategis','user'])->get();
        $dataStrategis = DataStrategis::all();


        return view('form.index', compact('formData', 'dataStrategis'));
    }

    public function store(Request $request)
    {
        try {
            // dd($request->all());
            $id_user = Auth::user()->id;

            $validated = $request->validate([
                'id_data' => 'required|exists:data_strategis,id_data',
                'nilai' => 'required|integer',
                'satuan' => 'required|string|max:50',
                'periode' => 'required|string|max:50',
                'link_publikasi' => 'nullable|string|max:255',
            ]);

            $validated['id_pegawai'] = $id_user;

            $formData = FormData::create($validated);

            return redirect()->route('download.index')
                ->with('success', 'Data berhasil ditambahkan.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.')
                ->withInput();
        }
    }


    public function edit($id)
    {
        $formData = FormData::findOrFail($id);
        $dataStrategis = DataStrategis::all();

        return view('form.edit', compact('formData', 'dataStrategis'));    
    }

    public function update(Request $request, $id)
    {
        $id_user = Auth::user()->id;

        $validated = $request->validate([
            'id_data' => 'required|exists:data_strategis,id_data',
            'nilai' => 'required|integer',
            'satuan' => 'required|string|max:50',
            'periode' => 'required|string|max:50',
            'link_publikasi' => 'nullable|string|max:255',
        ]);

        

        $formData = FormData::findOrFail($id);
        $formData->update($validated);

        return redirect()->route('download.index')
            ->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $formData = FormData::findOrFail($id);
        $formData->delete();

        return redirect()->route('download.index')
            ->with('success', 'Data berhasil dihapus.');
    }


    // public function markAsOpened($id)
    // {
    //     try {
    //         $formPengajuan = FormPengajuan::findOrFail($id);

    //         if (!$formPengajuan->is_opened) {
    //             $formPengajuan->update(['is_opened' => true]);
    //         }

    //         return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
    //     } catch (\Exception $e) {
    //         return response()->json(['success' => false, 'message' => 'Failed to update status.'], 500);
    //     }
    // }

}
