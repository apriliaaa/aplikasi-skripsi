<?php

namespace App\Http\Controllers;

use App\Models\ProgramStudi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;


class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $auth = Auth()->user();
        $dosen = User::where([['role', 'Dosen'], ['id_prodi', $auth->id_prodi]])->paginate(10);

        if ($auth->role === 'SuperAdmin') {
            $dosen = User::where('role', 'Dosen')->paginate(10);
        }
        return view('dosen.data-dosen', compact('dosen'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // memanggil data program studi
        $program_studi = ProgramStudi::all();
        return view('dosen.create-dosen', compact('program_studi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // create validate
        $rules = [
            'id_prodi' => 'required',
            'role' => 'required',
            'name' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:8',
        ];

        $text = [
            'id_prodi.required' => 'Program Studi harus diisi.',
            'role' => 'required',
            'name.required' => 'Nama Admin harus diisi.',
            'email.required' => 'Email harus di isi.',
            'email.email' => 'Input yang anda masukan tidak sesuai format email.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal 8 karakter.',
        ];

        $request->validate($rules, $text);

        $dosen = User::create([
            'id_prodi' => $request->id_prodi,
            'role' => $request->role,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($dosen) {
            Alert::toast('Berhasil menambah dosen.', 'success');
            return redirect()->route('dosen.create');
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

        $program_studi = ProgramStudi::all();
        $dosen = User::with('program_studi')->findorfail($id);
        return view('dosen.edit-dosen', compact('dosen', 'program_studi'));
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
        $rules = [
            'role' => 'required',
        ];
        $text = [
            'role.required' => 'Jabatan harus diisi.',
        ];

        $request->validate($rules, $text);
        $dosen = User::findorfail($id);
        $dosen->update($request->all());
        Alert::toast('Berhasil mengubah jabatan.', 'success');
        return redirect()->route('dosen.data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dosen = User::findorfail($id);
        $dosen->delete();
        Alert::toast('Berhasil menghapus dosen.', 'success');
        return back();
    }
}
