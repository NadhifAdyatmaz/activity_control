<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Information;
use App\Models\Periode;
use Illuminate\Http\Request;
use App\Models\Jurnal;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GuruJurnalController extends Controller
{
    public function Gurujurnal()
    {
        $user = auth()->user();
        $periodes = Periode::where('status', 'active')->get();
        $selectperiode = $periodes->first();
        $id = null;
        foreach ($periodes as $p) {
            $id = $p->id;
        }
        $jurnals = Jurnal::whereHas('jadwal', function ($query) use ($user, $id) {
            $query->where('user_id', $user->id)->where('periode_id', $id);
        })->get();
        $infos = Information::all();
        return view('guru.jurnal.guru_jurnal', compact('jurnals', 'infos', 'selectperiode'));
        // return view('guru.guru_jurnal');
    }

    function insert(Request $request)
    {
        if ($request->ajax()) {
            $data = [
                'jadwal_id' => $request->jadwal_id ?? null,
                'name' => $request->name ?? null,
                'materi' => $request->materi ?? null,
                'sakit' => $request->sakit ?? null,
                'izin' => $request->izin ?? null,
                'alpha' => $request->alpha ?? null,
                'foto' => $request->foto ?? null,
                'catatan' => $request->catatan ?? null,
                'is_validation' => $request->is_validation ?? null,
                'updated_at' => $request->updated_at ?? null
            ];

            // Insert data ke database
            Jurnal::create($data);

            return response()->json([
                'success' => 'Data Tersimpan.'
            ]);
        }
    }

    public function edit(Request $request, Jurnal $jurnal)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        if ($request->hasFile('foto')) {
            $foto = time() . '.' . $request->foto->extension();
            $uploadedImage = $request->foto->move(public_path('images/guru/jurnal'), $foto);
            $imagePath = 'images/guru/jurnal/' . $foto;

            $jurnal->update(['foto' => $imagePath]);

            return redirect()->route('guru.jurnal')->with('success', 'foto berhasi diupdate');
        }

        return redirect()->route('guru.jurnal')->with('error', 'Pembaruan data gagal');
    }
    public function update(Request $request, Jurnal $jurnal)
    {
        if ($request->ajax()) {
            $field = $request->name;
            $value = $request->value;

            if ($value === null || $value === '') {
                return response()->json(['success' => false, 'error' => 'Field tidak boleh kosong.']);
            }

            $jurnal->find($request->pk)->update([$field => $value]);
            return response()->json(['success' => true]);
        }
    }

    public function sendTtd(Request $request, $id)
    {
        $jurnal = Jurnal::findOrFail($id);

        $request->validate([
            'signature' => 'required',
        ]);

        // Proses untuk menyimpan tanda tangan sebagai gambar
        $signature = $request->input('signature');
        $signature = preg_replace('/^data:image\/\w+;base64,/', '', $signature);
        $signatureData = base64_decode($signature);

        $fileName = 'ttd_' . uniqid() . '.png';
        $filePath = 'images/guru/ttd/' . $fileName;

        file_put_contents($filePath, $signatureData);

        // Update kolom ttd pada model Jurnal
        $jurnal->ttd = $filePath;
        $jurnal->save();

        return redirect()->route('guru.jurnal')->with('success', 'Tanda tangan berhasil disimpan.');
    }


    public function destroy(Jurnal $jurnal)
    {
        $jurnal->delete();

        return Redirect::route('guru.jurnal')->with('success', 'Data Terhapus');
    }

}

