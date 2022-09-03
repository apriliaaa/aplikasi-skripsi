<?php

namespace App\Exports;

use App\Models\DaftarPelanggaran;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;

class PelanggaranDetailExport implements FromView
{


    public function view(): View
    {
        if (Auth()->user()->role === "SuperAdmin") {
            $pelanggaran = DaftarPelanggaran::withTrashed()->groupBy('id_pelanggaran')
                ->select('id_pelanggaran', DB::raw('count(*) as jumlah'))
                ->get();
        } else {
            $pelanggaran = DaftarPelanggaran::withTrashed()->where('id_prodi', Auth()->user()->id_prodi)->groupBy('id_pelanggaran')
                ->select('id_pelanggaran', DB::raw('count(*) as jumlah'))
                ->get();
        }


        return view('laporan.laporan-detail-prodi-export', compact('pelanggaran'));
    }
}
