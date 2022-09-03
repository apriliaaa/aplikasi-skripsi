<?php

namespace App\Http\Controllers;

use App\Models\ProgramStudi;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule as ValidationRule;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $admin = User::where('name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('email', 'LIKE', '%' . $request->search . '%')
                ->orWhere('role', 'LIKE', '%' . $request->search . '%')
                ->paginate(10);
        } else {
            // $admin = User::with('program_studi')->paginate(10);
            // $admin   = DB::table('users')->where('role', 'Admin')->get();
            $admin = User::with('program_studi')->where('role', 'Admin')->paginate(10);
        }

        return view('admin.data-admin', compact('admin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $program_studi = ProgramStudi::all();
        return view('admin.create', compact('program_studi'));
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


        $admin = User::create([
            'id_prodi' => $request->id_prodi,
            'role' => $request->role,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($admin) {
            Alert::toast('Berhasil menambah admin baru.', 'success');
            return redirect()->route('admin.create');
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
        $admin = User::with('program_studi')->findorfail($id);
        return view('admin.edit-admin', compact('admin', 'program_studi'));
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

        $admin = User::findorfail($id);
        $admin->update($request->all());

        Alert::toast('Berhasil mengubah data admin.', 'success');
        return redirect()->route('admin.data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();

        Alert::toast('Berhasil menghapus admin.', 'success');
        return back();
    }

    public function updateUserInfo(Request $request)
    {
        $user = Auth()->user();

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', ValidationRule::unique('users')->ignore($user->id)],
        ];

        $text = [
            'name.required' => 'Nama harus diisi.',
            'email.required' => 'Email harus di isi.',
            'email.email' => 'Input yang anda masukan tidak sesuai format email.',
            'email.unique' => 'Email sudah terdaftar.',
        ];

        $request->validate($rules, $text);

        User::where('id', $user->id)->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);

        Alert::toast('Update user info berhasil', 'success');

        return redirect()->back();
    }

    public function updateUserAuth(Request $request)
    {
        $user = Auth()->user();

        if (!Hash::check($request->input('current_pass'), $user->password)) {
            Alert::toast('Password lama yang anda masukan salah.', 'warning');
            return redirect()->back();
        }

        $rules = [
            'current_pass' => ['required', 'string'],
            'new_pass' => ['required', 'string'],
            'confirm_pass' => ['required', 'string', 'same:new_pass'],
        ];

        $text = [
            'current_pass.required' => 'Password Lama harus diisi.',
            'new_pass.required' => 'Password baru harus diisi.',
            'confirm_pass.required' => 'Konfirmasi password harus di isi.',
            'confirm_pass.same' => 'Konfirmasi password baru tidak cocok.',
        ];

        $request->validate($rules, $text);

        User::where('id', $user->id)->update([
            'password' => Hash::make($request->input('new_pass')),
        ]);
        Alert::toast('Update user autentikasi berhasil', 'success');

        return redirect()->back();
    }
}
