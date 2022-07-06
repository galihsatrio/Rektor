@extends('layout.master')

@section('title', 'Agenda')
@section('header-content')
    <h1 class="judul-page">Jadwal Agenda</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/daftar-agenda">Master</a></div>
        <div class="breadcrumb-item"><a href="/daftar-agenda">Agenda</a></div>
        <div class="breadcrumb-item">Index</div>
    </div>
@endsection

@section('header-body')
    <div class="card">
        <div class="card-header">
            <h4>Schedule Rektor</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-md">
                    <tbody>
                        <tr class="text-center">
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Agenda</th>
                            <th>Prioritas</th>
                            <th>Tindakan</th>
                            <th>Detail</th>
                        </tr>
                        @foreach ( $model as $value )
                        <tr class="text-center" style="{{!isset($value->persetujuan) ? 'background: #ebebeb;' : '' }}">
                            <td>{{ $value->tanggal }}</td>
                            <td>{{ $value->jam }}</td>
                            <td class="text-left">{{ $value->nama_agenda }}</td>
                            <td>
                                @if( $value->status == 1 )
                                    <div class="badge badge-success badge-pill">Wajib</div>
                                @else
                                    <div class="badge badge-warning badge-pill">Tidak Wajib</div>
                                @endif
                            </td>
                            <td>
                                @if (!isset($value->persetujuan))
                                    <button class="btn btn-success btn-sm" onclick="persetujuan('setuju', {{$value->id}});">
                                        <i class="fa fa-check"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm" onclick="persetujuan('tidak setuju', {{$value->id}});">
                                        <i class="fa fa-times"></i>
                                    </button>
                                @elseif (isset($value->persetujuan) && $value->persetujuan == 0)
                                    <button class="btn btn-danger btn-sm rounded-circle" style="padding: 2px 10px !important;" disabled>
                                        <i class="fas fa-times"></i>
                                    </button>
                                @elseif (isset($value->persetujuan) && $value->persetujuan == 2)
                                    <button class="btn btn-success btn-sm rounded-circle" style="padding: 2px 7px !important;" disabled>
                                        <i class="fas fa-check"></i>
                                    </button>
                                @endif

                                <form action="/daftar-agenda/persetujuan/{{$value->id}}/{{2}}" method="POST" id="formSetuju{{$value->id}}">
                                    @csrf
                                </form>
                                <form action="/daftar-agenda/persetujuan/{{$value->id}}/{{0}}" method="POST" id="formTidakSetuju{{$value->id}}">
                                    @csrf
                                </form>
                            </td>
                            <td>
                                <a href="/daftar-agenda/detail/{{ $value->id }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer bg-whitesmoke text-right">
            <nav class="d-inline-block">
                {{$model->links()}}
            </nav>
        </div>
    </div>
    <script>
        function persetujuan(status, id) {
            if (status == 'setuju') {
                swal({
                    title: "Apakah anda yakin?",
                    text: "Anda akan menyetujui untuk datang pada agenda tersebut.",
                    icon: "success",
                    buttons: ["Batalkan", "Setuju"],
                }).then((setuju) => {
                    if (setuju) {
                        document.getElementById("formSetuju"+id).submit();
                    }
                });
            } else {
                swal({
                    title: "Apakah anda yakin?",
                    text: "Anda akan menyetujui untuk tidak datang pada agenda tersebut.",
                    icon: "warning",
                    buttons: ["Batalkan", "Setuju"],
                }).then((skip) => {
                    if (skip) {
                        document.getElementById("formTidakSetuju"+id).submit();
                    }
                });
            }
        }


    </script>
@endsection
