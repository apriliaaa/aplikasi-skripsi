<?php

namespace App\Http\Controllers;

use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProgramStudiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prodi = ProgramStudi::all();
        return view('prodi.data-prodi', compact('prodi'));
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
            'nama_prodi' => 'required || unique:program_studi',
        ];

        $text = [
            'nama_prodi.required' => 'Nama Program Studi harus diisi.',
            'nama_prodi.unique' => 'Jenis pelanggaran yang anda masukan sudah ada.',
        ];

        $request->validate($rules, $text);

        $prodi = ProgramStudi::create([
            'nama_prodi' => $request->nama_prodi,

        ]);

        if ($prodi) {
            Alert::toast('Berhasil menambah data Program Studi.', 'success');
            return redirect()->route('prodi');
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
        $prodi = ProgramStudi::findorfail($id);
        $prodi->delete();
        Alert::toast('Berhasil menghapus data Program Studi.', 'success');
        return back();
    }
}
