<?php

namespace App\Exports;

use App\Models\DaftarPelanggaran;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;

class PelanggaranDetailPerProdiExport implements FromView
{
    protected $id_prodi;

    function __construct($id_prodi)
    {
        $this->id_prodi = $id_prodi;
    }

    public function view(): View
    {

        $pelanggaran = DaftarPelanggaran::withTrashed()->where('id_prodi', $this->id_prodi)->groupBy('id_pelanggaran')
            ->select('id_pelanggaran', DB::raw('count(*) as jumlah'))
            ->get();



        return view('laporan.laporan-detail-prodi-export', compact('pelanggaran'));
    }
}
