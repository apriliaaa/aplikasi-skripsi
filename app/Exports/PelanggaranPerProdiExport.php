<?php

namespace App\Exports;

use App\Models\DaftarPelanggaran;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;

class PelanggaranPerProdiExport implements FromView
{
    protected $id_prodi;

    function __construct($id_prodi)
    {
        $this->id_prodi = $id_prodi;
    }

    public function view(): View
    {
        if (Auth()->user()->role === "SuperAdmin") {
            $mahasiswa = DaftarPelanggaran::withTrashed()->where('id_prodi', $this->id_prodi);

            $mahasiswa = $mahasiswa->groupBy('id_mahasiswa')->select('id_mahasiswa', DB::raw('count(*) as total'))->get();
            return view('laporan.laporan-mahasiswa-export', compact('mahasiswa'));
        }
    }
}
