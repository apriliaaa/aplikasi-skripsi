<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dokumen = Item::all();
        return view('dokumen.data-dokumen', compact('dokumen'));
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
            'nama_item' => 'required | unique:item',
        ];

        $text = [
            'nama_item.required' => 'Nama Program Studi harus diisi.',
            'nama_item.unique' => 'Dokumen yang anda masukan sudah ada.',
        ];

        $request->validate($rules, $text);

        $dokumen = Item::create([
            'nama_item' => $request->nama_item,

        ]);

        if ($dokumen) {
            Alert::toast('Berhasil menambah data Dokumen Sitaan.', 'success');
            return redirect()->route('dokumen');
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
        $dokumen = Item::findorfail($id);
        $dokumen->delete();
        Alert::toast('Berhasil menghapus data Dokumen Sitaan.', 'success');
        return back();
    }
}
