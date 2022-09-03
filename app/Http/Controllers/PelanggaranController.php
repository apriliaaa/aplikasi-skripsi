<?php

namespace App\Http\Controllers;

use App\Models\Pelanggaran;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PelanggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pelanggaran = Pelanggaran::all();
        return view('pelanggaran.data-pelanggaran', compact('pelanggaran'));
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

        $rules = [
            'nama_pelanggaran' => 'required|unique:pelanggaran',
        ];

        $text = [
            'nama_pelanggaran.required' => 'Nama Program Studi harus diisi.',
            'nama_pelanggaran.unique' => 'Jenis pelanggaran yang anda masukan sudah ada.',
        ];

        $request->validate($rules, $text);

        $pelanggaran = Pelanggaran::create([
            'nama_pelanggaran' => $request->nama_pelanggaran,

        ]);

        if ($pelanggaran) {
            Alert::toast('Berhasil menambah data Jenis Pelanggaran.', 'success');
            return redirect()->route('pelanggaran');
        }
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
        $pelanggaran = Pelanggaran::findorfail($id);
        $pelanggaran->delete();
        Alert::toast('Berhasil menghapus data Jenis Pelanggaran.', 'success');
        return back();
    }
}
