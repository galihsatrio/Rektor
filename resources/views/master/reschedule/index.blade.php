@extends('layout.master')

@section('title', 'Reschedule')
@section('header-content')
    <h1 class="judul-page">Reschedule</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/reschedule">Master</a></div>
        <div class="breadcrumb-item"><a href="/reschedule">Reschedule</a></div>
        <div class="breadcrumb-item">Index</div>
    </div>
@endsection

@section('header-body')
    <div class="card">
        <div class="card-header">
            <h4>Reschedule</h4>
            <div class="card-header-form">
                <form method="/reschedule" >
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search.." name="search">
                    <div class="input-group-btn">
                        <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-md">
                    <tbody>
                        <tr class="text-center">
                            <th>Nama</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Tempat</th>
                            <th>Alasan</th>
                            <th>Aksi</th>
                        </tr>
                        @if(count($model) > 0)
                        @foreach ( $model as $value )
                            <tr class="text-center">
                                <td class="text-left">{{ $value->nama_agenda }}</td>
                                <td>{{ $value->tanggal }}</td>
                                <td>{{ $value->jam }}</td>
                                <td>{{ $value->tempat }}</td>
                                <td class="text-left">{{ $value->alasan}}</td>
                                <td>
                                    <button class="btn btn-success btn-sm"  id="tolak" onclick="tindakan('setuju', {{$value->id}});">
                                        <i class="fa fa-check"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm"  id="tolak" onclick="tindakan('tolak', {{$value->id}});">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <form action="/reschedule/{{$value->id}}/{{'setuju'}}/{{$value->agenda_id}}" method="POST" id="setuju{{$value->id}}">
                                        @csrf
                                    </form>
                                    <form action="/reschedule/{{$value->id}}/{{'tolak'}}/{{$value->agenda_id}}" method="POST" id="tolak{{$value->id}}">
                                        @csrf
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        @else
                        <tr class="text-center font-weight-bold bg-light">
                            <td colspan="6" height="50" style="vertical-align: middle"> - Belum ada pengajuan reschedule agenda - </td>
                        </tr>
                        @endif
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
        function tindakan(tipe, id) {
            swal({
                title: "Apakah anda yakin?",
                text: tipe == 'setuju' ? 'Anda akan menyetujui perubahan jadwal' : 'Menolak perubahan jadwal, maka akan langsung menghapus pengajuan ini',
                icon: "warning",
                buttons: ["Tidak", "Setuju"],
                dangerMode: true,
            }).then((hapus) => {
                if (hapus) {
                    document.getElementById(tipe+id).submit();
                }
            });
        }
    </script>
@endsection
