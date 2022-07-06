@extends('layout.master')

@section('title', 'Agenda Rektor')
@section('header-content')
    <h1 class="judul-page">Schedule</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/daftar-agenda">Master</a></div>
        <div class="breadcrumb-item"><a href="/daftar-agenda">Schedule</a></div>
        <div class="breadcrumb-item"><a href="/daftar-agenda">Index</a></div>
        <div class="breadcrumb-item">Edit</div>
    </div>
@endsection

@section('header-body')
    <div class="card">
        <div class="card-header">
            <h4>Detail Schedule</h4>
        </div>
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-12 text-center">

                    @if(count($errors) > 0)
                        <div class="alert alert-danger alert-dismissible fade show text-left mb-5" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            Gagal mengajukan perubahan jadwal
                        </div>
                    @endif

                    <h4>Schedule {{ $model->nama_agenda }}</h4>
                </div>
                <div class="col-7 mt-5">
                    <table class="w-100 ml-5">
                        <tr height="30">
                            <td class="font-weight-bold">Tempat</td>
                            <td width="5%"> :</td>
                            <td>{{ $model->tempat }}</td>
                        </tr>
                        <tr height="30">
                            <td class="font-weight-bold">Tanggal</td>
                            <td width="5%"> :</td>
                            <td>{{ $model->tanggal }}</td>
                        </tr>
                        <tr height="30">
                            <td class="font-weight-bold">Pukul</td>
                            <td width="5%"> :</td>
                            <td>{{ $model->jam }}</td>
                        </tr>
                        <tr height="30">
                            <td class="font-weight-bold">Prioritas</td>
                            <td width="5%"> :</td>
                            <td>{{ $model->status == 1 ? 'Wajib dihadiri' : 'Tidak wajib dihadiri' }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold"  style="vertical-align: top">Keterangan</td>
                            <td width="5%" style="vertical-align: top"> : </td>
                            <td>{{ $model->keterangan_agenda }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer bg-whitesmoke text-right">
            <a href="/daftar-agenda" class="btn btn-secondary btn-sm mr-1">
                <i class="mr-1 fa fa-chevron-left"></i>
                Kembali
            </a>
            <button class="btn btn-warning btn-sm mr-1" data-toggle="modal" data-target="#modalReschedule">
                <i class="far fa-calendar-times mr-1"></i>
                Ajukan Reschedule
            </button>
        </div>
    </div>

    <script src="{{ asset('assets/js/page/bootstrap-modal.js') }}"></script>
    <script>
        function pengajuan() {
            swal({
                title: "Apakah anda yakin?",
                text: "Anda akan mengirim pengajuan perubahan jadwal.",
                icon: "warning",
                buttons: ["Batalkan", "Setuju"],
            }).then((setuju) => {
                if (setuju) {
                    document.getElementById("pengajuan").submit();
                }
            });
        }
    </script>
@endsection

<div class="modal fade" tabindex="-1" role="dialog" id="modalReschedule">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pengajuan Reschedule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-primary" role="alert">
                    Jika anda berhalangan untuk datang di agenda {{ $model->nama_agenda }}, maka anda bisa melakukan perubahan jadwal, tindakan ini menunggu persetujuan oleh admin terlebih dahulu
                </div>
                <form action="/daftar-agenda/reschedule/{{ $model->id }}" method="POST" id="pengajuan">
                    @csrf
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control form-control-sm @error('tanggal') is-invalid @enderror"  name="tanggal" id="tanggal">
                        @error('tanggal')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="jam">Jam</label>
                        <select class="form-control form-control-sm @error('jam') is-invalid @enderror"  name="jam" id="jam">
                            @error('jam')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <option value=""> - Pilih Jam - </option>
                            <option value="07:00">07:00</option>
                            <option value="08:00">08:00</option>
                            <option value="09:00">09:00</option>
                            <option value="10:00">10:00</option>
                            <option value="11:00">11:00</option>
                            <option value="12:00">12:00</option>
                            <option value="13:00">13:00</option>
                            <option value="14:00">14:00</option>
                            <option value="15:00">15:00</option>
                            <option value="16:00">16:00</option>
                            <option value="17:00">17:00</option>
                            <option value="18:00">18:00</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="alasan">Alasan</label>
                        <textarea type="text" class="form-control form-control-sm @error('alasan') is-invalid @enderror"  name="alasan" id="alasan"></textarea>
                        @error('alasan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-warning" onclick="pengajuan()">
                    <i class="fas fa-paper-plane mr-1"></i>
                    Ajukan
                </button>
            </div>
        </div>
    </div>
</div>
