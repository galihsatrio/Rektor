<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class RescheduleController extends Controller
{
    public function index()
    {
        $query = DB::table('reschedule')
            ->select('reschedule.*', 'm-agenda.nama_agenda', 'm-agenda.keterangan_agenda', 'm-agenda.tempat', 'm-agenda.tanggal', 'm-agenda.jam')
            ->leftJoin('m-agenda', 'reschedule.agenda_id', '=', 'm-agenda.id');
            if(request('search')) {
                $query->where('m-agenda.nama_agenda', 'like', '%'.request('search').'%');
            }

        $model = $query->orderBy('reschedule.created_at', 'ASC')->paginate(10);

        return view('master.reschedule.index', ['model' => $model]);
    }

    public function approval($id, $status, $agenda_id)
    {
        if ($status == 'setuju') {
            $rs = DB::table('reschedule')->where('id', $id)->first();
            $agenda = DB::table('m-agenda')
                ->where('id', $agenda_id)
                ->update([
                    'tanggal' => $rs->tanggal,
                    'jam' => $rs->jam,
                    'modified_at' => \Carbon\Carbon::now()
                ]);

            $delete = DB::table('reschedule')->where('id', $id)->delete();

            Alert::success('Berhasil', 'Perubahan jadwal berhasil disetujui, tanggal dan jam agenda otomatis berubah.');
            return redirect('/reschedule');

        } else {
            $rs = DB::table('reschedule')->where('id', $id)->delete();

            Alert::success('Berhasil', 'Perubahan jadwal berhasil ditolak, data pengajuan akan terhapus otomatis.');
            return redirect('/reschedule');
        }
    }
}
