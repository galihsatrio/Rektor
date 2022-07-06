<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;


class DAgendaController extends Controller
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
        $model = DB::table('m-agenda')
            ->select('m-agenda.*', 'schedule.id as schedule_id', 'schedule.persetujuan as persetujuan')
            ->leftJoin('schedule', 'schedule.agenda_id', '=', 'm-agenda.id')
            // ->where('tanggal','>=',date('Y-m-d'))
            ->orderBy('tanggal', 'ASC')
            ->orderBy('jam', 'ASC')
            ->paginate(8);

        return view('master.daftar-agenda.index', ['model' => $model]);
    }

    public function detail($id) {
        $model = DB::table('m-agenda')->where('id', $id)->first();
        return view('master.daftar-agenda.detail', ['model' => $model]);
    }

    public function persetujuan($id, $status) {
        DB::table('schedule')->insert([
            'agenda_id' => $id,
            'persetujuan' => $status
        ]);

        if ($status == 0) {
            Alert::success('Berhasil', 'Agenda berhasil dibatalkan.');
        } else {
            Alert::success('Berhasil', 'Agenda berhasil disetujui.');
        }

        return redirect('/daftar-agenda');
    }

    public function reschedule(Request $request, $id) {

        $this->validate($request, [
            'tanggal' => 'required',
            'jam' => 'required',
            'alasan' => 'required',
        ]);

        DB::table('reschedule')->insert([
            'agenda_id' => $id,
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
            'alasan' => $request->alasan,
            'created_at' => \Carbon\Carbon::now()
        ]);

        Alert::success('Berhasil', 'Pengajuan agenda berhasil dikirim.');


        return redirect('/daftar-agenda');
    }
}
