<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{

    // Auth
    public function login() {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->with('error','Email dan Password Salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function dataValidation($request)
    {
        $data = $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email:dns|unique:users',
            'password ' => 'required|min:6|confirmed',
            'role' => 'required',
        ]);
    }

    public function index() {
        $model = DB::table('users')->paginate(5);
        // $model = DB::table('users')->where('id', '!=', 1)->paginate(5);
        return view('master.m-pengguna.index', ['model' => $model]);
    }

    public function create() {
        return view('master.m-pengguna.create');
    }

    public function simpan(Request $request) {
        $request->validate([
            'nama' => ['required','string'],
            'email' => ['required','email:dns','unique:users'],
            'role' => ['required'],
            // 'password ' => ['required','min:6'],
        ]);

        DB::table('users')->insert([
            'nama' => $request->nama,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt($request->password),
            'created_at' => \Carbon\Carbon::now()
        ]);

        Alert::success('Berhasil', 'Pengguna berhasil disimpan.');

        return redirect('/pengguna');
    }

    public function edit($id) {
        $model = DB::table('users')->where('id', $id)->first();
        return view('master.m-pengguna.edit', ['model' => $model]);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email:dns|unique:users',
            'password ' => 'required|min:6|confirmed',
            'role' => 'required',
        ]);

        DB::table('users')->where('id', $id)->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'modified_at' => \Carbon\Carbon::now()
        ]);

        Alert::success('Berhasil', 'Data pengguna berhasil diubah.');

        return redirect('/pengguna');
    }

    public function delete($id) {
        DB::table('users')->where('id', $id)->delete();

        Alert::success('Berhasil', 'Pengguna berhasil dihapus.');

        return redirect('/pengguna');
    }

}
