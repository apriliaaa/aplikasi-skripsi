<?php

namespace App\Exports;

use App\Models\DaftarPelanggaran;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;

class PelanggaranProdiExport implements FromView
{
    public function view(): View
    {
        $program_studi = DaftarPelanggaran::withTrashed()->groupBy('id_prodi')->select('id_prodi', DB::raw('count(*) as total'))->get();

        return view('laporan.laporan-prodi-export', compact('program_studi'));
    }
}
