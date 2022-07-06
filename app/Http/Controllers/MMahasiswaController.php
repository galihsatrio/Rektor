<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class MMahasiswaController extends Controller
{
    public function dataValidation($tipe, $request)
    {
        if($tipe == 'create') {
            $this->validate($request, [
                'nama' => 'required',
                'nim' => 'sometimes|required|numeric|unique:m-mahasiswa',
                'email_akademik' => 'required',
                'prodi' => 'required',
                'angkatan' => 'required',
            ]);
        } else {
            $this->validate($request, [
                'nama' => 'required',
                'nim' => 'sometimes|required|numeric',
                'email_akademik' => 'required',
                'prodi' => 'required',
                'angkatan' => 'required',
            ]);
        }
    }

    public function index() {
        $query = DB::table('m-mahasiswa');
        if(request('search')) {
            $query->where('nama', 'like', '%'.request('search').'%');
        }
        $model = $query->orderBy('nim', 'ASC')->paginate(10);
        return view('master.m-mahasiswa.index', ['model' => $model]);
    }

    public function create() {
        return view('master.m-mahasiswa.create');
    }

    public function simpan(Request $request) {
        $this->dataValidation('create', $request);
        DB::table('m-mahasiswa')->insert([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'email_akademik' => $request->email_akademik,
            'prodi' => $request->prodi,
            'angkatan' => $request->angkatan,
            'created_at' => \Carbon\Carbon::now()
        ]);

        Alert::success('Berhasil', 'Data Mahasiswa berhasil disimpan.');

        return redirect('/mahasiswa');
    }

    public function edit($id) {
        $model = DB::table('m-mahasiswa')->where('id', $id)->first();
        return view('master.m-mahasiswa.edit', ['model' => $model]);
    }

    public function update(Request $request, $id) {
        $this->dataValidation('update', $request);
        $validasi = DB::table('m-mahasiswa')->where('id', '!=', $id)->where('nim', '=', $request->nim)->first();
        if ($validasi == null) {
            DB::table('m-mahasiswa')->where('id', $id)->update([
                'nama' => $request->nama,
                'nim' => $request->nim,
                'email_akademik' => $request->email_akademik,
                'prodi' => $request->prodi,
                'angkatan' => $request->angkatan,
                'modified_at' => \Carbon\Carbon::now()
            ]);
            Alert::success('Berhasil', 'Data Mahasiswa berhasil diubah.');
            return redirect('/mahasiswa');
        } else {
            Alert::warning('Gagal', 'NIM sudah terpakai.');
            return redirect('/mahasiswa');
        }

    }

    public function delete($id) {
        DB::table('m-mahasiswa')->where('id', $id)->delete();

        Alert::success('Berhasil', 'Data Mahasiswa berhasil dihapus.');

        return redirect('/mahasiswa');
    }
}
