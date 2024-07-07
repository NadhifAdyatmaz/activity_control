<?php

namespace App\Http\Controllers;

use App\Models\Information;
use App\Models\Jurnal;
use App\Models\Periode;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function viewPdfguru()
    {
        Carbon::setLocale('id'); // Set the locale to Indonesian

        $user = auth()->user();
        $periodes = Periode::where('status', 'active')->get();
        $selectperiode = $periodes->first();
        $id = null;
        foreach ($periodes as $p) {
            $id = $p->id;
        }

        // Get the first and last day of the current month
        $startOfMonth = Carbon::now()->startOfMonth()->toDateString();
        $endOfMonth = Carbon::now()->endOfMonth()->toDateString();

        $jurnals = Jurnal::whereHas('jadwal', function ($query) use ($user, $id, $startOfMonth, $endOfMonth) {
            $query->where('user_id', $user->id)
                ->where('periode_id', $id)
                ->where('is_validation', 'valid');
        })
            ->whereBetween('tanggal_jurnal', [$startOfMonth, $endOfMonth])
            ->get();

        $infos = Information::all();
        $currentMonth = Carbon::now()->translatedFormat('F');

        $pdf = PDF::loadView('guru.jurnal.viewpdf', compact('jurnals', 'selectperiode', 'infos', 'currentMonth'))->setPaper('a4', 'landscape');

        return $pdf->stream(); // Output the PDF as stream
    }


    public function exportPdfguru()
    {
        Carbon::setLocale('id'); // Set the locale to Indonesian

        $user = auth()->user();
        $periodes = Periode::where('status', 'active')->get();
        $selectperiode = $periodes->first();
        $id = null;
        foreach ($periodes as $p) {
            $id = $p->id;
        }

        // Get the first and last day of the current month
        $startOfMonth = Carbon::now()->startOfMonth()->toDateString();
        $endOfMonth = Carbon::now()->endOfMonth()->toDateString();

        $jurnals = Jurnal::whereHas('jadwal', function ($query) use ($user, $id, $startOfMonth, $endOfMonth) {
            $query->where('user_id', $user->id)
                ->where('periode_id', $id)
                ->where('is_validation', 'valid');
        })
            ->whereBetween('tanggal_jurnal', [$startOfMonth, $endOfMonth])
            ->get();

        $infos = Information::all();
        $currentMonth = Carbon::now()->translatedFormat('F');
        $waktu = Carbon::now()->translatedFormat('F_Y');

        $pdf = PDF::loadView('guru.jurnal.viewpdf', compact('jurnals', 'selectperiode', 'infos', 'currentMonth'))->setPaper('a4', 'landscape');

        $fileName = $user->name . '_jurnal_bulan_' . $waktu . '.pdf';

        return $pdf->download($fileName); // Download the PDF file
    }

    public function viewPdfadm()
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
            $query->where('periode_id', $id)
                ->where('is_validation', 'valid');
        })
            ->whereBetween('tanggal_jurnal', [$startOfMonth, $endOfMonth])
            ->get();

        $infos = Information::all();
        $currentMonth = Carbon::now()->translatedFormat('F');

        $pdf = PDF::loadView('admin.jurnal.viewpdf', compact('jurnals', 'selectperiode', 'infos', 'currentMonth'))->setPaper('a4', 'landscape');

        return $pdf->stream(); // Output the PDF as stream
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

        $jurnals = Jurnal::whereHas('jadwal', function ($query) use ( $id, $startOfMonth, $endOfMonth) {
            $query->where('periode_id', $id)
                ->where('is_validation', 'valid');
        })
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
