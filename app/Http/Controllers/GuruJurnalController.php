<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jurnal;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class GuruJurnalController extends Controller
{
    public function Gurujurnal()
    {

        $jurnals = Jurnal::with('jadwal')->get();
        return view('guru.guru_jurnal', compact('jurnals'));
        // return view('guru.guru_jurnal');
    }

    // public function update(Request $request, Jurnal $jurnals)
    // {
    //     if ($request->ajax()) {
    //         $field = $request->name;
    //         $value = $request->value;

    //         $jurnals->find($request->pk)->update([$field => $value]);
    //         return response()->json(['success' => true]);
    //     }
    // }
    public function update(Request $request, Jurnal $jurnal)
{
    // Dapatkan objek Jurnal berdasarkan ID yang dikirimkan dalam request
    // $jurnal = Jurnal::findOrFail($request->id);

    // // Dump untuk debugging
    // dd($jurnal);

    // Validasi request jika diperlukan
    $validatedData = $request->validate([
        'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk file gambar
        // Tambahkan validasi untuk atribut lainnya jika diperlukan
    ]);

    if ($request->hasFile('photo')) {
        // Jika ada file gambar yang diunggah
        $photo = time() . '.' . $request->photo->extension();
        $uploadedImage = $request->photo->move(public_path('images/guru'), $photo);
        $imagePath = 'images/guru/' . $photo;

        // Simpan path gambar ke dalam atribut 'photo' dari model Jurnal
        $jurnal->photo = $imagePath;
    }

    // Update atribut-atribut lainnya yang diperbarui
    $jurnal->fill($request->all());
    $jurnal->save();

    // Redirect ke halaman yang sesuai setelah pembaruan berhasil
    return Redirect::route('guru.jurnal.edit')->with('status', 'success');
}

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ]);

    //     $image = $request->file('image');
    //     $imageName = time() . '.' . $image->getClientOriginalExtension();
    //     $image->move(public_path('images/guru'), $imageName);

    //     return response()->json(['success' => $imageName]);
    // }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    //     ]);

    //     $imagePath = $request->file('image')->store('images/guru', 'public');

    //     // Simpan data jurnal ke dalam database
    //     $jurnals = new Jurnal();
    //     $jurnals->foto = $imagePath; // Simpan nama file ke dalam kolom 'foto'
    //     // Tambahan logika lainnya sesuai kebutuhan
    //     $jurnals->save();

    //     // Return respons JSON sukses dengan nama file
    //     return response()->json(['success' => $imagePath]);
    // }


}

