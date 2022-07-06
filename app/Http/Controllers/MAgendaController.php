<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class MAgendaController extends Controller
{
    public function dataValidation($request)
    {
        $this->validate($request, [
            'nama_agenda' => 'required',
            'tempat' => 'required',
            'keterangan_agenda' => 'required',
            'tanggal' => 'required',
            'jam' => 'required',
            'status' => 'required',
        ]);
    }

    public function index() {
        $model = DB::table('m-agenda')->paginate(8);
        // dd($model);
        return view('master.m-agenda.index', ['model' => $model]);
    }

    public function create() {
        return view('master.m-agenda.create');
    }

    public function simpan(Request $request) {
        $this->dataValidation($request);
        DB::table('m-agenda')->insert([
            'nama_agenda' => $request->nama_agenda,
            'tempat' => $request->tempat,
            'keterangan_agenda' => $request->keterangan_agenda,
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
            'status' => $request->status,
            'created_at' => \Carbon\Carbon::now(),
        ]);

        Alert::success('Berhasil', 'Agenda berhasil disimpan.');

        return redirect('/agenda');
    }

    public function edit($id) {
        $model = DB::table('m-agenda')->where('id', $id)->first();
        return view('master.m-agenda.edit', ['model' => $model]);
    }

    public function update(Request $request, $id) {
        $this->dataValidation($request);
        DB::table('m-agenda')->where('id', $id)->update([
            'nama_agenda' => $request->nama_agenda,
            'tempat' => $request->tempat,
            'keterangan_agenda' => $request->keterangan_agenda,
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
            'status' => $request->status,
            'modified_at' => \Carbon\Carbon::now()
        ]);

        Alert::success('Berhasil', 'Agenda berhasil diubah.');

        return redirect('/agenda');
    }

    public function delete($id) {
        DB::table('m-agenda')->where('id', $id)->delete();

        Alert::success('Berhasil', 'Agenda berhasil dihapus.');

        return redirect('/agenda');
    }
}
