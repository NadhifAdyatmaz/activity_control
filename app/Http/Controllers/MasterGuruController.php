<?php

namespace App\Http\Controllers;

use App\Models\Information;
use App\Models\Jadwal;
use App\Models\Jurnal;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Redirect;
use Symfony\Component\HttpKernel\Profiler\Profile;
use Illuminate\Validation\Rules;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;


class MasterGuruController extends Controller
{
    public function index()
    {
        $gurus = User::all();
        foreach ($gurus as $guru) {
            $guru->jadwal_count = Jadwal::where('user_id', $guru->id)->count();
            $guru->jurnal_count = Jurnal::whereHas('jadwal', function($query) use ($guru) {
                $query->where('user_id', $guru->id);
            })->count();
        }
        $infos = Information::all();
        return view('admin.masterdata.guru.index', compact('gurus','infos'));
        
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if ($request->role === 'kepsek' && User::where('role', 'kepsek')->exists()) {
            // Redirect back with an error message
            return Redirect::route('admin.masterdata.guru')
                ->with('error', 'Kepala sekolah sudah ada.');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        event(new Registered($user));

        // Auth::login($user);

        // return redirect(RouteServiceProvider::home());

        return Redirect::route('admin.masterdata.guru')->with('success', 'Data Tersimpan');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        try {
            Excel::import(new UsersImport, $request->file('file')->store('temp'));
            return Redirect::route('admin.masterdata.guru')->with('success', 'Data imported successfully');
        } catch (\Exception $e) {
            Log::error('Import Error: ' . $e->getMessage());
            return Redirect::route('admin.masterdata.guru')->with('error', 'There was an error importing the data.');
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return Redirect::route('admin.masterdata.guru')->with('success', 'Data Terhapus');
    }
}
