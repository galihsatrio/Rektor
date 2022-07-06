<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class MDosenController extends Controller
{
    public function dataValidation($tipe, $request)
    {
        if($tipe == 'create') {
            $this->validate($request, [
                'nama' => 'required',
                'nidn' => 'sometimes|required|numeric|unique:m-dosen',
                'prodi' => 'required',
                'jabatan_akademik' => 'required',
                'golongan_kepangkatan' => 'required',
                'status_kerja' => 'required',
                'mulai_aktif' => 'required',
                // 'selesai_aktif' => 'required',
            ]);
        } else {
            $this->validate($request, [
                'nama' => 'required',
                'nidn' => 'sometimes|required|numeric',
                'prodi' => 'required',
                'jabatan_akademik' => 'required',
                'golongan_kepangkatan' => 'required',
                'status_kerja' => 'required',
                'mulai_aktif' => 'required'
                // 'selesai_aktif' => 'required',
            ]);
        }
    }

    public function index() {
        $model = DB::table('m-dosen')->paginate(5);
        return view('master.m-dosen.index', ['model' => $model]);
    }

    public function create() {
        return view('master.m-dosen.create');
    }

    public function simpan(Request $request) {
        $this->dataValidation('create', $request);
        DB::table('m-dosen')->insert([
            'nama' => $request->nama,
            'nidn' => $request->nidn,
            'prodi' => $request->prodi,
            'jabatan_akademik' => $request->jabatan_akademik,
            'golongan_kepangkatan' => $request->golongan_kepangkatan,
            'status_kerja' => $request->status_kerja,
            'mulai_aktif' => $request->mulai_aktif,
            'selesai_aktif' => $request->selesai_aktif,
            'created_at' => \Carbon\Carbon::now()
        ]);

        Alert::success('Berhasil', 'Data Dosen berhasil disimpan.');

        return redirect('/dosen');
    }

    public function edit($id) {
        $model = DB::table('m-dosen')->where('id', $id)->first();
        return view('master.m-dosen.edit', ['model' => $model]);
    }

    public function update(Request $request, $id) {
        $this->dataValidation('update', $request);
        $validasi = DB::table('m-dosen')->where('id', '!=', $id)->where('nidn', '=', $request->nidn)->first();
        if ($validasi == null) {
            DB::table('m-dosen')->where('id', $id)->update([
                'nama' => $request->nama,
                'nidn' => $request->nidn,
                'prodi' => $request->prodi,
                'jabatan_akademik' => $request->jabatan_akademik,
                'golongan_kepangkatan' => $request->golongan_kepangkatan,
                'status_kerja' => $request->status_kerja,
                'mulai_aktif' => $request->mulai_aktif,
                'selesai_aktif' => $request->selesai_aktif,
                'modified' => \Carbon\Carbon::now()
            ]);
            Alert::success('Berhasil', 'Data Dosen berhasil diubah.');
            return redirect('/dosen');
        } else {
            Alert::warning('Gagal', 'NIDN sudah terpakai.');
            return redirect('/dosen');
        }

    }

    public function delete($id) {
        DB::table('m-dosen')->where('id', $id)->delete();

        Alert::success('Berhasil', 'Data Dosen berhasil dihapus.');

        return redirect('/dosen');
    }
}

