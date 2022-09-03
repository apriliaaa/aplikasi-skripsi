<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\DaftarPelanggaran;
use App\Models\ProgramStudi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        // echo $DaftarPelanggaran;
        // dd();
        return view('dashboard');
    }

    public function getDataChart()
    {
        // $DaftarPelanggaran = DaftarPelanggaran::withTrashed()->get()->groupBy(function ($val) {
        //     return Carbon::parse($val->created_at)->format('M');
        // });
        $auth = Auth()->user();


        $total = DaftarPelanggaran::whereMonth('created_at', Carbon::now()->month)->withTrashed()->count();



        $prodi = ProgramStudi::with(['DaftarPelanggaran' => fn ($q) => $q->withTrashed()->whereYear('created_at', '=', date('Y'))])->get();

        $data = [
            'prodi' => $prodi,
            'total' => $total,
        ];

        echo json_encode($data);
    }

    public function getDataByProdiChart($namaprodi)
    {
        // $DaftarPelanggaran = DaftarPelanggaran::withTrashed()->get()->groupBy(function ($val) {
        //     return Carbon::parse($val->created_at)->format('M');

        $auth = Auth()->user();

        $total = DaftarPelanggaran::where('id_prodi', $auth->id_prodi)->whereMonth('created_at', Carbon::now()->month)->withTrashed()->count();


        // });
        $prodi = ProgramStudi::where('nama_prodi', $namaprodi)->with(['DaftarPelanggaran' => fn ($q) => $q->withTrashed()->whereYear('created_at', '=', date('Y'))])->get();

        $data = [
            'prodi' => $prodi,
            'total' => $total,
        ];
        echo json_encode($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
