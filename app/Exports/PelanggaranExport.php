<?php

namespace App\Exports;

use App\Models\DaftarPelanggaran;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;

class PelanggaranExport implements FromView
{
    public function view(): View
    {
        if (Auth()->user()->role === "Admin") {
            $mahasiswa = DaftarPelanggaran::withTrashed()->where('id_prodi', Auth()->user()->id_prodi);
        } else {
            $mahasiswa = DaftarPelanggaran::withTrashed();
        }

        $mahasiswa = $mahasiswa->groupBy('id_mahasiswa')->select('id_mahasiswa', DB::raw('count(*) as total'))->get();


        return view('laporan.laporan-mahasiswa-export', compact('mahasiswa'));
    }
}
