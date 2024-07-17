<?php

namespace App\Http\Controllers;

use App\Models\Information;
use App\Models\Jadwal;
use App\Models\Jurnal;
use App\Models\Periode;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function viewPdfguru(Request $request)
    {
        Carbon::setLocale('id'); // Set the locale to Indonesian

        $user = auth()->user();
        $periodes = Periode::where('status', 'active')->get();
        $selectperiode = $periodes->first();
        $id = null;
        foreach ($periodes as $p) {
            $id = $p->id;
        }

        $filter = $request->input('filter');
        $query = Jurnal::whereHas('jadwal', function ($query) use ($user, $id) {
            $query->where('user_id', $user->id)
                ->where('periode_id', $id);
        })->whereNotNull('materi')
            ->whereNotNull('sakit')
            ->whereNotNull('izin')
            ->whereNotNull('alpha')
            ->whereNotNull('foto')
            ->whereNotNull('is_validation')
            ->whereNotNull('ttd');

        switch ($filter) {
            case 'today':
                $query->whereDate('tanggal_jurnal', Carbon::today());
                break;
            case 'this_week':
                $query->whereBetween('tanggal_jurnal', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                break;
            case 'this_month':
                $query->whereBetween('tanggal_jurnal', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]);
                break;
            case 'custom':
                $startDate = $request->input('start_date');
                $endDate = $request->input('end_date');
                if ($startDate && $endDate) {
                    $query->whereBetween('tanggal_jurnal', [$startDate, $endDate]);
                }
                break;
        }

        $jurnals = $query->get();

        $infos = Information::all();
        $currentMonth = Carbon::now()->translatedFormat('F');

        $pdf = PDF::loadView('guru.jurnal.viewpdf', compact('jurnals', 'selectperiode', 'infos', 'currentMonth'))->setPaper('a4', 'landscape');

        if ($request->input('action') === 'download') {
            $fileName = $user->name . '_jurnal_' . $filter . '.pdf';
            return $pdf->download($fileName); // Download the PDF
        } else {
            return $pdf->stream(); // Output the PDF as stream
        }
    }

    public function exportPdfguru(Request $request)
    {
        Carbon::setLocale('id'); // Set the locale to Indonesian

        $user = auth()->user();
        $periodes = Periode::where('status', 'active')->get();
        $selectperiode = $periodes->first();
        $id = $selectperiode->id ?? null;

        $filter = $request->input('filter');
        $startOfMonth = Carbon::now()->startOfMonth()->toDateString();
        $endOfMonth = Carbon::now()->endOfMonth()->toDateString();

        switch ($filter) {
            case 'today':
                $startDate = Carbon::today()->toDateString();
                $endDate = Carbon::today()->toDateString();
                break;
            case 'this_week':
                $startDate = Carbon::now()->startOfWeek()->toDateString();
                $endDate = Carbon::now()->endOfWeek()->toDateString();
                break;
            case 'this_month':
                $startDate = $startOfMonth;
                $endDate = $endOfMonth;
                break;
            case 'custom':
                $startDate = $request->input('start_date');
                $endDate = $request->input('end_date');
                break;
            default:
                $startDate = $startOfMonth;
                $endDate = $endOfMonth;
                break;
        }

        $jurnals = Jurnal::whereHas('jadwal', function ($query) use ($user, $id) {
            $query->where('user_id', $user->id)
                ->where('periode_id', $id);
        })->whereNotNull('materi')
            ->whereNotNull('sakit')
            ->whereNotNull('izin')
            ->whereNotNull('alpha')
            ->whereNotNull('foto')
            ->whereNotNull('is_validation')
            ->whereNotNull('ttd')
            ->whereBetween('tanggal_jurnal', [$startDate, $endDate])
            ->get();

        $infos = Information::all();
        $currentMonth = Carbon::now()->translatedFormat('F');
        $waktu = Carbon::now()->translatedFormat('F_Y');

        $pdf = PDF::loadView('guru.jurnal.viewpdf', compact('jurnals', 'selectperiode', 'infos', 'currentMonth'))->setPaper('a4', 'landscape');

        $fileName = $user->name . '_jurnal_' . $filter . '.pdf';

        return $pdf->download($fileName); // Download the PDF file
    }

    public function viewJadwalguru(Request $request)
    {
        Carbon::setLocale('id'); // Set the locale to Indonesian

        $user = auth()->user();
        $periodes = Periode::where('status', 'active')->get();
        $selectperiode = $periodes->first();
        $id = null;
        foreach ($periodes as $p) {
            $id = $p->id;
        }

        $dayFilter = $request->input('day-filter');
        $classFilter = $request->input('class-filter');
        $jadwals = Jadwal::where('periode_id', $id)
            ->where('user_id', $user->id);

        if ($dayFilter === 'specific') {
            $date = Carbon::parse($request->input('date'));

            // Mapping of English day names to Indonesian day names
            $dayMap = [
                'Sunday' => 'Minggu',
                'Monday' => 'Senin',
                'Tuesday' => 'Selasa',
                'Wednesday' => 'Rabu',
                'Thursday' => 'Kamis',
                'Friday' => 'Jumat',
                'Saturday' => 'Sabtu',
            ];

            $dayName = $dayMap[$date->format('l')]; // Get the day name in Indonesian
            $jadwals = $jadwals->where('hari', ucfirst(strtolower($dayName)));
        }

        if ($classFilter !== 'all') {
            $jadwals = $jadwals->where('kelas_id', $classFilter);
        }

        $jadwals = $jadwals->get();

        $infos = Information::all();
        $currentMonth = Carbon::now()->translatedFormat('F');

        $pdf = PDF::loadView('guru.jadwal.viewpdf', compact('jadwals', 'selectperiode', 'infos', 'currentMonth'))->setPaper('a4', 'landscape');

        if ($request->input('action') === 'download') {
            $fileName = $user->name . '_jadwal_' . $classFilter . '.pdf';
            return $pdf->download($fileName); // Download the PDF
        } else {
            return $pdf->stream(); // Output the PDF as stream
        }
    }

    public function viewPdfadm(Request $request)
    {
        Carbon::setLocale('id'); // Set the locale to Indonesian

        $filter = $request->input('filter');
        $teacher = $request->input('teacher');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $periodes = Periode::where('status', 'active')->get();
        $selectperiode = $periodes->first();
        $id = $selectperiode->id;

        $query = Jurnal::whereHas('jadwal', function ($query) use ($id) {
            $query->where('periode_id', $id);
        })->whereNotNull('materi')
            ->whereNotNull('sakit')
            ->whereNotNull('izin')
            ->whereNotNull('alpha')
            ->whereNotNull('foto')
            ->whereNotNull('is_validation')
            ->whereNotNull('ttd');

        // Apply date filter
        if ($filter == 'today') {
            $query->whereDate('tanggal_jurnal', Carbon::today());
        } elseif ($filter == 'this_week') {
            $query->whereBetween('tanggal_jurnal', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        } elseif ($filter == 'this_month') {
            $query->whereBetween('tanggal_jurnal', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]);
        } elseif ($filter == 'custom' && $startDate && $endDate) {
            $query->whereBetween('tanggal_jurnal', [$startDate, $endDate]);
        }

        // Apply teacher filter
        if ($teacher != 'all') {
            $query->whereHas('jadwal', function ($query) use ($teacher) {
                $query->where('user_id', $teacher);
            });
        }

        $jurnals = $query->get();
        $infos = Information::all();
        $currentMonth = Carbon::now()->translatedFormat('F');

        $pdf = PDF::loadView('admin.jurnal.viewpdf', compact('jurnals', 'selectperiode', 'infos', 'currentMonth'))->setPaper('a4', 'landscape');

        $user = auth()->user();

        if ($request->input('action') === 'download') {
            $fileName = $user->name.'_jurnal_' . $filter . '.pdf';
            return $pdf->download($fileName); // Download the PDF
        } else {
            return $pdf->stream(); // Output the PDF as stream
        }
    }

    public function viewJadwaladm(Request $request)
    {
        Carbon::setLocale('id'); // Set the locale to Indonesian

        $periodes = Periode::where('status', 'active')->get();
        $selectperiode = $periodes->first();
        $id = null;
        foreach ($periodes as $p) {
            $id = $p->id;
        }

        $dayFilter = $request->input('day-filter');
        $date = $request->input('date');
        $classFilter = $request->input('class-filter');
        $guruFilter = $request->input('guru-filter'); // New filter for Guru

        $jadwals = Jadwal::where('periode_id', $id);

        if ($dayFilter === 'specific' && $date) {
            $date = Carbon::parse($date);

            // Mapping of English day names to Indonesian day names
            $dayMap = [
                'Sunday' => 'Minggu',
                'Monday' => 'Senin',
                'Tuesday' => 'Selasa',
                'Wednesday' => 'Rabu',
                'Thursday' => 'Kamis',
                'Friday' => 'Jumat',
                'Saturday' => 'Sabtu',
            ];

            $dayName = $dayMap[$date->format('l')]; // Get the day name in Indonesian
            $jadwals = $jadwals->where('hari', ucfirst(strtolower($dayName)));
        }

        if ($classFilter !== 'all') {
            $jadwals = $jadwals->where('kelas_id', $classFilter);
        }

        if ($guruFilter !== 'all') {
            $jadwals = $jadwals->where('user_id', $guruFilter);
        }

        $jadwals = $jadwals->get();

        $infos = Information::all();
        $currentMonth = Carbon::now()->translatedFormat('F');

        $pdf = PDF::loadView('admin.jadwal.viewpdf', compact('jadwals', 'selectperiode', 'infos', 'currentMonth'))->setPaper('a4', 'landscape');

        $user = auth()->user();
        
        if ($request->input('action') === 'download') {
            $fileName = $user->name.'_jadwal_' . $classFilter . '.pdf';
            return $pdf->download($fileName); // Download the PDF
        } else {
            return $pdf->stream(); // Output the PDF as stream
        }
    }


    public function exportPdfadm()
    {
        Carbon::setLocale('id'); // Set the locale to Indonesian

        // $user = auth()->user();
        $periodes = Periode::where('status', 'active')->get();
        $selectperiode = $periodes->first();
        $id = null;
        foreach ($periodes as $p) {
            $id = $p->id;
        }

        // Get the first and last day of the current month
        $startOfMonth = Carbon::now()->startOfMonth()->toDateString();
        $endOfMonth = Carbon::now()->endOfMonth()->toDateString();

        $jurnals = Jurnal::whereHas('jadwal', function ($query) use ($id, $startOfMonth, $endOfMonth) {
            $query->where('periode_id', $id);
        })->whereNotNull('materi')
            ->whereNotNull('sakit')
            ->whereNotNull('izin')
            ->whereNotNull('alpha')
            ->whereNotNull('foto')
            ->whereNotNull('is_validation')
            ->whereNotNull('ttd')
            ->whereBetween('tanggal_jurnal', [$startOfMonth, $endOfMonth])
            ->get();

        $infos = Information::all();
        $currentMonth = Carbon::now()->translatedFormat('F');
        $waktu = Carbon::now()->translatedFormat('F_Y');

        $pdf = PDF::loadView('admin.jurnal.viewpdf', compact('jurnals', 'selectperiode', 'infos', 'currentMonth'))->setPaper('a4', 'landscape');

        $fileName = 'jurnal_bulan_' . $waktu . '.pdf';

        return $pdf->download($fileName); // Download the PDF file
    }
}
