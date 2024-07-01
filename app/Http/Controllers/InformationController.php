<?php

namespace App\Http\Controllers;

use App\Models\Information;
use Illuminate\Http\Request;
use Redirect;

class InformationController extends Controller
{
    public function index()
    {
        $infos = Information::all();
        return view('admin.info', compact('infos'));

    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'sekolah' => 'required',
                'email' => 'required',
                'pertemuan' => 'required',
                'logo' => 'image|mimes:jpeg,png,jpg|max:5120',
            ],
            [
                'name.required' => "Nama Harus Diisi",
                'sekolah.required' => "Sekolah Harus Diisi",
                'email.required' => "Email Harus Diisi",
                'pertemuan.required' => "Jumlah pertemuan Harus Diisi",
            ]
        );

        $info = new Information();
        $info->name = $request->input('name');
        $info->sekolah = $request->input('sekolah');
        $info->email = $request->input('email');
        $info->phone = $request->input('phone');
        $info->pertemuan = $request->input('pertemuan');

        if ($request->hasFile('logo')) {
            $logo = time() . '.' . $request->logo->extension();
            $request->logo->move(public_path('images/admin/logo'), $logo);
            $info->logo = 'images/admin/logo/' . $logo;
        }

        $info->save();

        return redirect()->route('admin.info')->with('success', 'Data Tersimpan');
    }

    public function edit(Request $request, Information $info)
    {
        $request->validate([
            'logo' => 'image|mimes:jpeg,png,jpg|max:5120',
        ]);

        if ($request->hasFile('logo')) {
            $logo = time() . '.' . $request->logo->extension();
            $uploadedImage = $request->logo->move(public_path('images/admin/logo'), $logo);
            $imagePath = 'images/admin/logo/' . $logo;

            $info->update(['logo' => $imagePath]);

            return redirect()->route('admin.info')->with('success', 'Logo berhasi diupdate');
        }

        return redirect()->route('admin.info')->with('error', 'Pembaruan data gagal');
    }


    public function update(Request $request, Information $info)
    {
        if ($request->ajax()) {
            $field = $request->name;
            $value = $request->value;

            $info->find($request->pk)->update([$field => $value]);
            return response()->json(['success' => true]);
        }
    }

}
