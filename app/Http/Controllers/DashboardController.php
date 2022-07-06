<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index() {

        $sekarang = Carbon::now()->toDateString();
        $tanggal = [
            ['hari' => date("l", strtotime(' +1 day')), 'tanggal' => date('Y-m-d', strtotime(' +1 day'))],
            ['hari' => date("l", strtotime(' +2 day')), 'tanggal' => date('Y-m-d', strtotime(' +2 day'))] ,
            ['hari' => date("l", strtotime(' +3 day')), 'tanggal' => date('Y-m-d', strtotime(' +3 day'))] ,
            ['hari' => date("l", strtotime(' +4 day')), 'tanggal' => date('Y-m-d', strtotime(' +4 day'))] ,
            ['hari' => date("l", strtotime(' +5 day')), 'tanggal' => date('Y-m-d', strtotime(' +5 day'))] ,
            ['hari' => date("l", strtotime(' +6 day')), 'tanggal' => date('Y-m-d', strtotime(' +6 day'))] ,
            ['hari' => date("l", strtotime(' +7 day')), 'tanggal' => date('Y-m-d', strtotime(' +7 day'))] ,
        ];
        $data = [];
        $agenda = DB::table('m-agenda')
            ->select(DB::raw('count(*) as total_agenda, tanggal'))
            ->where('tanggal', '>', $sekarang)
            ->groupBy('tanggal')
            ->get();

        $mahasiswa = DB::table('m-mahasiswa')
            ->select(DB::raw('count(*) as total_mahasiswa, angkatan'))
            ->groupBy('angkatan')
            ->get();

        foreach ($tanggal as $key => $tg) {
            foreach($agenda as $ag) {
                if ($ag->tanggal == $tg['tanggal']) {
                    $tanggal[$key]['total_agenda'] = $ag->total_agenda;
                }
            }
        }

        foreach($tanggal as $key => $tg) {
            if (!isset($tg['total_agenda'])) {
                $tanggal[$key]['total_agenda'] = 0;
            }
        }

        $agd = $tanggal;

        $api_response = Http::get('http://kapasitasitdel.schcenter.com/api/aset');
        $response = json_decode($api_response);
        $fasilitas = $response;

        $dataAsset = [];

        // dd($fasilitas);

        if (!empty($fasilitas)) {
            // Merge Unit
            foreach($fasilitas->aset as $key => $aset) {
                foreach($fasilitas->unit as $unit) {
                    if ($aset->unit_id == $unit->id) {
                        $dataAsset[$key] = $aset;
                        $dataAsset[$key]->unit = $unit->nama;
                    }
                }
            }

            // Merge Kategori
            foreach($fasilitas->aset as $key => $aset) {
                foreach($fasilitas->kategori as $kategori) {
                    if ($aset->kategori_id == $kategori->id) {
                        $dataAsset[$key]->kategori = $kategori->nama;
                    }
                }
            }

            // Merge Gedung
            foreach($fasilitas->aset as $key => $aset) {
                foreach($fasilitas->gedung as $gedung) {
                    if ($aset->gedung_id == $gedung->id) {
                        $dataAsset[$key]->gedung = $gedung->nama;
                    }
                }
            }

            $dataGedung = []; $dataKategori = []; $dataUnit = [];

            foreach($fasilitas->gedung as $key => $gedung) {
                $dataGedung[$key] = $gedung;
                $totalGedung = 0;
                foreach($fasilitas->aset as $aset) {
                    if ($gedung->id == $aset->gedung_id) {
                        $dataGedung[$key]->aset = [$aset];
                        $totalGedung += count($dataGedung[$key]->aset);
                        $dataGedung[$key]->total_aset = $totalGedung;
                    }
                }
            }

            foreach($fasilitas->kategori as $key => $kategori) {
                $dataKategori[$key] = $kategori;
                $totalKategori = 0;
                foreach($fasilitas->aset as $aset) {
                    if ($kategori->id == $aset->kategori_id) {
                        $dataKategori[$key]->aset = [$aset];
                        $totalKategori += count($dataKategori[$key]->aset);
                        $dataKategori[$key]->total_aset = $totalKategori;
                    }
                }
            }

            foreach($fasilitas->unit as $key => $unit) {
                $dataUnit[$key] = $unit;
                $totalUnit = 0;
                foreach($fasilitas->aset as $aset) {
                    if ($unit->id == $aset->unit_id) {
                        $dataUnit[$key]->aset = [$aset];
                        $totalUnit += count($dataUnit[$key]->aset);
                        $dataUnit[$key]->total_aset = $totalUnit;
                    }
                }
            }
        }

        $data = [
            'agenda' => $agd,
            'mahasiswa' => $mahasiswa,
            'asset' => $dataAsset,
        ];

        if(!empty($fasilitas)) {
            $data['asset'] = $dataAsset;
            $data['gedung'] = $dataGedung;
            $data['kategori'] = $dataKategori;
            $data['unit'] = $dataUnit;
        }

        // dd($dataGedung);
        return view('master.dashboard.index', ['data' => json_encode($data), 'asset' => $dataAsset, 'array' => $data]);
    }

}
