<?php

namespace App\Http\Controllers;

use App\Exports\PelanggaranExport;
use App\Exports\PelanggaranExportProdi;
use App\Exports\PelanggaranProdiExport;
use App\Exports\PelanggaranPerProdiExport;
use App\Exports\PelanggaranDetailPerProdiExport;
use App\Exports\PelanggaranDetailExport;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\DaftarPelanggaran;
use Illuminate\Support\Facades\Storage;
use App\Models\Item;
use App\Models\Mahasiswa;
use App\Models\Pelanggaran;
use App\Models\ProgramStudi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PDF;
use PhpParser\Node\Expr\FuncCall;
use RealRashid\SweetAlert\Facades\Alert;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $auth = Auth()->user();
        $daftar_pelanggaran = DaftarPelanggaran::where('id_prodi', $auth->id_prodi)->with('mahasiswa', 'user', 'pelanggaran', 'item')->paginate(10);
        if ($auth->role === 'SuperAdmin') {
            $daftar_pelanggaran = DaftarPelanggaran::with('mahasiswa', 'user', 'pelanggaran', 'item')->paginate(10);
        }
        // return view('mahasiswa.data-mahasiswa', compact('daftar_pelanggaran'));


        return view('mahasiswa.data-mahasiswa', compact('daftar_pelanggaran'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $program_studi = ProgramStudi::all();
        $pelanggaran = Pelanggaran::all();
        $item = Item::all();
        $user = User::all();
        $id_user = Auth::user()->id;
        $nama_user = Auth::user()->name;
        return view('mahasiswa.create-mahasiswa', compact('pelanggaran', 'item', 'id_user', 'nama_user', 'program_studi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = str_replace('data:image/png;base64,', '', $request->foto);
        $image = str_replace(' ', '+', $image);
        $imageName = Str::random(10) . '.' . 'png';

        $rules = [
            'name' => 'required',
            'nim' => 'required|min:12',
            'id_prodi' => 'required',
            'id_user' => 'required',
            'id_pelanggaran' => 'required',
            'id_item' => 'required',
            'foto' => 'required',
        ];

        $text = [
            'id_prodi.required' => 'Program Studi harus diisi.',
            'id_user.required' => 'Penanggungjawab harus diisi.',
            'id_pelanggaran.required' => 'Jenis Pelanggaran harus diisi.',
            'id_item.required' => 'Pilih dokumen yang akan disita.',
            'name.required' => 'Nama Mahasiswa harus diisi.',
            'nim.required' => 'NIM harus diisi.',
            'nim.min' => 'Minimal nim adalah 12 angka.',
            'foto.required' => 'Ambil gambar mahasiswa terlebih dahulu.',

        ];

        $request->validate($rules, $text);

        $nim = $request->nim;

        $mahasiswaLength = Mahasiswa::where('nim', $nim)->count();
        if ($mahasiswaLength > 0) {
            // dd();
            $id = Mahasiswa::where('nim', $nim)->first()->id;
        } else {
            // create mahasiswa
            $mahasiswa = Mahasiswa::create([
                'name' => $request->name,
                'nim' => $request->nim,
                'id_prodi' => $request->id_prodi,
            ]);

            // get 1 data mahasiswa paling baru
            $mahasiswa_get = Mahasiswa::orderBy('id', 'desc')->limit(1)->first();
            $id = $mahasiswa_get->id;
        }
        // dd($mahasiswa);

        // create daftar pelanggaran
        // taruh id dari mhs terbaru
        $daftar_pelanggaran = DaftarPelanggaran::create([
            'id_mahasiswa' => $id,
            'id_pelanggaran' => $request->id_pelanggaran,
            'id_user' => $request->id_user,
            'id_item' => $request->id_item,
            'id_prodi' => $request->id_prodi,
            'foto' => $imageName,
        ]);

        if ($daftar_pelanggaran) {
            Storage::disk('public')->put($imageName, base64_decode($image));
            Alert::toast('Berhasil menambahkan data pelanggaran.', 'success');
            return redirect()->route('mahasiswa.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function show(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        //
    }

    public function detailReport(Request $request)
    {
        $program_studi = ProgramStudi::all();
        $id_prodi = $request->input('search');


        if (Auth()->user()->role === "Admin") {
            $pelanggaran = DaftarPelanggaran::withTrashed()->where('id_prodi', Auth()->user()->id_prodi)->groupBy('id_pelanggaran')
                ->select('id_pelanggaran', DB::raw('count(*) as jumlah'))
                ->get();
        } else if (Auth()->user()->role === "SuperAdmin") {
            if ($request->input('id')) {
                $pelanggaran = DaftarPelanggaran::withTrashed()->where('id_prodi', $request->input('id'))->groupBy('id_pelanggaran')
                    ->select('id_pelanggaran', DB::raw('count(*) as jumlah'))
                    ->with('pelanggaran')->get();

                return json_encode($pelanggaran);
            }
            $pelanggaran = DaftarPelanggaran::withTrashed()->groupBy('id_pelanggaran')
                ->select('id_pelanggaran', DB::raw('count(*) as jumlah'))
                ->get();
        }

        return view('laporan.laporan-detail-prodi', compact('program_studi', 'pelanggaran'));
    }

    public function detailReportExport(Request $request)
    {
        if (Auth()->user()->role === "SuperAdmin") {
            $nama_prodi = ProgramStudi::where('id', $request->input('id_prodi'))->first();
            if ($request->input('id_prodi')) {
                return Excel::download(new PelanggaranDetailPerProdiExport($request->input('id_prodi')), 
                        'pelanggaran-' . $nama_prodi->nama_prodi . '.xlsx');
            }
            return Excel::download(new PelanggaranDetailExport(), 'pelanggaran-all.xlsx');
        } else {
            return Excel::download(new PelanggaranDetailExport(), 'pelanggaran-' . 
                            Auth()->user()->program_studi->nama_prodi . '.xlsx');
        }
    }



    public function prodiReport()
    {

        $nama_prodi = ProgramStudi::all();
        $program_studi = DaftarPelanggaran::withTrashed()->groupBy('id_prodi')
                        ->select('id_prodi', DB::raw('count(*) as total'))->get();
        return view('laporan.laporan-prodi', compact('program_studi', 'nama_prodi'));
    }

    public function prodiReportExport()
    {
        return Excel::download(new PelanggaranProdiExport(), 'pelanggaran-all.xlsx');
    }

    public function mahasiswaReport(Request $request)
    {
        $prodi = ProgramStudi::all();
        if (Auth()->user()->role === "Admin") {
            $mahasiswa = DaftarPelanggaran::withTrashed()->where('id_prodi', Auth()->user()->id_prodi);
        } else if (Auth()->user()->role === "SuperAdmin") {
            if ($request->input('id')) {
                $mahasiswa = DaftarPelanggaran::withTrashed()->where('id_prodi', $request->input('id'))
                            ->with(['mahasiswa', 'mahasiswa.program_studi'])->groupBy('id_mahasiswa')
                            ->select('id_mahasiswa', DB::raw('count(*) as total'))->get();

                return json_encode($mahasiswa);
            }
            $mahasiswa = DaftarPelanggaran::withTrashed();
        }

        $mahasiswa = $mahasiswa->groupBy('id_mahasiswa')->select('id_mahasiswa', DB::raw('count(*) as total'))->get();

        // dd($mahasiswa);

        return view('laporan.laporan-mahasiswa', compact('mahasiswa', 'prodi'));
    }

    // Cetak laporan mahasiswa
    public function mahasiswaReportExport($prodi)
    {        
        if (Auth()->user()->role === "SuperAdmin") {
            return Excel::download(new PelanggaranExport(), 'pelanggaran-all.xlsx');
        } else {
            return Excel::download(new PelanggaranExport(), 'pelanggaran-' . $prodi . '.xlsx');
        }
    }

    // Cetak laporan mahasiswa
    public function mahasiswaPerProdiReportExport(Request $request)
    {
        $id_prodi = $request->input('id_prodi');
        $prodi = ProgramStudi::where('id', $id_prodi)->first();

        return Excel::download(new PelanggaranPerProdiExport($id_prodi), 'pelanggaran-' . $prodi->nama_prodi . '.xlsx');
    }

    // Cek data nim dan menampilkan data
    public function getByName(Request $request)
    {
        $nim = $request->input('nim');

        $mahasiswa = Mahasiswa::where('nim', $nim)->first();
        echo json_encode($mahasiswa);
    }

    public function destroyPelanggaran($id)
    {
        DaftarPelanggaran::where('id', $id)->delete();

        Alert::toast('Berhasil menghapus data pelanggaran.', 'success');
        return redirect()->route('mahasiswa.data');
    }
}
